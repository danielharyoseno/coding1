<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Member;
use App\Models\Pegawai;
use App\Models\TransaksiDeposit;
use Exception;
use Illuminate\Http\Request;

class TransaksiDepositController extends Controller
{
    public function store(Request $request)
    {

        if($request->nominal_deposit <= 500000 ){
            return response(
                ['message'=> 'Minimal Deposit Rp 500.000',] , 400);
        }
        try
        {
            $id_promo = null;
            if($request->id_promo != null){
                $promo = Promo::findorfail($request->id_promo);
                $minimal_deposit = $promo->minimal_deposit;
                $nominal_deposit = $request->nominal_deposit;
                $total_deposit = $request->nominal_deposit;
                if($minimal_deposit <= $nominal_deposit){
                    $id_promo = $request->id_promo;
                    $bonus_deposit = $promo->bonus_promo;
                    $total_deposit += $promo->bonus_promo;
                }else{
                    $id_promo = null;
                    $bonus_deposit = 0;
                    $total_deposit = $nominal_deposit;
                }
                
            }else{
                $nominal_deposit = $request->nominal_deposit;
                $bonus_deposit = 0;
                $total_deposit = $nominal_deposit;
            }

            $depositUang = TransaksiDeposit::firstOrCreate  ([
                'tgl_deposit' => date('Y-m-d H:i:s', strtotime('now')),
                'nominal_deposit' => $nominal_deposit,
                'bonus_deposit' => $bonus_deposit,
                'total_deposit' => $total_deposit,
                'id_pegawai' => $request->id_pegawai,
                'id_member'=> $request->id_member,
                'id_promo' => $id_promo,
                'no_struk_deposit' => '' 
            ]);
            
            $member = Member::find($request->id_member);
            $sebelum_transaksi = $member->saldo_deposit_member;
            $member->saldo_deposit_member =  $sebelum_transaksi + $total_deposit;
            $member->save();
            return response([
                'message'=> 'Berhasil Melakukan Transaksi',
                'data' => ['transaksi_deposit_uang' => $depositUang, 'sisa_deposit' => $sebelum_transaksi, 'no_struk' => TransaksiDeposit::latest()->first()->no_struk_deposit, 'Member' => $member->nama_member],
                'total' => $total_deposit,
            ]);

        } catch(Exception $e){
            dd($e);
        }
        
    }
}