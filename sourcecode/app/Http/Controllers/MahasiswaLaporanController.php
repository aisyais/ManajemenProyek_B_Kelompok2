<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;  
use App\Models\Lampiran; 
use Illuminate\Support\Facades\Auth;

class MahasiswaLaporanController extends Controller
{
    // Tambahkan function ini di MahasiswaLaporanController
    public function index()
    {
        // Ambil laporan milik user yang sedang login saja
        $laporans = \App\Models\Laporan::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->with('tanggapan') // Ambil balasannya sekalian
                        ->latest()
                        ->get();

        return view('mahasiswa.semua-laporan', compact('laporans'));
    }

    public function create()
    {
        // Ambil 3 laporan terakhir user untuk ditampilkan di dashboard (Preview)
        $laporans = \App\Models\Laporan::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->with('tanggapan')
                        ->latest()
                        ->take(3) // Batasi cuma 3
                        ->get();

        return view('mahasiswa.dashboard', compact('laporans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas' => 'required',
            'isi'      => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validasi file
        ]);

        // Simpan Laporan
        $laporan = Laporan::create([
            'user_id'  => Auth::id(),
            'nama'     => Auth::user()->name, // Ambil nama dari user login
            'fakultas' => $request->fakultas,
            'isi'      => $request->isi,
            'status'   => 'pending'
        ]);

        // Simpan Lampiran (Jika ada upload)
        if ($request->hasFile('lampiran')) {
            // Simpan ke folder: storage/app/public/lampiran
            $path = $request->file('lampiran')->store('lampiran', 'public');

            Lampiran::create([
                'laporan_id' => $laporan->id,
                'file_path'  => $path,
            ]);
        }

        return redirect('/mahasiswa/semua-laporan')->with('success', 'Laporan berhasil dikirim!');
    }
}
