<h1>{{ $supplier ? 'Edit' : 'Tambah' }} Supplier</h1>

@if ($errors->any())
    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
@endif

<form method="POST" action="{{ $supplier ? route('supplier.update', $supplier->ID_Perusahaan) : route('supplier.store') }}">
    @csrf
    @if ($supplier) @method('PUT') @endif

    @unless ($supplier)
        <p>ID: <input name="ID_Perusahaan" value="{{ old('ID_Perusahaan') }}"></p>
    @endunless
    <p>Nama: <input name="Nama_Supplier" value="{{ old('Nama_Supplier', $supplier->Nama_Supplier ?? '') }}"></p>
    <p>Alamat: <input name="Alamat" value="{{ old('Alamat', $supplier->Alamat ?? '') }}"></p>
    <p>Telepon: <input name="No_Telepon" value="{{ old('No_Telepon', $supplier->No_Telepon ?? '') }}"></p>

    <button type="submit">Simpan</button>
    <a href="{{ route('supplier.daftar') }}">Batal</a>
</form>