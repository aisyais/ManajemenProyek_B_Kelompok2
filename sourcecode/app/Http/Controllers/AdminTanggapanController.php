<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;   
use App\Models\Tanggapan; 
use Illuminate\Support\Facades\Auth;

class AdminTanggapanController extends Controller
{
    public function formBalas($id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('admin.balas', compact('laporan'));
    }

    public function kirimBalasan(Request $request, $id)
        {
            $request->validate([
                'isi_balasan' => 'required' 
            ]);

            Tanggapan::create([
                'laporan_id'    => $id,
                'user_id'       => Auth::id(), 
                'isi_tanggapan' => $request->isi_balasan,
            ]);

            
            Laporan::where('id', $id)->update(['status' => 'selesai']);

            return redirect('/admin/dashboard')->with('success', 'Balasan terkirim!');
        }
    }