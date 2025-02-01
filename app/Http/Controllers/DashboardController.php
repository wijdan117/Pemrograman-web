<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::count();
        $users = User::count(); // Pindahkan di atas dan gabungkan dengan array view

        return view('dashboard.dashboard', [
            'barang' => $barang,
            'users' => $users, // Kirim variabel users ke view
        ]);
    }
}
