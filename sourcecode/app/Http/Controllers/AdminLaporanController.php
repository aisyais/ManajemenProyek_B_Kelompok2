<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; 

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Hitung Statistik
        $totalLaporan = Laporan::count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        
        // Ambil 5 laporan terbaru saja untuk dashboard (agar tidak penuh)
        $laporans = Laporan::latest()->take(5)->get();

        return view('admin.dashboard', compact('laporans', 'totalLaporan', 'laporanSelesai'));
    }

    public function laporan()
    {
        // Ambil semua laporan dengan pagination (halaman)
        $laporans = Laporan::latest()->get();

        return view('admin.laporan', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $laporan = Laporan::findOrFail($id);
        
        // Update status
        $laporan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari laporan berdasarkan ID, lalu hapus
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return back()->with('success', 'Laporan berhasil dihapus!');
    }
}