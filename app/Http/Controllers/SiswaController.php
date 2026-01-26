<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    // tampilkan form tambah siswa
    public function create()
    {
        return view('admin.siswa.create');
    }

    // simpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|max:10|unique:siswas,nis',
            'kelas' => 'required|string|max:10',
        ]);

        Siswa::create([
            'nama'  => $request->nama,
            'nis'   => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }
}
