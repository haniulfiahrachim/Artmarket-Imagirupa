<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Helpers\ShippingHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PesananController extends Controller

{

    public function index(Request $request)

    {

        $query = Pesanan::with(['karya.seniman', 'pembayaran'])
            ->where('pelanggan_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanans = $query->latest()->paginate(10)->withQueryString();

        return view('pelanggan.pesanan.index', compact('pesanans'));

    }



    public function show(Pesanan $pesanan)

    {

        if ($pesanan->pelanggan_id !== auth()->id()) {

            abort(403);

        }

        $pesanan->load(['karya.seniman.profile', 'pembayaran', 'chats.pengirim']);

        return view('pelanggan.pesanan.show', compact('pesanan'));

    }



    public function store(Request $request)

    {

        $request->validate([

            'karya_id' => 'required|exists:karyas,id',

        ]);



        $karya = Karya::findOrFail($request->karya_id);



        if ($karya->status_karya !== 'tersedia') {

            return back()->with('error', 'Karya ini sudah tidak tersedia.');

        }



        $existing = Pesanan::where('pelanggan_id', auth()->id())

            ->where('karya_id', $karya->id)

            ->whereNotIn('status_pesanan', ['selesai'])

            ->first();



        if ($existing) {

            return back()->with('error', 'Anda sudah memiliki pesanan aktif untuk karya ini.');

        }



        $pesanan = Pesanan::create([

            'pelanggan_id'    => auth()->id(),

            'karya_id'        => $karya->id,

            'tanggal_pesanan' => now()->toDateString(),

            'total_harga'     => $karya->harga,

            'status_pesanan'  => 'pending',

            'biaya_pengiriman'=> 0,

            'jarak_km'         => 0,

        ]);

        return redirect()->route('pelanggan.pesanan.show', $pesanan)

            ->with('success', 'Pesanan berhasil dibuat! Pilih opsi pengambilan lalu lakukan pembayaran.');
        
    }


public function pilihanPengambilan(Request $request, Pesanan $pesanan)
{
    if ($pesanan->pelanggan_id !== auth()->id()) {
        abort(403);
    }

    if ($pesanan->status_pesanan !== 'pending') {
        return back()->with('error', 'Opsi pengambilan hanya bisa diubah saat status pesanan masih Pending.');
    }

    $request->validate([
        'opsi_pengambilan'  => 'required|in:antar,ambil_sendiri',
        'alamat_pengiriman' => 'required_if:opsi_pengambilan,antar|nullable|string|max:500',
        'zona_index'        => 'required_if:opsi_pengambilan,antar|nullable|integer|min:0',
    ], [
        'alamat_pengiriman.required_if' => 'Alamat pengiriman wajib diisi.',
        'zona_index.required_if'        => 'Pilih estimasi jarak pengiriman Anda.',
    ]);

    $biayaPengiriman = 0;
    $jarakKm         = 0;
    $alamat          = null;

    if ($request->opsi_pengambilan === 'antar') {
        $zona = config('shipping.zona');
        $idx  = (int) $request->zona_index;

        if (!isset($zona[$idx])) {
            return back()->with('error', 'Zona pengiriman tidak valid.');
        }

        $biayaPengiriman = $zona[$idx]['biaya'];
        $jarakKm         = $zona[$idx]['max_km'];
        $alamat          = $request->alamat_pengiriman;
    }

    $pesanan->update([
        'opsi_pengambilan'  => $request->opsi_pengambilan,
        'alamat_pengiriman' => $alamat,
        'biaya_pengiriman'  => $biayaPengiriman,
        'jarak_km'          => $jarakKm,
        'total_harga'       => $pesanan->karya->harga + $biayaPengiriman,
    ]);

    $pesan = $request->opsi_pengambilan === 'antar'
        ? 'Opsi pengiriman dipilih. Biaya: Rp ' . number_format($biayaPengiriman, 0, ',', '.')
        : 'Opsi ambil sendiri dipilih. Silakan upload bukti pembayaran.';

    return back()->with('success', $pesan);
}

/**
 * AJAX: Hitung estimasi ongkir berdasarkan koordinat
 */
public function hitungOngkir(Request $request)
{
    $request->validate([
        'dest_lat' => 'required|numeric',
        'dest_lng' => 'required|numeric',
    ]);

    $originLat = config('shipping.origin_lat');
    $originLng = config('shipping.origin_lng');

    $jarakKm = ShippingHelper::hitungJarak(
        $originLat, $originLng,
        (float) $request->dest_lat,
        (float) $request->dest_lng
    );

    $hasil = ShippingHelper::hitungBiaya($jarakKm);

    return response()->json([
        'jarak_km'    => $jarakKm,
        'jarak_label' => number_format($jarakKm, 1) . ' km',
        'biaya'       => $hasil['biaya'] ?? 0,
        'biaya_label' => ShippingHelper::formatRupiah($hasil['biaya'] ?? 0),
        'zona_label'  => $hasil['zona_label'] ?? null,
        'status'      => $hasil['status'],
        'error'       => $hasil['error'] ?? null,
        'origin'      => config('shipping.origin_name'),
        'tabel_zona'  => ShippingHelper::tabelZona(),
    ]);
}

    public function uploadBukti(Request $request, Pesanan $pesanan)

    {

        if ($pesanan->pelanggan_id !== auth()->id()) {

            abort(403);
        }

        if (!$pesanan->opsi_pengambilan) {

            return back()->with('error', 'Pilih opsi pengambilan terlebih dahulu sebelum upload bukti pembayaran.');
        }
        $request->validate([

            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',

        ], [

            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'bukti_pembayaran.image'    => 'File harus berupa gambar.',
            'bukti_pembayaran.max'      => 'Ukuran file maksimal 2MB.',

        ]);

        $fileName = Str::uuid() . '.' . $request->bukti_pembayaran->extension();

        $request->bukti_pembayaran->move(public_path('uploads/pembayaran'), $fileName);

        Pembayaran::updateOrCreate(

            ['pesanan_id' => $pesanan->id],

            [

                'bukti_pembayaran'  => $fileName,
                'tanggal_bayar'     => now()->toDateString(),
                'status_pembayaran' => 'menunggu',
            ]

        );

        return back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');

    }

} 