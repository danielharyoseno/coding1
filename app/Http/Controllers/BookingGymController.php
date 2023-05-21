<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingGym;
use App\Models\Member;
use App\Models\Gym;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class BookingGymController extends Controller
{
    public function index()
    {
        //get booking gym
        $bookgym =  BookingGym::with(['member','gym'])->get();
        //render view with posts
        if(count($bookgym) > 0){
            return new MemberResource(true, 'List Data Booking Gym',
            $bookgym); // return data semua booking gym dalam bentuk json
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400); // return message data booking gym kosong
    }

    public function store(Request $request){
        try
        {
            $id_member = $request->id_member;
            $member = Member::find($id_member);
            $id_gym =  $request->id_gym;
            $gym = Gym::find($id_gym);
            $tgl_reserve = $request->tgl_reservasi_gym;

            if($member->status_membership == "Tidak Aktif"){
                return response(
                    ['message'=> 'Maaf Status Member Anda Tidak Aktif',] , 400);
            }else if($gym->kapasitas == "0"){
                return response(
                    ['message'=> 'Maaf Kapasitas Gym Sudah Penuh',] , 400);
            }else{
                $cek = BookingGym::where('id_member', $id_member)->value('booking_gyms.tgl_reservasi_gym');
                if($tgl_reserve == $cek ){
                    return response(
                        ['message'=> 'Anda Hanya Dapat Melakukan Booking Gym 1x Sehari',]
                    ,400);
                }else{
                    $bookingGym = BookingGym::firstOrCreate([
                        'id_member' => $request->id_member,
                        'id_gym' => $request->id_gym,
                        'tgl_reservasi_gym' => $request->tgl_reservasi_gym, //tgl pilihan memmber buat gym
                        'tgl_booking_gym' => date('Y-m-d H:i:s', strtotime('now')), //tgl_transaksi
                    ]);
                    $gym = Gym::find($request->id_gym);
                    $gym->kapasitas -= 1; 
                    $gym->save();
                    return response([
                        'message' => 'Booking Gym Berhasil',
                        'data' => ['Booking_Gym'=>$bookingGym, 'Gym'=>$gym, 'no_booking_gym'=>BookingGym::latest()->first()->no_booking_gym, 'nama_member'=>$member->nama_member, 'nomor_member' => $member->no_member, 'sesi_gym' =>$gym->id, 'sisa_kapasitas' =>$gym->kapasitas],
                    ]);
                }
                
            }

        } catch(Exception $e){
            dd($e);
        }
    }

    public function destroy($id)
    {
        $today = Carbon::today();
        $batalGym = BookingGym::findOrFail($id);
        if($batalGym->tgl_reservasi_gym > $today){
            $batalGym->delete();
            return new MemberResource(true, 'Data Jadwal Umum berhasil dihapus!', $batalGym);
        }else{
            return response(
                ['message'=> 'Pembatalan Hanya Dapat Dilakukan H-1 Tanggal Reservasi ',]
            ,400);
        }
       
    }
}