<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BengkelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bengkels')->insert([
            ['name'=>'Bengkel Ahass Honda Yogya','address'=>'Jl. Magelang No. 45','city'=>'Yogyakarta','phone'=>'0274-561234','rating'=>4.8,'specialization'=>'Honda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Auto 2000 Yogyakarta','address'=>'Jl. Solo Km 8','city'=>'Yogyakarta','phone'=>'0274-881234','rating'=>4.7,'specialization'=>'Toyota','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bengkel Umum Pak Joko','address'=>'Jl. Wates No. 22','city'=>'Yogyakarta','phone'=>'0812-3456789','rating'=>4.5,'specialization'=>'Semua Merek','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Suzuki Service Center Yogya','address'=>'Jl. Bantul No. 78','city'=>'Yogyakarta','phone'=>'0274-371234','rating'=>4.6,'specialization'=>'Suzuki','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Fast Wheel Autocare','address'=>'Jl. Godean No. 12','city'=>'Yogyakarta','phone'=>'0274-620001','rating'=>4.4,'specialization'=>'Ban & Velg','is_verified'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bengkel Resmi Astra Honda Jakarta','address'=>'Jl. Yos Sudarso No. 5','city'=>'Jakarta','phone'=>'021-6512345','rating'=>4.9,'specialization'=>'Honda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Auto Workshop Jakarta Selatan','address'=>'Jl. TB Simatupang No. 10','city'=>'Jakarta','phone'=>'021-7891234','rating'=>4.6,'specialization'=>'Semua Merek','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Daihatsu Sales Operation Jakarta','address'=>'Jl. Dewi Sartika No. 34','city'=>'Jakarta','phone'=>'021-8001234','rating'=>4.5,'specialization'=>'Daihatsu','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bengkel Resmi Yamaha Bandung','address'=>'Jl. Soekarno Hatta No. 550','city'=>'Bandung','phone'=>'022-7312345','rating'=>4.7,'specialization'=>'Yamaha','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mitsubishi Service Center Bandung','address'=>'Jl. Asia Afrika No. 22','city'=>'Bandung','phone'=>'022-4231234','rating'=>4.5,'specialization'=>'Mitsubishi','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Toyota Auto 2000 Surabaya','address'=>'Jl. Basuki Rahmat No. 80','city'=>'Surabaya','phone'=>'031-5231234','rating'=>4.8,'specialization'=>'Toyota','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Honda AHASS Surabaya Timur','address'=>'Jl. Rungkut Industri No. 15','city'=>'Surabaya','phone'=>'031-8712345','rating'=>4.6,'specialization'=>'Honda','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bengkel Umum Semarang Jaya','address'=>'Jl. Pandanaran No. 60','city'=>'Semarang','phone'=>'024-8412345','rating'=>4.4,'specialization'=>'Semua Merek','is_verified'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Nissan Service Semarang','address'=>'Jl. MT Haryono No. 900','city'=>'Semarang','phone'=>'024-7612345','rating'=>4.5,'specialization'=>'Nissan','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bengkel Prima Motor Solo','address'=>'Jl. Slamet Riyadi No. 200','city'=>'Solo','phone'=>'0271-712345','rating'=>4.6,'specialization'=>'Semua Merek','is_verified'=>1,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}