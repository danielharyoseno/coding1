<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinInstruktur extends Model
{
    protected $fillable = [
        'id_instruktur',
        'id_instruktur_pengganti',
        'id_jadwal_harian',
        'hari',
        'pengajuan_ijin',
        'tanggal_ijin',
        'sesi_ijin',
        'keterangan_ijin',
        'status',
        
    ];

    public function Instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur', 'id');

    }
    public function InstrukturPengganti()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur_pengganti', 'id');

    }
    public function jadwalHarian()
    {
        return $this->belongsTo(JadwalHarian::class, 'id_jadwal_harian', 'id');

    }
    use HasFactory;
}