<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
</head>
<body style="font-family:sans-serif;text-align:center;margin-top:80px">
    <h1>403</h1>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}</p>
    <a href="{{ route('supplier.daftar') }}">Kembali</a>
</body>
</html>
</html>