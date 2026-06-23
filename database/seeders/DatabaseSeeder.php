<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Karya;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ADMIN =====
        $admin = User::create([
            'nama'        => 'Admin Imagirupa',
            'email'       => 'admin@imagirupa.com',
            'password'    => Hash::make('password'),
            'role'        => 'admin',
            'status_akun' => 'verified',
        ]);
        Profile::create([
            'user_id' => $admin->id,
            'bio'     => 'Administrator sistem Imagirupa Art Market.',
            'kota'    => 'Pontianak',
        ]);

        // ===== SENIMAN 1 =====
        $seniman1 = User::create([
            'nama'        => 'Andi Prasetyo',
            'email'       => 'andi@imagirupa.com',
            'password'    => Hash::make('password'),
            'role'        => 'seniman',
            'status_akun' => 'verified',
        ]);
        Profile::create([
            'user_id'         => $seniman1->id,
            'bio'             => "Seniman digital asal Pontianak yang mengspesialisasikan diri dalam lukisan abstrak dan ilustrasi digital. Telah berkarya lebih dari 5 tahun dengan ratusan karya yang tersebar di seluruh Indonesia.\n\nSaya percaya bahwa seni adalah bahasa universal yang mampu menyentuh hati siapa saja tanpa batas budaya dan bahasa. Setiap karya saya terinspirasi dari keindahan alam Kalimantan Barat dan dinamika kehidupan masyarakatnya.",
            'spesialisasi'    => 'Ilustrasi Digital, Lukisan Abstrak',
            'kota'            => 'Pontianak, Kalimantan Barat',
            'link_portofolio' => 'https://behance.net/andiprasetyo',
            'instagram'       => 'andiprasetyo.art',
            'twitter'         => 'andiprasetyo_',
            'facebook'        => 'andiprasetyo.art',
            'tiktok'          => 'andiprasetyo.art',
            'website'         => 'www.andiprasetyo.art',
        ]);

        // ===== SENIMAN 2 =====
        $seniman2 = User::create([
            'nama'        => 'Dewi Sartika',
            'email'       => 'dewi@imagirupa.com',
            'password'    => Hash::make('password'),
            'role'        => 'seniman',
            'status_akun' => 'verified',
        ]);
        Profile::create([
            'user_id'         => $seniman2->id,
            'bio'             => "Pecinta seni tradisional Kalimantan yang memadukan motif Dayak dengan sentuhan modern. Karya saya terinspirasi dari kekayaan budaya Borneo yang luar biasa kaya dan beragam.\n\nSebagai seniman perempuan Dayak, saya berkomitmen untuk melestarikan warisan budaya leluhur melalui medium seni kontemporer. Setiap goresan adalah penghormatan untuk tanah Borneo.",
            'spesialisasi'    => 'Seni Tradisional, Motif Dayak, Batik Digital',
            'kota'            => 'Pontianak, Kalimantan Barat',
            'link_portofolio' => 'https://artstation.com/dewisartika',
            'instagram'       => 'dewisartika.dayak',
            'youtube'         => 'DewisartikaArt',
            'facebook'        => 'dewisartika.dayak',
            'website'         => 'www.dewisartika-art.com',
        ]);

        // ===== SENIMAN 3 =====
        $seniman3 = User::create([
            'nama'        => 'Rizky Maulana',
            'email'       => 'rizky@imagirupa.com',
            'password'    => Hash::make('password'),
            'role'        => 'seniman',
            'status_akun' => 'pending',
        ]);
        Profile::create([
            'user_id'      => $seniman3->id,
            'bio'          => 'Seniman muda berbakat dari Pontianak, berfokus pada seni fotografi dan digital art. Sedang dalam proses verifikasi.',
            'spesialisasi' => 'Fotografi, Digital Art',
            'kota'         => 'Pontianak',
            'instagram'    => 'rizkymaulana.photo',
            'tiktok'       => 'rizkymaulana_',
        ]);

        // ===== SENIMAN 4 =====
        $seniman4 = User::create([
            'nama'        => 'Putri Handayani',
            'email'       => 'putri@imagirupa.com',
            'password'    => Hash::make('password'),
            'role'        => 'seniman',
            'status_akun' => 'verified',
        ]);
        Profile::create([
            'user_id'         => $seniman4->id,
            'bio'             => "Seniman watercolor dan sketsa dari Singkawang. Spesialis dalam potret dan lanskap alam Kalimantan Barat dengan teknik tradisional.\n\nSetiap tetes cat air yang saya tuangkan membawa cerita tentang keindahan alam Borneo yang tak ternilai. Bergabung dengan komunitas Imagirupa untuk berbagi karya dan semangat berkarya.",
            'spesialisasi'    => 'Watercolor, Sketsa, Potret',
            'kota'            => 'Singkawang, Kalimantan Barat',
            'link_portofolio' => 'https://behance.net/putrihandayani',
            'instagram'       => 'putri.watercolor',
            'twitter'         => 'putrihandayani_',
            'youtube'         => 'PutriWatercolorArt',
        ]);

        // ===== PELANGGAN =====
        $pelanggan1 = User::create([
            'nama'        => 'Budi Santoso',
            'email'       => 'budi@gmail.com',
            'password'    => Hash::make('password'),
            'role'        => 'pelanggan',
            'status_akun' => 'verified',
        ]);
        Profile::create(['user_id' => $pelanggan1->id, 'bio' => 'Kolektor seni dari Pontianak.', 'kota' => 'Pontianak']);

        $pelanggan2 = User::create([
            'nama'        => 'Siti Rahayu',
            'email'       => 'siti@gmail.com',
            'password'    => Hash::make('password'),
            'role'        => 'pelanggan',
            'status_akun' => 'verified',
        ]);
        Profile::create(['user_id' => $pelanggan2->id, 'kota' => 'Pontianak']);

        // ===== KARYA =====
        $karyas = [
            ['seniman_id'=>$seniman1->id,'judul'=>'Abstrak Khatulistiwa','deskripsi'=>'Lukisan digital abstrak yang terinspirasi dari keindahan kota Pontianak di garis khatulistiwa. Perpaduan warna hangat merah-oranye dengan sentuhan emas menggambarkan semangat dan kehangatan masyarakat Borneo.','harga'=>750000,'gambar'=>'placeholder-1.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman1->id,'judul'=>'Senja di Kapuas','deskripsi'=>'Karya seni digital yang menangkap keindahan senja di Sungai Kapuas, sungai terpanjang di Indonesia. Langit berwarna merah membara dan pantulan cahaya di permukaan air menciptakan suasana magis yang menenangkan.','harga'=>950000,'gambar'=>'placeholder-2.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman1->id,'judul'=>'Batik Dayak Fusion','deskripsi'=>'Kolaborasi unik antara motif batik tradisional dengan ornamen dayak khas Kalimantan Barat. Karya ini merupakan eksplorasi identitas budaya yang kaya dari Bumi Khatulistiwa.','harga'=>1200000,'gambar'=>'placeholder-3.jpg','status_karya'=>'terjual'],
            ['seniman_id'=>$seniman2->id,'judul'=>'Mandau Spirit','deskripsi'=>'Ilustrasi digital bergaya realis yang menampilkan keagungan senjata tradisional Dayak, Mandau. Karya ini adalah penghormatan kepada para leluhur dan penjaga tanah Borneo.','harga'=>1500000,'gambar'=>'placeholder-4.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman2->id,'judul'=>'Rumah Betang Modern','deskripsi'=>'Interpretasi modern dari Rumah Betang, rumah adat suku Dayak Kalimantan. Arsitektur tradisional yang dipadukan dengan elemen kontemporer dalam medium digital painting.','harga'=>2000000,'gambar'=>'placeholder-5.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman2->id,'judul'=>'Enggang Kenyalang','deskripsi'=>'Lukisan burung Enggang Gading, burung ikonik Kalimantan yang sarat makna dalam budaya Dayak. Dibuat dengan teknik digital painting dengan detail yang sangat tinggi.','harga'=>850000,'gambar'=>'placeholder-6.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman4->id,'judul'=>'Danau Sentarum','deskripsi'=>'Lukisan watercolor Danau Sentarum, danau musiman terbesar di Indonesia yang terletak di Kalimantan Barat. Keindahan alam yang autentik ditangkap dengan kuas yang lembut.','harga'=>650000,'gambar'=>'placeholder-7.jpg','status_karya'=>'tersedia'],
            ['seniman_id'=>$seniman4->id,'judul'=>'Potret Ibu Dayak','deskripsi'=>'Sketsa potret seorang ibu Dayak dengan pakaian tradisional. Ekspresi wajah yang bijaksana dan penuh kasih sayang diabadikan dalam sapuan kuas watercolor yang elegan.','harga'=>900000,'gambar'=>'placeholder-8.jpg','status_karya'=>'tersedia'],
        ];

        foreach ($karyas as $k) {
            Karya::create($k);
        }

        // ===== PESANAN =====
        $karya1 = Karya::where('judul','Abstrak Khatulistiwa')->first();
        $karya3 = Karya::where('judul','Batik Dayak Fusion')->first();
        $karya4 = Karya::where('judul','Mandau Spirit')->first();

        $pesanan1 = Pesanan::create([
            'pelanggan_id'=>$pelanggan1->id,'karya_id'=>$karya1->id,
            'tanggal_pesanan'=>now()->subDays(5)->toDateString(),
            'total_harga'=>$karya1->harga,'status_pesanan'=>'selesai',
        ]);
        $pesanan2 = Pesanan::create([
            'pelanggan_id'=>$pelanggan1->id,'karya_id'=>$karya4->id,
            'tanggal_pesanan'=>now()->subDays(2)->toDateString(),
            'total_harga'=>$karya4->harga,'status_pesanan'=>'dibayar',
        ]);
        $pesanan3 = Pesanan::create([
            'pelanggan_id'=>$pelanggan2->id,'karya_id'=>$karya3->id,
            'tanggal_pesanan'=>now()->subDays(10)->toDateString(),
            'total_harga'=>$karya3->harga,'status_pesanan'=>'selesai',
        ]);

        // ===== PEMBAYARAN =====
        Pembayaran::create(['pesanan_id'=>$pesanan1->id,'bukti_pembayaran'=>'dummy-bukti.jpg','tanggal_bayar'=>now()->subDays(4)->toDateString(),'status_pembayaran'=>'disetujui']);
        Pembayaran::create(['pesanan_id'=>$pesanan2->id,'bukti_pembayaran'=>'dummy-bukti.jpg','tanggal_bayar'=>now()->subDays(1)->toDateString(),'status_pembayaran'=>'disetujui']);
        Pembayaran::create(['pesanan_id'=>$pesanan3->id,'bukti_pembayaran'=>'dummy-bukti.jpg','tanggal_bayar'=>now()->subDays(9)->toDateString(),'status_pembayaran'=>'disetujui']);

        // ===== CHAT =====
        Chat::create(['pengirim_id'=>$pelanggan1->id,'penerima_id'=>$seniman1->id,'pesanan_id'=>$pesanan1->id,'pesan'=>'Halo kak, saya sudah transfer. Mohon dikonfirmasi ya!','waktu_kirim'=>now()->subDays(4)]);
        Chat::create(['pengirim_id'=>$seniman1->id,'penerima_id'=>$pelanggan1->id,'pesanan_id'=>$pesanan1->id,'pesan'=>'Siap kak, sudah kami konfirmasi. Terima kasih sudah membeli karya kami!','waktu_kirim'=>now()->subDays(4)->addHour()]);
        Chat::create(['pengirim_id'=>$pelanggan1->id,'penerima_id'=>$seniman2->id,'pesanan_id'=>$pesanan2->id,'pesan'=>'Apakah bisa dikirim dalam format file PNG resolusi tinggi?','waktu_kirim'=>now()->subDays(1)]);
        Chat::create(['pengirim_id'=>$seniman2->id,'penerima_id'=>$pelanggan1->id,'pesanan_id'=>$pesanan2->id,'pesan'=>'Tentu bisa! Akan kami siapkan file PNG 4K untuk Anda.','waktu_kirim'=>now()->subDays(1)->addMinutes(30)]);
    }
}
