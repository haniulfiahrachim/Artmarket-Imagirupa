<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile')->where('role', '!=', 'admin');

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['profile', 'karyas', 'pesanans.karya']);
        return view('admin.users.show', compact('user'));
    }

    public function verifikasi(User $user)
    {
        if (!$user->isSeniman()) {
            return back()->with('error', 'Hanya akun seniman yang bisa diverifikasi.');
        }

        $user->update(['status_akun' => 'verified']);
        return back()->with('success', "Akun seniman {$user->nama} berhasil diverifikasi.");
    }

    public function tolakVerifikasi(User $user)
    {
        $user->update(['status_akun' => 'pending']);
        return back()->with('success', "Verifikasi akun {$user->nama} dibatalkan.");
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Admin tidak bisa dihapus.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
