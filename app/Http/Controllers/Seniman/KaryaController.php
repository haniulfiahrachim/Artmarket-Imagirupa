<?php

namespace App\Http\Controllers\Seniman;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KaryaController extends Controller
{
    public function index()
    {
        $karyas = Karya::where('seniman_id', auth()->id())
            ->latest()
            ->paginate(12);
        return view('seniman.karya.index', compact('karyas'));
    }

    public function create()
    {
        return view('seniman.karya.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'required|string',
            'harga'    => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'gambar'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required'    => 'Judul karya wajib diisi.',
            'deskripsi.required'=> 'Deskripsi wajib diisi.',
            'harga.required'    => 'Harga wajib diisi.',
            'gambar.required'   => 'Gambar karya wajib diupload.',
            'gambar.image'      => 'File harus berupa gambar.',
            'gambar.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);

        $gambarName = Str::uuid() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('uploads/karya'), $gambarName);

            Karya::create([
            'seniman_id'   => auth()->id(),
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'harga'        => $request->harga,
            'stok'         => $request->stok ?? 1,
            'gambar'       => $gambarName,
            'status_karya' => 'tersedia',
        ]);

        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil diupload!');
    }

    public function edit(Karya $karya)
    {
        $this->authorize_karya($karya);
        return view('seniman.karya.edit', compact('karya'));
    }

    public function update(Request $request, Karya $karya)
    {
        $this->authorize_karya($karya);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'required|string',
            'harga'    => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'harga'        => $request->harga,
            'stok'         => $request->stok ?? $karya->stok,
            'status_karya' => $request->stok > 0 ? 'tersedia' : 'terjual',
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($karya->gambar && file_exists(public_path('uploads/karya/' . $karya->gambar))) {
                unlink(public_path('uploads/karya/' . $karya->gambar));
            }
            $gambarName = Str::uuid() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/karya'), $gambarName);
            $data['gambar'] = $gambarName;
        }

        $karya->update($data);
        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil diperbarui!');
    }

    public function destroy(Karya $karya)
    {
        $this->authorize_karya($karya);

        if ($karya->gambar && file_exists(public_path('uploads/karya/' . $karya->gambar))) {
            unlink(public_path('uploads/karya/' . $karya->gambar));
        }
        $karya->delete();
        return redirect()->route('seniman.karya.index')->with('success', 'Karya berhasil dihapus.');
    }

    private function authorize_karya(Karya $karya): void
    {
        if ($karya->seniman_id !== auth()->id()) {
            abort(403);
        }
    }
}
