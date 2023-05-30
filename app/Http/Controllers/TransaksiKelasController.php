<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiKelas;
use App\Models\Promo;
use App\Models\Member;
use App\Models\Pegawai;
use App\Models\depositKelas;
use App\Models\Kelas;
use Exception;
use App\Http\Resources\MemberResource;
use Carbon\Carbon;

class TransaksiKelasController extends Controller
{
    public function index()
    {
        $paketKelas = TransaksiKelas::with(['pegawai','member','promo','kelas'])->get();
        if(count($paketKelas)>0){
            return new MemberResource(true,'List Data Transaksi Deposit Paket Kelas',
            $paketKelas);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function store(Request $request){
        try
        {
            $id_promo = null;
            if($request->id_promo != null){
                $promo = Promo::findorfail($request->id_promo);
                $member = Member::findorfail($request->id_member);
                $kelas = Kelas::findorfail($request->id_kelas);
                $minimal_deposit = $promo->minimal_deposit;
                $jmlh_kelas = $request->jmlh_kelas;
                $total_deposit_kelas = $request->jmlh_kelas;
                if($jmlh_kelas >= $minimal_deposit){
                    if($minimal_deposit == 5){
                        $id_promo = $request->id_promo;
                        $id_member = $request->id_member;
                        $id_kelas = $request->id_kelas;
                        $bonus_deposit_paket = $promo->bonus_promo;
                        $expired_kelas = Carbon::now()->addMonth();
                        $nominal_kelas = $kelas->harga_kelas * $jmlh_kelas;
                        $total_deposit_kelas = $total_deposit_kelas + $bonus_deposit_paket;
                    }else if($minimal_deposit == 10){
                        $id_promo = $request->id_promo;
                        $id_member = $request->id_member;
                        $id_kelas = $request->id_kelas;
                        $bonus_deposit_paket = $promo->bonus_promo;
                        $expired_kelas = Carbon::now()->addMonth()->addMonth();
                        $nominal_kelas = $kelas->harga_kelas * $jmlh_kelas;
                        $total_deposit_kelas = $total_deposit_kelas + $bonus_deposit_paket;
                    }
                }else{
                    $id_promo = null;
                    $id_member = $request->id_member;
                    $id_kelas = $request->id_kelas;
                    $bonus_deposit_paket = 0;
                    $expired_kelas = null;
                    $jmlh_kelas = $request->jmlh_kelas;
                    $nominal_kelas = $kelas->harga_kelas * $jmlh_kelas;
                    $total_deposit_kelas = $jmlh_kelas;
                }
            }else{
                $kelas = Kelas::findorfail($request->id_kelas);
                $id_member = $request->id_member;
                $id_kelas = $request->id_kelas;
                $bonus_deposit_paket = 0;
                $expired_kelas = null;
                $jmlh_kelas = $request->jmlh_kelas;
                $nominal_kelas = $kelas->harga_kelas * $jmlh_kelas;
                $total_deposit_kelas = $jmlh_kelas;
            }
            $cek = depositKelas::where('id_member', $id_member)
            ->where('id_kelas', $id_kelas)
            ->value('deposit_kelas.id');
            if(is_null($cek)){
                $transaksipaketkelas = TransaksiKelas::firstOrCreate([
                    'id_pegawai' => $request->id_pegawai,
                    'id_member'=> $id_member,
                    'id_promo' => $id_promo,
                    'id_kelas' => $id_kelas,
                    'tgl_deposit_kelas' => date('Y-m-d H:i:s', strtotime('now')),
                    'jmlh_kelas' => $jmlh_kelas,
                    'nominal_kelas' => $nominal_kelas,
                    'bonus_deposit_paket' => $bonus_deposit_paket,
                    'expired_kelas' => $expired_kelas,
                    'total_deposit_kelas' => $total_deposit_kelas,
                ]);
                //Update data di tabel member
                //cari data member
                $member = Member::find($request->id_member);
                $pegawai = Pegawai::find($request->id_pegawai);
                $deposit = new depositKelas();
                $deposit->id_member = $transaksipaketkelas->id_member;
                $deposit->id_kelas = $transaksipaketkelas->id_kelas;
                $deposit->sisa_deposit_kelas = $transaksipaketkelas->total_deposit_kelas;
                $deposit->masa_berlaku_deposit_kelas = $transaksipaketkelas->expired_kelas;
                $deposit->save();
                return response([
                    'message'=> 'Transaksi Deposit Paket Kelas Berhasil',
                    'data' => ['TransaksiKelas' => $transaksipaketkelas, 'deposit_kelas' => $deposit, 'sisa_deposit_kelas' => $deposit->sisa_deposit_kelas, 'nomor_struk_kelas' => TransaksiKelas::latest()->first()->no_struk_kelas, 'nama_member' => $member->nama_member, 'nomor_member' => $member->no_member, 'nama_pegawai' => $pegawai->nama_pegawai],
                    'total' => $total_deposit_kelas,
                ]);
            }else{
                $depositKelas = depositKelas::find($cek);
                $sisa = $depositKelas->sisa_deposit_kelas;
                if($sisa == 0){
                    $transaksipaketkelas = TransaksiKelas::firstOrCreate([
                        'id_pegawai' => $request->id_pegawai,
                        'id_member'=> $id_member,
                        'id_promo' => $id_promo,
                        'id_kelas' => $id_kelas,
                        'tgl_deposit_kelas' => date('Y-m-d H:i:s', strtotime('now')),
                        'jmlh_kelas' => $jmlh_kelas,
                        'nominal_kelas' => $nominal_kelas,
                        'bonus_deposit_paket' => $bonus_deposit_paket,
                        'expired_kelas' => $expired_kelas,
                        'total_deposit_kelas' => $total_deposit_kelas,
                    ]);
                    //Update data di tabel member
                    //cari data member
                    $member = Member::find($request->id_member);
                    $pegawai = Pegawai::find($request->id_pegawai);
                    $depositKelas -> update([
                        'sisa_deposit_kelas' => $total_deposit_kelas,
                        'masa_berlaku_kelas' => $expired_kelas
                    ]);
                    return response([
                        'message'=> 'Transaksi Deposit Paket Kelas Berhasil',
                        'data' => ['TransaksiKelas' => $transaksipaketkelas, 'deposit_kelas' => $depositKelas, 'sisa_deposit_kelas' => $depositKelas->sisa_deposit_kelas, 'nomor_struk_kelas' => TransaksiKelas::latest()->first()->no_struk_kelas, 'nama_member' => $member->nama_member, 'nomor_member' => $member->no_member, 'nama_pegawai' => $pegawai->nama_pegawai],
                        'total' => $total_deposit_kelas,
                    ]);
                }else{
                    return response(
                        ['message'=> 'Transaksi Hanya Dapat Dilakukan Jika Sisa Deposit 0',] , 400);
                }
            }

            

        } catch(Exception $e){
            dd($e);
        }
    }

    
}