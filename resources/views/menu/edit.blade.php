<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Rumah Makan Radit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/daftar-menu') }}">
            Rumah Makan Radit
        </a>

        <div class="d-flex align-items-center gap-3">
            @auth
                <span class="text-white">
                    Halo, {{ Auth::user()->username }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 650px;">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Edit Menu</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('menu.update', $menu->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" id="nama_menu" name="nama_menu"
                           class="form-control"
                           value="{{ old('nama_menu', $menu->nama_menu) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select id="kategori" name="kategori"
                            class="form-select" required>
                        <option value="Makanan"
                            {{ old('kategori', $menu->kategori) == 'Makanan' ? 'selected' : '' }}>
                            Makanan
                        </option>
                        <option value="Minuman"
                            {{ old('kategori', $menu->kategori) == 'Minuman' ? 'selected' : '' }}>
                            Minuman
                        </option>
                        <option value="Camilan"
                            {{ old('kategori', $menu->kategori) == 'Camilan' ? 'selected' : '' }}>
                            Camilan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"
                              class="form-control" rows="3"
                              required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status_halal" class="form-label">
                        Status Halal
                    </label>
                    <select id="status_halal" name="status_halal"
                            class="form-select" required>
                        <option value="Halal"
                            {{ old('status_halal', $menu->status_halal) == 'Halal' ? 'selected' : '' }}>
                            Halal
                        </option>
                        <option value="Belum Terverifikasi"
                            {{ old('status_halal', $menu->status_halal) == 'Belum Terverifikasi' ? 'selected' : '' }}>
                            Belum Terverifikasi
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga"
                           class="form-control" min="0"
                           value="{{ old('harga', $menu->harga) }}"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('menu.daftar') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
