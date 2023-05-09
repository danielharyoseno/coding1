<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pegawai;
use App\Models\TransaksiAktivasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransaksiAktivasiController extends Controller
{
    public function store(Request $request)
    {
        $transaksi_aktivasi = TransaksiAktivasi::create([
            'tgl_aktivasi' => date('Y-m-d', strtotime('now')),
            'id_member' => $request->id_member,
            'id_pegawai' => $request->id_pegawai,
            'nominal' => '3000000'
        ]);
        $member = Member::where('id','=',$request->id_member)->first();
        if ($member->masa_berlaku_member == null) {
            $tgl = date('Y-m-d H:i:s');
        } else {
            $tgl= $member->masa_berlaku_member;
        }
        $expired = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($tgl)));
        $member->masa_berlaku_member = $expired;
        $member->save();
        
        return response([
            'message'=> 'success tambah data transaksi aktivasi',
            'data' => ['transaksi_aktivasi' => $transaksi_aktivasi, 'member' => $member, 'no_struk' => TransaksiAktivasi::latest()->first()->no_struk_aktivasi],
        ]);
        
    }
}