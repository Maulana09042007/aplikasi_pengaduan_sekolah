<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;

class AdminAuthController extends Controller
{
    
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }

    public function dashboard()
    {
        $total = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'menunggu')->count();
        $diproses = Aspirasi::where('status', 'diproses')->count();
        $selesai = Aspirasi::where('status', 'selesai')->count();

        $aspirasiTerbaru = Aspirasi::latest()->limit(10)->get();

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'diproses',
            'selesai',
            'aspirasiTerbaru'
        ));
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


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.form');
    }
}
