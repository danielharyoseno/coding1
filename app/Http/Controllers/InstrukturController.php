<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instruktur;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InstrukturResource;


class InstrukturController extends Controller
{
    public function index()
    {
        $instruktur = Instruktur::latest()->get();
        //render view with posts
        return new InstrukturResource(
            true,
            'List Data Instruktur',
            $instruktur
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_instruktur' => 'required',
            'notel_instruktur' => 'required',
            'jmlh_keterlambatan' => 'required',
            'email_instruktur' => 'required',
            'password_instruktur' => 'required',
            'username_instruktur' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $instruktur = Instruktur::create([
            'nama_instruktur' => $request->nama_instruktur,
            'notel_instruktur' => $request->notel_instruktur,
            'jmlh_keterlambatan' => $request->jmlh_keterlambatan,
            'email_instruktur' => $request->email_instruktur,
            'password_instruktur' => $request->password_instruktur,
            'username_instruktur' => $request->username_instruktur
        ]);
        return new InstrukturResource(true, 'Data Member Berhasil Ditambahkan!', $instruktur);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_instruktur' => 'required',
            'notel_instruktur' => 'required',
            'jmlh_keterlambatan' => 'required',
            'email_instruktur' => 'required',
            'password_instruktur' => 'required',
            'username_instruktur' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $instruktur = Instruktur::findOrFail($id);
        $instruktur->update([
            'nama_instruktur' => $request->nama_instruktur,
            'notel_instruktur' => $request->notel_instruktur,
            'jmlh_keterlambatan' => $request->jmlh_keterlambatan,
            'email_instruktur' => $request->email_instruktur,
            'password_instruktur' => $request->password_instruktur,
            'username_instruktur' => $request->username_instruktur
        ]);
        return new InstrukturResource(true, 'Data Member berhasil diubah!', $instruktur);
    }

    public function destroy($id)
    {
        $instruktur = Instruktur::findOrFail($id);
        $instruktur->delete();
        return new InstrukturResource(true, 'Data Member berhasil dihapus!', $instruktur);
    }

    public function show($id)
    {
        $instruktur= Instruktur::find($id);

        if(!is_null($instruktur)){
            return response([
                'message' => 'Data Instruktur Ditemukan',
                'data' => $instruktur
            ], 200);
        }

        return response([
            'message' => 'Data Instruktur Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }

}