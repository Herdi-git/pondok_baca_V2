<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Pondok Baca</title>
    <style>
        body { margin: 0; background: #f5f0e8; color: #28241f; font: 16px/1.5 system-ui, sans-serif; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 18px 6%; background: #28241f; color: white; }
        header a, header button { color: white; background: none; border: 0; font: inherit; text-decoration: none; cursor: pointer; }
        nav { display: flex; gap: 18px; align-items: center; } main { max-width: 1100px; margin: 36px auto; padding: 0 20px; }
        h1 { margin-top: 0; } a { color: #8b3d2e; } table { width: 100%; border-collapse: collapse; background: white; } th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; vertical-align: top; }
        form.inline { display: inline; } input, select, textarea { width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #bbb; border-radius: 4px; } label { display: block; margin: 14px 0; font-weight: 600; }
        button, .button { display: inline-block; padding: 9px 14px; border: 0; border-radius: 4px; background: #a63d2f; color: white; cursor: pointer; text-decoration: none; } .button.secondary { background: #35586b; }
        .actions { display: flex; gap: 8px; align-items: center; } .notice { padding: 12px; margin-bottom: 18px; background: #dfefd9; } .error { color: #a63d2f; }
        .login { max-width: 420px; margin: 10vh auto; background: white; padding: 28px; } .message-unread { font-weight: 700; }
    </style>
</head>
<body>
<header><strong>Pondok Baca Admin</strong><nav><a href="{{ route('admin.books.index') }}">Buku</a><a href="{{ route('admin.messages.index') }}">Pesan</a><form class="inline" method="POST" action="{{ route('admin.logout', absolute: false) }}">@csrf<button>Keluar</button></form></nav></header>
<main>@if(session('success'))<div class="notice">{{ session('success') }}</div>@endif @yield('content')</main>
</body>
</html>