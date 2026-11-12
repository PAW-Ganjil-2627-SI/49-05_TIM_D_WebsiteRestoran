
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Rumah Makan Radit</title>

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Menu</h2>

        @auth
            <a href="{{ route('menu.tambah') }}" class="btn btn-primary">
                + Tambah Menu
            </a>
        @endauth
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Status Halal</th>
                    <th>Harga</th>

                    @auth
                        <th>Aksi</th>
                    @endauth
                </tr>
            </thead>

            <tbody>
                @forelse ($menu as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_menu }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->deskripsi }}</td>

                        <td>
                            @if ($item->status_halal == 'Halal')
                                <span class="badge bg-success">
                                    Halal
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    {{ $item->status_halal }}
                                </span>
                            @endif
                        </td>

                        <td>
                            Rp{{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        @auth
                            <td class="text-nowrap">
                                <a href="{{ route('menu.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('menu.hapus', $item->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::check() ? 7 : 6 }}" class="text-center">
                            Belum ada data menu.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
