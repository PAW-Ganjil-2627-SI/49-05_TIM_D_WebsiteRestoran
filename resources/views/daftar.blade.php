<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Judul Halaman</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>  

<h1>Daftar Supplier</h1>

<div class="toolbar">
    @auth
        @if (auth()->user()->hasRole('admin', 'staff'))
            <a href="{{ route('supplier.create') }}">+ Tambah Supplier</a>
        @endif

        @can('akses-admin')
            <a href="{{ route('admin.panel') }}">Admin Panel</a>
        @endcan

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->ID_Perusahaan }}</td>
                <td>{{ $supplier->Nama_Supplier }}</td>
                <td>{{ $supplier->Alamat }}</td>
                <td>{{ $supplier->No_Telepon }}</td>
                <td class="aksi">
                    @can('update', $supplier)
                        <a href="{{ route('supplier.edit', $supplier) }}">Edit</a>
                    @endcan

                    @can('delete', $supplier)
                        <form action="{{ route('supplier.destroy', $supplier) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>