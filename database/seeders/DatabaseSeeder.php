<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\member;
use App\Models\User;
use App\Models\Instruktur;
use App\Models\Pegawai;
use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Kelas::create([
            'nama_kelas'=>'Zumba',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '200000',
        ]);

        Kelas::create([
            'nama_kelas'=>'Muaythai',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '250000',
        ]);

        Kelas::create([
            'nama_kelas'=>'Karate',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '200000',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Jefrey',
            'notel_instruktur'=> '081231112',
            'jmlh_keterlambatan' => '0',
            'email_instruktur' => 'jefrey@gmail.com',
            'password_instruktur' =>'jefrey123',
            'username_instruktur'=>'jefrey123',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Elang',
            'notel_instruktur'=> '0812131',
            'jmlh_keterlambatan' => '2',
            'email_instruktur' => 'elang@gmail.com',
            'password_instruktur' =>'elang123',
            'username_instruktur'=>'elang123',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Grepin',
            'notel_instruktur'=> '08541231',
            'jmlh_keterlambatan' => '2',
            'email_instruktur' => 'grepin@gmail.com',
            'password_instruktur' =>'grepin123',
            'username_instruktur'=>'grepin123',
        ]);

        member::create([
            'nama_member' => 'Daniel',
            'alamat_member' => 'Bekasi',
            'tgl_lahir' => '2021-01-03',
            'email_member' => 'daniel@gmail.com',
            'notel_member' => '08771569',
            'username_member' =>'daniel123',
            'password_member' => 'daniel123',
            'saldo_deposit_member' => '100000',
            'masa_berlaku_member' => '2023-01-03',
        ]);

        member::create([
            'nama_member' => 'Vior',
            'alamat_member' => 'Sorong',
            'tgl_lahir' => '2019-11-05',
            'email_member' => 'vior@gmail.com',
            'notel_member' => '09812312',
            'username_member' =>'vior123',
            'password_member' => 'vior123',
            'saldo_deposit_member' => '200',
            'masa_berlaku_member' => '2023-05-09',
        ]);

        Promo::create([
            'nama_promo' => 'Promo Reguler Biasa',
            'jenis_promo' => 'Promo Reguler',
            'deskripsi_promo' => 'Pengisian Deposit Sebesar 2 Jt maka Mendapat Bonus 500 ribu',
            'minimal_deposit' => '2000000',
            'bonus_promo' => '500000',
        ]);
    }
    
}