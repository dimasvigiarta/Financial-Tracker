<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() 
    {
        // 1. Cek apakah dia admin. Kalau bukan, tendang.
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user || !$user->is_admin) {
            abort(403, 'Akses Ditolak. Anda bukan Admin.');
        }

        // 2. Kalau dia admin, tampilkan datanya.
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }
}