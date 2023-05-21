<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Instruktur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeaktivasiController extends Controller
{
    public function memberKadeluarsa()
    {
        $today = Carbon::today();

        $members = Member::where('masa_berlaku_member', '<=', $today)
        ->whereNotNull('masa_berlaku_member')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'Success Tampil Member',
            'data' => $members,
        ]);

    }

    public function absenInstruktur(){
        $instruktur = Instruktur::where('jmlh_keterlambatan','>','null')
        ->whereNotNull('jmlh_keterlambatan')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Success Tampil Instruktur',
            'data' => $instruktur,
        ]);
    }

    public function resetInstruktur(){
        $instrukturs = Instruktur::where('jmlh_keterlambatan','>','null')
        ->get();
        foreach ($instrukturs as $instruktur) {
            $instruktur->fill([
                    'jmlh_keterlambatan' => null,                // add more attributes to reset to 0 as necessary
                ]);
            $instruktur->save();
            }
            return response()->json([
                'success' => true,
                'message' => 'Apakah Anda Ingin Mereset Keterlambatan Instruktur',
                'data' => $instrukturs,
            ]);
    }


    public function memberDeaktivasi()
    {
        $today = Carbon::today();

        $members = Member::where('masa_berlaku_member', '<=', $today)
                          ->get();

        foreach ($members as $member) {
        $member->fill([
                'status_membership' => 'Tidak Aktif',
                'masa_berlaku_member' => null,                // add more attributes to reset to 0 as necessary
            ]);
        $member->save();
    }
    return response()->json([
        'success' => true,
        'message' => 'Apakah Anda Ingin Mendeaktivasi Member',
        'data' => $members,
    ]);
    }
}