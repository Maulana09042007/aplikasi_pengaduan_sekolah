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
            'nis'         => 'required|int|min:10',
            'nama'        => 'required|string',
            'kelas'       => 'required|string',
            'lokasi'      => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'feedback'    => 'required|string',
            'feedback_admin'  => 'string|nullable',
        ],[
            'nis.integer'=>'Nis Harus Berupa Angka !',
            'nis.min'=>'Masukan 10 digit nis anda',
        ]);

        $siswa = Siswa::firstOrCreate(
            ['nis' => $request->nis],
            [
                'nama'  => $request->nama,
                'kelas' => $request->kelas,
            ]
        );

        $buatAspirasi = Aspirasi::create([
            'siswa_id'      => $siswa->id,
            'kategori_id'   => $request->kategori_id,
            'lokasi'        => $request->lokasi,
            'feedback'      => $request->feedback,
            'feedback_admin'=> $request->feedback_admin ?? null,
            'status'        => 'Menunggu',
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

    if ($request->status === 'Diproses') {
        $aspirasi->tanggal_estimasi = now()->addDays(100)->format('Y-m-d'); 
    } else {
        $aspirasi->tanggal_estimasi = null; 
    }

    $aspirasi->save();

    return response()->json([
        'success' => true,
        'status' => $aspirasi->status,
        'tanggal_estimasi' => $aspirasi->tanggal_estimasi
    ]);
}


    public function updateFeedbackAdmin(Request $request, $id)
    {
        $request->validate([
            'feedback_admin' => 'required|string',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->feedback_admin = $request->feedback_admin;
        $aspirasi->save();

        return response()->json([
            'success'        => true,
            'feedback_admin' => $aspirasi->feedback_admin
        ]);
    }
    public function kategori(){


    
    return view('admin.kategori');



    }

    public function tambahKategori(Request $request){

    $request->validate([
        'kategori'=>'required|string|max:20'
    ],
    [
        'kategori.max'=>'Tolong isi maximal 20 karakter '
    ]
    );

    $buatKategori = Kategori::create([
        'ket_kategori'=>$request->kategori,
    ]);
    
    return view('admin.kategori');
}
}