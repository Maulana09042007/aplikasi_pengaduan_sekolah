<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;

class AspirasiController extends Controller
{
    public function create(Request $request)
    {
        $kategoris = Kategori::all();
        $aspirasis = collect();

        if ($request->has('nis')) {
            $aspirasis = Aspirasi::with(['kategori', 'siswa'])
                ->whereHas('siswa', function ($q) use ($request) {
                    $q->where('nis', $request->nis);
                })
                ->latest()
                ->get();
        }

        return view('aspirasi.create', compact('kategoris', 'aspirasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'         => 'required|int|min:10|regex:/^[0-9]{10}$/',
            'nama'        => 'required|string',
            'kelas'       => 'required|string',
            'lokasi'      => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'feedback'    => 'required|string',
        ],[
            'nis.integer'=>'Harus Berisi Angka !',
            'nis.regex'=>'Masukan 10 digit nis anda',
        ]);

        $siswa = Siswa::firstOrCreate(
            ['nis' => $request->nis],
            [
                'nama'  => $request->nama,
                'kelas' => $request->kelas,
            ]
        );

        $buatAspirasi =  Aspirasi::create([
            'siswa_id'    => $siswa->id,
            'kategori_id' => $request->kategori_id,
            'lokasi'      => $request->lokasi,
            'feedback' => $request->feedback,
            'status'      => 'Menunggu',
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Menunggu,Diproses,Selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->status = $request->status;
        $aspirasi->save();

        return response()->json(['success' => true, 'status' => $aspirasi->status]);
    }

    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback_user' => 'required|string',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->feedback_user = $request->feedback_user;
        $aspirasi->save();

        return response()->json(['success' => true, 'feedback_user' => $aspirasi->feedback_user]);
    }
}
