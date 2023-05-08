<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MemberResource;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::latest()->get();
        //render view with posts
        return new MemberResource(
            true,
            'List Data Member',
            $member
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'tgl_lahir' => 'required',
            'email_member' => 'required',
            'notel_member' => 'required',
            'username_member' => 'required',
            'password_member' => 'required',
            'saldo_deposit_member' => 'required',
            'masa_berlaku_member' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $member = Member::create([
            'nama_member' => $request->nama_member,
            'alamat_member' => $request->alamat_member,
            'tgl_lahir' => $request->tgl_lahir,
            'email_member' => $request->email_member,
            'notel_member' => $request->notel_member,
            'username_member' => $request->username_member,
            'password_member' => $request->password_member,
            'saldo_deposit_member' => $request->saldo_deposit_member,
            'masa_berlaku_member' => $request->masa_berlaku_member
        ]);
        return new MemberResource(true, 'Data Member Berhasil Ditambahkan!', $member);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'tgl_lahir' => 'required',
            'email_member' => 'required',
            'notel_member' => 'required',
            'username_member' => 'required',
            'password_member' => 'required',
            'saldo_deposit_member' => 'required',
            'masa_berlaku_member' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $member = Member::findOrFail($id);
        $member->update([
            'nama_member' => $request->nama_member,
            'alamat_member' => $request->alamat_member,
            'tgl_lahir' => $request->tgl_lahir,
            'email_member' => $request->email_member,
            'notel_member' => $request->notel_member,
            'username_member' => $request->username_member,
            'password_member' => $request->password_member,
            'saldo_deposit_member' => $request->saldo_deposit_member,
            'masa_berlaku_member' => $request->masa_berlaku_member
        ]);
        return new MemberResource(true, 'Data Member berhasil diubah!', $member);
    }

   /* public function resPw($id)
    {
        $member = Member::findOrFail($id);
        $member = update([
            'password_member' => tgl_lahir
        ]);
    }
    */

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return new MemberResource(true, 'Data Member berhasil dihapus!', $member);
    }

    public function show($id)
    {
        $member= Member::find($id);

        if(!is_null($member)){
            return response([
                'message' => 'Data Member Ditemukan',
                'data' => $member
            ], 200);
        }

        return response([
            'message' => 'Data Member Tidak Ditemukan',
            'data' => null
        ], 404); // return message saat data instruktur tidak ditemukan
    }


}