<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LedgerService
{
    /**
     * Records a transaction and updates involved wallets.
     * 
     * @param array $data
     * @return Transaction
     * @throws \Exception
     */
    public function recordTransaction(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Basic Validation
            $amount = $data['amount'];
            $type = $data['type'];
            $fromUserId = $data['from_user_id'] ?? null;
            $toUserId = $data['to_user_id'] ?? null;

            // 2. Row Level Locking for Wallets
            $fromWallet = $fromUserId ? Wallet::where('user_id', $fromUserId)->lockForUpdate()->first() : null;
            $toWallet = $toUserId ? Wallet::where('user_id', $toUserId)->lockForUpdate()->first() : null;

            // 3. Balance Check for outgoing funds
            if ($fromWallet && in_array($type, ['escrow_create', 'withdrawal', 'payout'])) {
                if ($fromWallet->available_balance < $amount) {
                    throw new \Exception("Insufficient balance in source wallet.");
                }
            }

            // 4. Create Transaction Record
            $transaction = Transaction::create([
                'type' => $type,
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'amount' => $amount,
                'currency' => $data['currency'] ?? 'TZS',
                'provider_reference' => $data['provider_reference'] ?? null,
                'status' => $data['status'] ?? 'completed',
                'ip_address' => request()->ip(),
                'device_hash' => request()->header('User-Agent'),
                'metadata' => $data['metadata'] ?? [],
            ]);

            // 5. Update Wallets based on transaction type
            $this->updateBalances($transaction, $fromWallet, $toWallet);

            // 6. Audit Trail
            $this->logAudit($transaction, 'transaction_created');

            return $transaction;
        });
    }

    protected function updateBalances(Transaction $tx, ?Wallet $from, ?Wallet $to)
    {
        $amount = $tx->amount;

        switch ($tx->type) {
            case 'deposit':
                if ($to) {
                    $to->increment('available_balance', $amount);
                }
                break;

            case 'escrow_create':
                if ($from) {
                    $from->decrement('available_balance', $amount);
                    $from->increment('locked_balance', $amount);
                }
                break;

            case 'escrow_release':
                if ($from) {
                    $from->decrement('locked_balance', $amount);
                }
                if ($to) {
                    $to->increment('available_balance', $amount);
                }
                break;

            case 'withdrawal':
                if ($from) {
                    $from->decrement('available_balance', $amount);
                }
                break;
        }
    }

    protected function logAudit(Transaction $tx, string $action)
    {
        AuditLog::create([
            'user_id' => auth()->id() ?? $tx->from_user_id,
            'action' => $action,
            'model_type' => Transaction::class,
            'model_id' => $tx->id,
            'new_values' => $tx->toArray(),
            'ip_address' => request()->ip(),
            'device_hash' => request()->header('User-Agent'),
        ]);
    }
}
