<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\member;
use App\Models\User;
use App\Models\Instruktur;
use App\Models\Pegawai;
use App\Models\JadwalUmum;
use App\Models\Promo;
use App\Models\Gym;
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

        Kelas::create([
            'nama_kelas'=>'Bellydance',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '150000',
        ]);

        Kelas::create([
            'nama_kelas'=>'Calisthenics',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '200000',
        ]);

        Kelas::create([
            'nama_kelas'=>'Body Combat',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '200000',
        ]);

        Kelas::create([
            'nama_kelas'=>'Bungee',
            'jumlah_peserta'=>'10',
            'harga_kelas' => '150000',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Jefrey',
            'notel_instruktur'=> '081231112',
            'jmlh_keterlambatan' => '0',
            'email_instruktur' => 'jefrey@gmail.com',
            'password_instruktur' =>'jefrey123',
            'username_instruktur'=>'jefrey123',
        ]);

        // JadwalUmum::create([
        //     'jam_mulai' => '17:00:00',
        //     'hari' => 'Senin',
        //     'id_kelas' => '4',
        //     'id_instruktur' => '1',
        // ]);
        // JadwalUmum::create([
        //     'jam_mulai' => '18:30:00',
        //     'hari' => 'Selasa',
        //     'id_kelas' => '5',
        //     'id_instruktur' => '7',
        // ]);
        // JadwalUmum::create([
        //     'jam_mulai' => '09:00:00',
        //     'hari' => 'Rabu',
        //     'id_kelas' => '7',
        //     'id_instruktur' => '6',
        // ]);
        // JadwalUmum::create([
        //     'jam_mulai' => '09:30:00',
        //     'hari' => 'Sabtu',
        //     'id_kelas' => '1',
        //     'id_instruktur' => '2',
        // ]);
        // JadwalUmum::create([
        //     'jam_mulai' => '10:00:00',
        //     'hari' => 'Kamis',
        //     'id_kelas' => '3',
        //     'id_instruktur' => '3',
        // ]);
        // JadwalUmum::create([
        //     'jam_mulai' => '20:30:00',
        //     'hari' => 'Minggu',
        //     'id_kelas' => '2',
        //     'id_instruktur' => '4',
        // ]);

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

        Instruktur::create([
            'nama_instruktur'=>'Jono',
            'notel_instruktur'=> '1231231',
            'jmlh_keterlambatan' => '0',
            'email_instruktur' => 'jono@gmail.com',
            'password_instruktur' =>'jono123',
            'username_instruktur'=>'jono123',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Budi',
            'notel_instruktur'=> '12318132',
            'jmlh_keterlambatan' => '4',
            'email_instruktur' => 'budi@gmail.com',
            'password_instruktur' =>'budi123',
            'username_instruktur'=>'budi123',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Popol',
            'notel_instruktur'=> '81234341',
            'jmlh_keterlambatan' => '2',
            'email_instruktur' => 'popol@gmail.com',
            'password_instruktur' =>'popol123',
            'username_instruktur'=>'popol123',
        ]);

        Pegawai::create([
            'jabatan' =>'Kasir',
            'nama_pegawai'=>'Jono',
            'notel_pegawai'=> '123124',
            'email_pegawai' => 'jono@gmail.com',
        ]);

        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '7-9',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '9-11',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '11-13',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '13-15',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '15-17',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '17-19',
        ]);
        Gym::create([
            'kapasitas' => '10',
            'slot_waktu' => '19-21',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Asep',
            'notel_instruktur'=> '812356778',
            'jmlh_keterlambatan' => '3',
            'email_instruktur' => 'asep@gmail.com',
            'password_instruktur' =>'asep123',
            'username_instruktur'=>'asep123',
        ]);

        Instruktur::create([
            'nama_instruktur'=>'Samoht',
            'notel_instruktur'=> '81126778',
            'jmlh_keterlambatan' => '3',
            'email_instruktur' => 'thomas@gmail.com',
            'password_instruktur' =>'thomas123',
            'username_instruktur'=>'thomas123',
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

        member::create([
            'nama_member' => 'Joel',
            'alamat_member' => 'Boyolali',
            'tgl_lahir' => '2023-05-09',
            'email_member' => 'joel@gmail.com',
            'notel_member' => '813123123',
            'username_member' =>'joel',
            'password_member' => 'joel',
            'saldo_deposit_member' => '100',
            'masa_berlaku_member' => '2024-05-09',
        ]);

        member::create([
            'nama_member' => 'Zendaya',
            'alamat_member' => 'New York',
            'tgl_lahir' => '2023-05-09',
            'email_member' => 'zendaya@gmail.com',
            'notel_member' => '122317888',
            'username_member' =>'zendaya',
            'password_member' => 'zendaya',
            'saldo_deposit_member' => '4500000',
            'masa_berlaku_member' => '2024-05-09',
        ]);

        Promo::create([
            'nama_promo' => 'Promo Reguler Biasa',
            'jenis_promo' => 'Promo Reguler',
            'deskripsi_promo' => 'Pengisian Deposit Sebesar 3 Jt maka Mendapat Bonus 300 ribu',
            'minimal_deposit' => '3000000',
            'bonus_promo' => '300000',
        ]);

        Promo::create([
            'nama_promo' => 'Promo Reguler Biasa',
            'jenis_promo' => 'Promo Paket',
            'deskripsi_promo' => 'Bayar 5 sesi, gratis 1. Berlaku 1 bulan sejak pembayaran',
            'minimal_deposit' => '5',
            'bonus_promo' => '1',
        ]);

        Promo::create([
            'nama_promo' => 'Promo Reguler Biasa',
            'jenis_promo' => 'Promo Paket',
            'deskripsi_promo' => 'Bayar 10 sesi, gratis 3. Berlaku 2 bulan sejak pembayaran',
            'minimal_deposit' => '10',
            'bonus_promo' => '3',
        ]);
    }
    
}