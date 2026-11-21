<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rumah Makan Radit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-2">Rumah Makan Radit</h3>
            <p class="text-center text-muted mb-4">Silakan login terlebih dahulu</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control"
                        value="{{ old('username') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        required
                    >
                </div>

                <div class="form-check mb-3">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="form-check-input"
                        value="1"
                    >
                    <label for="remember" class="form-check-label">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>
