<?php

namespace App\Http\Controllers;

use App\Models\BookingGym;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // public function aktivitasGymBulanan(Request $request){
    //     $bulan = Carbon::now()->month;
    //     if ($request->has('month') && !empty($request->month)){
    //         $bulan = $request->month;
    //     }

    //     $tanggalCetak = Carbon::now();
    //     $aktivitasGym = BookingGym::where('tgl_booking_gym','<',$tanggalCetak)
    //     ->where('status_presensi',"Hadir")
    //     ->where('tgl_booking_gym',$bulan)
    //     ->get()
    //     ->groupBy(function($item){
    //         $carbonDate = Carbon::createFromFormat('Y-m-d', $item->tgl_booking_gym);
    //         return $carbonDate->toDateTimeString();
    //     });

    //     $responseData = [];

    //     foreach ($aktivitasGym as $test => $grup) {
    //         $count = $grup->count();
    //         $responseData[] = [
    //             'tanggal' => $test,
    //             'count' => $count,
    //         ];
    //     }

    //     return response([
    //         'data' => $responseData,
    //         'tanggal_cetak' => $tanggalCetak
    //     ]);
    // }


    public function aktivitasGymBulanan(Request $request)
    {
        // date
        $bulan = Carbon::now()->month;
        if ($request->has('month') && !empty($request->month)) {
            $bulan = $request->month;
        }
    
        // Tanggal Cetak
        $tanggalCetak = Carbon::now();
        $aktivitasGym = BookingGym::where('tgl_reservasi_gym', '<', $tanggalCetak)
            ->where('status_presensi', "Hadir")
            ->whereMonth('tgl_reservasi_gym', $bulan)
            ->get()
            ->groupBy(function ($item) {
                // group by tanggal
                $carbonDate = Carbon::createFromFormat('Y-m-d', $item->tgl_reservasi_gym);
                return $carbonDate->toDateTimeString();
            });
    
        // Count
        $responseData = [];
    
        foreach ($aktivitasGym as $tanggal => $grup) {
            $count = $grup->Count();
            $responseData[] = [
                'tanggal' => $tanggal,
                'count' => $count,
            ];
        }
    
        return response([
            'data' => $responseData,
            'tanggal_cetak' => $tanggalCetak
        ]);
    }

    public function aktivitasKelasBulanan(Request $request)
    {
        $bulan = Carbon::now()->month;
        if ($request->has('month') && !empty($request->month)) {
            $bulan = $request->month;
        }
        // dd($bulan);
        //* Tanggal Cetak
        $tanggalCetak = Carbon::now();
        $aktivitasKelas = DB::select('
            SELECT k.nama_kelas AS kelas, i.nama_instruktur AS instruktur, COUNT(bk.no_booking_kelas) AS jumlah_peserta_kelas, 
                COUNT(CASE WHEN jh.keterangan = "diliburkan" THEN 1 ELSE NULL END) AS jumlah_libur
            FROM booking_kelas AS bk    
            JOIN jadwal_harians AS jh ON bk.id_harian = jh.id
            JOIN jadwal_umums AS ju ON jh.id_jadwal_umum = ju.id
            JOIN instrukturs AS i ON ju.id_instruktur = i.id
            JOIN kelas AS k ON ju.id_kelas = k.id
            WHERE MONTH(jh.tanggal_kelas) = ?
            GROUP BY k.nama_kelas, i.nama_instruktur
        ', [$bulan]);
    
        //akumulasi terlambat direset tiap bulan jam mulai tiap bulan - jam selesai bulan
        return response([
            'data' => $aktivitasKelas,
            'tanggal_cetak' => $tanggalCetak,
        ]);
        
    }
}