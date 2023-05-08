<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Promo;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PegawaiResource;

class PromoController extends Controller
{
    public function index()
    {
        $promo = Promo::latest()->get();
        //render view with posts
        return new PegawaiResource(
            true,
            'List Data Promo',
            $promo
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_promo' => 'required',
            'jenis_promo' => 'required',
            'deskripsi_promo' => 'required',
            'minimal_deposit' => 'required',
            'bonus_promo' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $promo = Promo::create([
            'nama_promo' => $request->nama_promo,
            'jenis_promo' => $request->jenis_promo,
            'deskripsi_promo' => $request->deskripsi_promo,
            'minimal_deposit' => $request->minimal_deposit,
            'bonus_promo' => $request->bonus_promo
        ]);
        return new PromoResource(true, 'Data Promo Berhasil Ditambahkan!', $promo);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_promo' => 'required',
            'jenis_promo' => 'required',
            'deskripsi_promo' => 'required',
            'minimal_deposit' => 'required',
            'bonus_promo' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $promo = Promo::findOrFail($id);
        $promo->update([
            'nama_promo' => $request->nama_promo,
            'jenis_promo' => $request->jenis_promo,
            'deskripsi_promo' => $request->deskripsi_promo,
            'minimal_deposit' => $request->minimal_deposit,
            'bonus_promo' => $request->bonus_promo
        ]);
        return new PromoResource(true, 'Data Promo berhasil diubah!', $promo);
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        return new PromoResource(true, 'Data Promo berhasil dihapus!', $promo);
    }

    public function show($id)
    {
        $promo= Promo::find($id);

        if(!is_null($promo)){
            return response([
                'message' => 'Data Promo Ditemukan',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Data Promo Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }

}