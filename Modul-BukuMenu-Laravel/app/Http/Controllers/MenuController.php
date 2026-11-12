<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function daftar()
    {
        $menu = Menu::orderByDesc('id')->get();

        return view('menu.daftar', compact('menu'));
    }

    // Menampilkan form tambah menu
    public function tambah()
    {
        return view('menu.tambah');
    }

    // Menyimpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'status_halal' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        Menu::create($request->only([
            'nama_menu',
            'kategori',
            'deskripsi',
            'status_halal',
            'harga',
        ]));

        return redirect('/daftar-menu')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    // Menampilkan form edit menu
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', compact('menu'));
    }

    // Menyimpan perubahan menu
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'status_halal' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->update($request->only([
            'nama_menu',
            'kategori',
            'deskripsi',
            'status_halal',
            'harga',
        ]));

        return redirect('/daftar-menu')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    // Menghapus menu
    public function hapus($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        return redirect('/daftar-menu')
            ->with('success', 'Menu berhasil dihapus!');
    }
}
