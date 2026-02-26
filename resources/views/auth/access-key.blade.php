<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Key</title>
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; background: #0f172a; color: #e2e8f0; margin: 0; }
        .container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { width: 100%; max-width: 420px; background: rgba(15,23,42,0.9); border: 1px solid rgba(148,163,184,0.2); border-radius: 16px; padding: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.35); }
        h1 { margin: 0 0 8px; font-size: 20px; }
        p { margin: 0 0 16px; color: rgba(226,232,240,0.75); font-size: 14px; line-height: 1.5; }
        label { display: block; font-size: 13px; margin-bottom: 8px; color: rgba(226,232,240,0.9); }
        input { width: 100%; padding: 12px 12px; border-radius: 12px; border: 1px solid rgba(148,163,184,0.25); background: rgba(2,6,23,0.6); color: #e2e8f0; outline: none; }
        input:focus { border-color: rgba(34,197,94,0.75); box-shadow: 0 0 0 3px rgba(34,197,94,0.15); }
        .error { margin-top: 8px; font-size: 12px; color: #f87171; }
        button { width: 100%; margin-top: 16px; padding: 12px; border: 0; border-radius: 12px; background: #22c55e; color: #052e16; font-weight: 700; cursor: pointer; }
        button:hover { background: #16a34a; }
        .meta { margin-top: 14px; font-size: 12px; color: rgba(226,232,240,0.6); }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Enter Access Key</h1>
        <p>Enter your access key to enable this device.</p>

        <form method="POST" action="{{ url('/access-key') }}">
            @csrf
            <input type="hidden" name="next" value="{{ $next }}">

            <label for="key">Access Key</label>
            <input id="key" name="key" type="password" autocomplete="one-time-code" required value="{{ old('key') }}">

            @error('key')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Continue</button>
        </form>

        <div class="meta">Next: {{ $next }}</div>
    </div>
</div>
</body>
</html>
