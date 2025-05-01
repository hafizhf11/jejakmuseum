<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Provinsi;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        Post::create([
            'title' => 'Galeri Nasional Indonesia',
            'category_id' => 1,
            'slug' => 'galeri-nasional-indonesia',
            'image' => '',
            'provinsi' => 'DKI Jakarta',
            'kabupaten' => 'Kota Jakarta Pusat',
            'jumlah_koleksi' => '909',
            'pemilik' => 'Kementerian Pendidikan dan Kebudayaan (Belum dipastikan)',
            'tipe_terakhir' => 'B',
            'nomor_pendaftaran' => '31.71.K.01.0175'
        ]);
            
        Post::create([
            'title' => 'Museum Listrik dan Energi Baru',
            'category_id' => 1,
            'slug' => 'museum-listrik-dan-energi-baru',
            'image' => '',
            'provinsi' => 'DKI Jakarta',
            'kabupaten' => 'Kota Jakarta Timur',
            'jumlah_koleksi' => '732',
            'pemilik' => 'PT. PLN (Persero) PUSDIKLAT',
            'tipe_terakhir' => 'A',
            'nomor_pendaftaran' => '31.75.K.01.0101'
        ]);
        
        Post::create([
            'title' => 'Museum Taman Prasasti',
            'category_id' => 2,
            'slug' => 'museum-taman-prasasti',
            'image' => '',
            'provinsi' => 'DKI Jakarta',
            'kabupaten' => 'Kota Jakarta Pusat',
            'jumlah_koleksi' => '5',
            'pemilik' => '-',
            'tipe_terakhir' => 'B',
            'nomor_pendaftaran' => '31.71.K.03.0191'
        ]);
        
        Post::create([
            'title' => "Museum Al-Qur'an PTIK",
            'category_id' => 3,
            'slug' => 'museum-al-quran-ptik',
            'provinsi' => 'DKI Jakarta',
            'kabupaten' => 'Kota Jakarta Selatan',
            'jumlah_koleksi' => '431',
            'pemilik' => '-',
            'tipe_terakhir' => 'C',
            'nomor_pendaftaran' => '31.74.K.06.0185'
        ]);

        Category::create([
            'name' => 'Pemerintah Pusat',
            'slug' => 'pemerintah-pusat']);

        Category::create([
            'name' => 'Pemerintah Daerah',
            'slug' => 'pemerintah-daerah']);

        Category::create([
            'name' => 'Setiap Orang',
            'slug' => 'setiap-orang']);
        
        User::create([
            'name' => 'Hafizh Fadhilah',
            'username' => 'Hafizh',
            'email' => 'admin123@gmail.com',
            'password' => bcrypt('password')
        ]);

    }
}
