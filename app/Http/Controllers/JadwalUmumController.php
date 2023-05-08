<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalUmum;
use App\Models\Kelas;
use App\Models\Instruktur;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JadwalUmumResource;

class JadwalUmumController extends Controller
{
    public function index()
    {
        //get jadwalUmum
        $jadwalUmum = DB::table('jadwal_umums')
        ->join('kelas', 'jadwal_umums.id_kelas', '=', 'kelas.id')
        ->join('instrukturs', 'jadwal_umums.id_instruktur', '=', 'instrukturs.id')
        ->select('jadwal_umums.hari as hari', 'jadwal_umums.jam_mulai as jam', 'jadwal_umums.id as id' ,
        'kelas.nama_kelas as kelas', 'instrukturs.nama_instruktur as instruktur')
        ->get();
        //render view with posts
        return new JadwalUmumResource(
            true,
            'List Data Jadwal Umum',
            $jadwalUmum
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jam_mulai' => 'required',
            'hari' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kelas = Kelas::where('nama_kelas',$request->id_kelas)->first();
        $instruktur = Instruktur::where('nama_instruktur',$request->id_instruktur)->first();
        //Fungsi Post ke Database
        $jadwalumum = JadwalUmum::create([
            'jam_mulai' => $request->jam_mulai,
            'hari' => $request->hari,
            'id_kelas' => $kelas->id,
            'id_instruktur' => $instruktur->id
        ]);
        return new JadwalUmumResource(true, 'Data Jadwal Umum Berhasil Ditambahkan!', $jadwalumum);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jam_mulai' => 'required',
            'hari' => 'required',
            'id_kelas' => 'required',
            'id_instruktur' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $jadwalumum = JadwalUmum::findOrFail($id);

        $kelas = Kelas::where('nama_kelas',$request->id_kelas)->first();
        $instruktur = Instruktur::where('nama_instruktur',$request->id_instruktur)->first();
        //Fungsi Post ke Database
        $jadwalumum->update([
            'jam_mulai' => $request->jam_mulai,
            'hari' => $request->hari,
            'id_kelas' => $kelas->id,
            'id_instruktur' => $instruktur->id
        ]);
        return new JadwalUmumResource(true, 'Data Jadwal Umum berhasil diubah!', $jadwalumum);
    }

    public function destroy($id)
    {
        $jadwalumum = JadwalUmum::findOrFail($id);
        $jadwalumum->delete();
        return new JadwalUmumResource(true, 'Data Jadwal Umum berhasil dihapus!', $jadwalumum);
    }

    public function show($id)
    {
        $jadwalumum= JadwalUmum::find($id);

        if(!is_null($jadwalumum)){
            return response([
                'message' => 'Data Jadwal Umum Ditemukan',
                'data' => $jadwalumum
            ], 200);
        }

        return response([
            'message' => 'Data Jadwal Umum Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }

    
}