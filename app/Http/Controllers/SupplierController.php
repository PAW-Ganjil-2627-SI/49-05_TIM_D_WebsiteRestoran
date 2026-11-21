<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function daftar()
    {
        $suppliers = Supplier::all();
        return view('daftar', compact('suppliers'));
    }

    public function create()
    {
        return view('form', ['supplier' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ID_Perusahaan' => 'required|unique:supplier,ID_Perusahaan',
            'Nama_Supplier' => 'required',
            'Alamat'        => 'required',
            'No_Telepon'    => 'required',
        ]);

        Supplier::create($data);
        return redirect()->route('supplier.daftar');
    }

    public function edit(Supplier $supplier)
    {
        return view('form', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'Nama_Supplier' => 'required',
            'Alamat'        => 'required',
            'No_Telepon'    => 'required',
        ]);

        $supplier->update($data);
        return redirect()->route('supplier.daftar');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.daftar');
    }
}