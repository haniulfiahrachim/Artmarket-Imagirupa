<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Pola yang dilarang
    private array $forbiddenPatterns = [
        '/\b08[0-9]{8,11}\b/',                          // No HP Indonesia: 08xx
        '/\b62[0-9]{8,12}\b/',                          // Format +62
        '/\+62[0-9]{8,12}\b/',                          // +62xxx
        '/\b0[0-9]{2,3}-[0-9]{6,9}\b/',                // Format 0xx-xxxxxxx
        '/whatsapp|whatsap|wa\.me|wa me/i',             // WA
        '/telegram|t\.me/i',                             // Telegram
        '/instagram|ig\s*[:=@]|insta\s*[:=@]/i',       // Instagram mention
        '/line\s*[:=@id]/i',                             // Line
        '/transfer\s*(ke|via|bca|bni|bri|mandiri|dana|ovo|gopay|shopeepay)/i', // Transfer di luar
        '/bayar\s*(langsung|diluar|ke\s*aku|ke\s*saya)/i',
        '/deal\s*(diluar|langsung|offline)/i',
        '/ketemu\s*(langsung|offline)/i',
    ];

    public function send(Request $request, Pesanan $pesanan)
    {
        $user = auth()->user();

        $isSeniman   = $user->isSeniman() && $pesanan->karya->seniman_id === $user->id;
        $isPelanggan = $user->isPelanggan() && $pesanan->pelanggan_id === $user->id;

        if (!$isSeniman && !$isPelanggan) {
            abort(403);
        }

        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        $pesan = $request->pesan;

        // Cek pola terlarang
        foreach ($this->forbiddenPatterns as $pattern) {
            if (preg_match($pattern, $pesan)) {
                return back()->with('chat_error',
                    'Pesan tidak dapat dikirim. Dilarang mencantumkan nomor telepon, kontak, atau ajakan transaksi di luar platform.');
            }
        }

        // Cek jumlah digit dalam pesan (lebih dari 6 digit berurutan = mencurigakan)
        if (preg_match('/\d{6,}/', preg_replace('/\s+/', '', $pesan))) {
            return back()->with('chat_error',
                'Pesan tidak dapat dikirim. Dilarang mencantumkan nomor telepon atau informasi kontak pribadi.');
        }

        $penerimaId = $user->isPelanggan()
            ? $pesanan->karya->seniman_id
            : $pesanan->pelanggan_id;

        Chat::create([
            'pengirim_id' => $user->id,
            'penerima_id' => $penerimaId,
            'pesanan_id'  => $pesanan->id,
            'pesan'       => $pesan,
            'waktu_kirim' => now(),
        ]);

        return back()->with('chat_success', 'Pesan terkirim.');
    }

    public function getMessages(Pesanan $pesanan)
    {
        $user = auth()->user();
        $isSeniman   = $user->isSeniman() && $pesanan->karya->seniman_id === $user->id;
        $isPelanggan = $user->isPelanggan() && $pesanan->pelanggan_id === $user->id;

        if (!$isSeniman && !$isPelanggan) {
            abort(403);
        }

        $chats = Chat::with('pengirim')
            ->where('pesanan_id', $pesanan->id)
            ->orderBy('waktu_kirim')
            ->get()
            ->map(fn($c) => [
                'id'       => $c->id,
                'pesan'    => $c->pesan,
                'pengirim' => $c->pengirim->nama,
                'waktu'    => $c->waktu_kirim->format('H:i d/m/Y'),
                'is_mine'  => $c->pengirim_id === $user->id,
            ]);

        return response()->json($chats);
    }
}