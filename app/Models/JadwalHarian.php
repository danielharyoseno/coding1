<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalHarian extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_instruktur',
        'id_jadwal_umum',
        'tanggal_kelas',
        'keterangan'
    ]; 


    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur', 'id');

    }
    public function jadwal_umum()
    {
        return $this->belongsTo(Kelas::class, 'id_jadwal_umum', 'id');

    }

    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}