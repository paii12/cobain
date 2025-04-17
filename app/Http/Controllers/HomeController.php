<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    $user = Auth::user(); // Get the currently logged-in user

    // Admin Section
    if ($user->role == 'admin') {
        $users = User::all(); // Get all users for admin
        $mutasi = Wallet::where('status', 'done')->orderBy('created_at', 'desc')->get(); // Get mutasi for admin

        return view('home', compact('users', 'mutasi')); // Pass $users and $mutasi to the view
    }

    // Bank Section
    if ($user->role == 'bank') {
        $wallet = Wallet::where('status', 'done')->get();
        $credit = 0;
        $debit = 0;
        foreach ($wallet as $w) {
            $credit += $w->credit;
            $debit  += $w->debit;
        }
        $saldo = $credit - $debit;
        $users = User::where('role', 'siswa')->get(); // Get all 'siswa' users
        $request_payment = Wallet::where('status', 'process')->orderBy('created_at', 'DESC')->get();
        $mutasi = Wallet::whereIn('status', ['done', 'rejected'])->orderBy('created_at', 'DESC')->get();
        $allMutasi = Wallet::where('status', 'done')->count();

        return view('home', compact('saldo', 'users', 'request_payment', 'mutasi', 'allMutasi'));
    }

    // Siswa Section
    if ($user->role == 'siswa') {
        $wallets = Wallet::where('user_id', $user->id)->where('status', 'done')->get();
        $credit = 0;
        $debit = 0;
        foreach ($wallets as $wallet) {
            $credit += $wallet->credit;
            $debit += $wallet->debit;
        }
        $saldo = $credit - $debit;
        $mutasi = Wallet::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $users = User::where('role', 'siswa')->where('id', '!=', $user->id)->get(); // Exclude the current user from the list of 'siswa'

        return view('home', compact('saldo', 'mutasi', 'users'));
    }

    // Default Response (in case none of the roles match)
    return redirect()->route('home');
}

}