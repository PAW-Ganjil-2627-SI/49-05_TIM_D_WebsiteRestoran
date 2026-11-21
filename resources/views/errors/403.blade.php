<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h1 class="display-1 fw-bold">403</h1>

        <h3 class="mb-3">Akses Ditolak</h3>

        <p class="text-muted mb-4">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}
        </p>

        <a href="{{ route('menu.daftar') }}" class="btn btn-primary">
            Kembali ke Daftar Menu
        </a>
    </div>
</div>

</body>
</html>
