<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use Illuminate\Http\Request;

class KaryaController extends Controller
{
    public function index(Request $request)
    {
        $query = Karya::with('seniman.profile');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status_karya', $request->status);
        }

        $karyas = $query->latest()->paginate(15)->withQueryString();
        return view('admin.karyas.index', compact('karyas'));
    }

    public function show(Karya $karya)
    {
        $karya->load('seniman.profile');
        return view('admin.karyas.show', compact('karya'));
    }

    public function destroy(Karya $karya)
    {
        if ($karya->gambar && file_exists(public_path('uploads/karya/' . $karya->gambar))) {
            unlink(public_path('uploads/karya/' . $karya->gambar));
        }
        $karya->delete();
        return redirect()->route('admin.karyas.index')->with('success', 'Karya berhasil dihapus.');
    }
}
