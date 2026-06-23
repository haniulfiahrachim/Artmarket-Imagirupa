<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\User;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Karya::with(['seniman.profile'])
            ->where('status_karya', 'tersedia');

        // Search
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter sort
        switch ($request->get('sort', 'terbaru')) {
            case 'terlaris':
                $query->withCount('pesanans')->orderByDesc('pesanans_count');
                break;
            case 'harga_terendah':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_tertinggi':
                $query->orderBy('harga', 'desc');
                break;
            default:
                $query->orderByDesc('created_at');
                break;
        }

        $karyas = $query->paginate(12)->withQueryString();

        return view('public.gallery', compact('karyas'));
    }

    public function show(Karya $karya)
    {
        $karya->load(['seniman.profile', 'seniman.karyas' => function ($q) use ($karya) {
            $q->where('id', '!=', $karya->id)->where('status_karya', 'tersedia')->limit(4);
        }]);

        return view('public.detail-karya', compact('karya'));
    }

    public function senimanProfile(User $user)
    {
        if (!$user->isSeniman()) {
            abort(404);
        }

        $user->load('profile');
        $karyas = Karya::where('seniman_id', $user->id)
            ->where('status_karya', 'tersedia')
            ->latest()
            ->paginate(9);

        return view('public.profil-seniman', compact('user', 'karyas'));
    }
}
