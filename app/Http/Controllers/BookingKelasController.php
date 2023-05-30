<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class BookingKelasController extends Controller
{
    public function index(){
        $bookKelas = DB::table('booking_kelas')
        ->join('members','booking_kelas.id_member','=','members.id')
        ->join('deposit_kelas','booking_kelas.id_deposit','=','deposit_kelas.id')
        ->join('jadwal_harians','booking_kelas.id_harian','=','jadwal_harians.id')
        ->join('jadwal_umums','jadwal_harians.id_jadwal_umum','=','jadwal_umums.id')
        ->join('kelas','jadwal_umums.id_kelas','=','kelas.id')
        ->join('instrukturs','jadwal_umums.id_instruktur','=','instrukturs.id')
        ->select('booking_kelas.id as id','booking_kelas.no_booking_kelas as no_book','members.nama_member as nama','members.no_member as no_member',
        'kelas.nama_kelas as nama_kelas','kelas.harga_kelas as tarif','deposit_kelas.sisa_deposit_kelas as sisa_deposit','instrukturs.nama_instruktur as nama_instruktur',
        'booking_kelas.tgl_booking_kelas as tgl_booking','booking_kelas.tgl_reservasi_kelas as tgl_reserve','booking_kelas.waktu_presensi_kelas as waktu_presensi', 
        'booking_kelas.status_presensi as status','booking_kelas.tipe_booking as tipe','deposit_kelas.masa_berlaku_deposit_kelas as expired','members.saldo_deposit_member as saldo','jadwal_umums.jam_mulai as jam_kelas')
        ->get();
        return new MemberResource(true, 'List Data Booking Kelas', $bookKelas);
    }
}