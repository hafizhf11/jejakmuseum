<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        // Ambil semua user biasa (is_admin = 0), urutkan dari terbaru
        $users = User::where('is_admin', 0)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('dashboard.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Mencegah menghapus diri sendiri atau user admin
        if ($user->is_admin || $user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun admin atau akun Anda sendiri.');
        }
        
        // Hapus user
        $user->delete();
        
        return redirect('/dashboard/users')->with('success', 'User berhasil dihapus!');
    }
}