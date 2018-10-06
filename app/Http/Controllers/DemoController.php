<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\User;

class DemoController extends Controller
{
    public function nasabah() {
        $daftar_marketing = User::all();
        $daftar_nasabah = Nasabah::with('user')->get();
        return view('nasabah', compact('daftar_nasabah', 'daftar_marketing'));
    }

    public function tambah_nasabah(Request $request) {
        $nasabah = Nasabah::create($request->all());
        $marketing = User::find($nasabah->user_id)->first();
        $tabunganAwal = $request->get('tabungan');

        if($tabunganAwal > 500000) {
            $marketing->total_tabungan += $tabunganAwal;
            $marketing->poin = hitungPoin($tabunganAwal);
            $marketing->save();
        }

        return response()->json([
            'nasabah' => $nasabah->name,
            'marketing' => $nasabah->user->name,
            'tabungan' => $nasabah->tabungan
        ]);
    }

    public function tambah_tabungan(Request $request, $id) {
        $nasabah = Nasabah::find($id);
        $total = $nasabah->tabungan + $request->get('tabungan');
        $nasabah->tabungan = $total;
        $nasabah->save();
        return response()->json([
            'tabungan' => $nasabah->tabungan
        ]);
    }

    public function kurang_tabungan(Request $request, $id) {
        $nasabah = Nasabah::find($id);
        if($nasabah->tabungan > 0 && $request->get('tabungan') < $nasabah->tabungan) {
            $total = $nasabah->tabungan - $request->get('tabungan');
            $nasabah->tabungan = $total;
            $nasabah->save();
        }
    
        return response()->json([
            'tabungan' => $request->get('tabungan')
        ]);
    }

    public function update($id) {
        $marketing = User::find($id);

        $total_marketing = $marketing->total_tabungan;
        $total_sekarang = hitungTotal($marketing->nasabah);
        $selisih = $total_sekarang - $total_marketing;
        
        if($selisih > 500000) {
            $marketing->poin += hitungPoin($selisih);
        } 
        if($selisih < -500000) {
            $marketing->poin -= hitungPoin(abs($selisih));
        }

        $marketing->total_tabungan = $total_sekarang;
        $marketing->save();

        return redirect()->back();
    }

    public function bonus($id) {
        $marketing = User::find($id);

        $marketing->poin += hitungBonus($marketing->total_tabungan);
        
        $marketing->save();

        return redirect()->back();
    }

    public function marketing() {
        $daftar_marketing = User::with('nasabah')->get();
        return view('marketing', compact('daftar_marketing'));
    }
}
