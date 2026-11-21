<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    @if ($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div>
            <label>Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}">
        </div>
        <div>
            <label>Password</label><br>
            <input type="password" name="password">
        </div>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>