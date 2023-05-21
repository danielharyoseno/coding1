<?php

namespace App\Http\Controllers;
use App\Models\IjinInstruktur;
use App\Models\Instruktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IjinInstrukturController extends Controller
{   
    // public function index(){
    //     $ijinInst = DB::table('ijin_instrukturs')
    //     ->join('instrukturs', 'ijin_instrukturs.id_instruktur', '=', 'instrukturs.id')
    //     ->join('instrukturs', 'ijin_instrukturs.id_instruktur_pengganti', '=', 'instrukturs.id')
    //     ->join('jadwal_harians', 'ijin_instrukturs.id_jadwal_harian', '=', 'jadwal_harians.id')
    //     ->join('jadwal_umums', 'jadwal_harians.id_jadwal umum', '=', 'jadwal_umums.id')
    //     ->join('kelas', 'jadwal_umums.id_kelas', '=', 'kelas.id')
    //     ->select('instrukturs.nama_instruktur as nama', 'instrukturs.nama_instruktur as nama_pengganti',
    //     'kelas.nama_kelas as nama_kelas','jadwal_umums.hari as hari', 'ijin_instrukturs.pengajuan_ijin as tgl_pengajuan', 'ijin_instrukturs.tanggal_ijin as tgl_ijin', 'ijin_instrukturs.sesi_ijin as sesi',
    //     'ijin_instrukturs.keterangan_ijin as alasan', 'ijin_instrukturs.status as status' )
    //     ->get();

    //     return new JadwalUmumResource(
    //         true,
    //         'List Ijin Instruktur',
    //         $ijinInst
    //     );

    // }

    public function index(){
        $ijin_instruktur = IjinInstruktur::with(['Instruktur','InstrukturPengganti'])->get();

        return response([
            'message'=>'Success Tampil Data',
            'data' => $ijin_instruktur
        ],200); 
    }
    public function update($id){

        $ijin_instruktur = IjinInstruktur::findOrFail($id);

        if($ijin_instruktur) {
            $ijin_instruktur->status_konfirmasi = $request->status_konfirmasi;
            $ijin_instruktur->save();

            return new InstrukturResource(true, 'Data Izin Instruktur Berhasil Diubah!', $ijin_instruktur);

        }

        return new InstrukturResource(false, 'Data Izin Instruktur Tidak Ditemukan!', $ijin_instruktur);
    }
}