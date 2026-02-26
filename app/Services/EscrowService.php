<?php

namespace App\Services;

use App\Models\Escrow;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EscrowService
{
    protected $ledger;

    public function __construct(LedgerService $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Step 1: Create Escrow (Status: created)
     */
    public function createEscrow(array $data)
    {
        return DB::transaction(function () use ($data) {
            $escrow = Escrow::create([
                'buyer_id' => $data['buyer_id'],
                'seller_id' => $data['seller_id'],
                'amount' => $data['amount'],
                'status' => 'created',
                'expires_at' => now()->addDays(14),
            ]);

            $this->logAudit($escrow, 'escrow_created');

            return $escrow;
        });
    }

    /**
     * Step 2: Fund Escrow (Status: funded)
     */
    public function fundEscrow(string $escrowId, string $providerRef)
    {
        return DB::transaction(function () use ($escrowId, $providerRef) {
            $escrow = Escrow::where('id', $escrowId)->lockForUpdate()->firstOrFail();

            if ($escrow->status !== 'created') {
                throw new \Exception("Escrow cannot be funded in its current state.");
            }

            // Record the transaction (Buyer pays)
            $this->ledger->recordTransaction([
                'type' => 'escrow_create',
                'from_user_id' => $escrow->buyer_id,
                'amount' => $escrow->amount,
                'provider_reference' => $providerRef,
                'status' => 'completed',
                'metadata' => ['escrow_id' => $escrow->id]
            ]);

            $escrow->update(['status' => 'funded']);
            $this->logAudit($escrow, 'escrow_funded');

            return $escrow;
        });
    }

    /**
     * Step 4: Release Escrow (Status: released)
     */
    public function releaseEscrow(string $escrowId)
    {
        return DB::transaction(function () use ($escrowId) {
            $escrow = Escrow::where('id', $escrowId)->lockForUpdate()->firstOrFail();

            if ($escrow->status !== 'funded') {
                throw new \Exception("Only funded escrows can be released.");
            }

            // Record the transaction (Seller receives)
            $this->ledger->recordTransaction([
                'type' => 'escrow_release',
                'from_user_id' => $escrow->buyer_id,
                'to_user_id' => $escrow->seller_id,
                'amount' => $escrow->amount,
                'status' => 'completed',
                'metadata' => ['escrow_id' => $escrow->id]
            ]);

            $escrow->update(['status' => 'released']);
            $this->logAudit($escrow, 'escrow_released');

            return $escrow;
        });
    }

    protected function logAudit(Escrow $escrow, string $action)
    {
        AuditLog::create([
            'user_id' => auth()->id() ?? $escrow->buyer_id,
            'action' => $action,
            'model_type' => Escrow::class,
            'model_id' => $escrow->id,
            'new_values' => $escrow->toArray(),
            'ip_address' => request()->ip(),
            'device_hash' => request()->header('User-Agent'),
        ]);
    }
}
