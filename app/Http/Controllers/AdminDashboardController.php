<?php
namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

        $aspirasiTerbaru = InputAspirasi::with([
                'siswa',
                'kategori',
                'aspirasi'
            ])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'proses',
            'selesai',
            'aspirasiTerbaru'
        ));
    }
}
