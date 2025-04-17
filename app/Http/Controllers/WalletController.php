<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function topup(Request $request)
    {
        $request->validate([
            'credit' => 'required|numeric|min:10000'
        ]);

        Wallet::create([
            'user_id' => Auth::id(),
            'debit' => 0,
            'credit' => $request->credit,
            'description' => 'Top-up Saldo',
            'status' => 'process'
        ]);

        return redirect()->back()->with('status', 'Permintaan Top-Up anda sedang diproses');
    }

    public function withdraw(Request $request)
{
    $request->validate([
        'credit' => 'required|numeric|min:10000'
    ]);

    $user = Auth::user();
    $totalSaldo = Wallet::where('user_id', $user->id)
        ->where('status', 'done')
        ->sum(DB::raw('credit - debit'));

    if ($totalSaldo < $request->credit) {
        return redirect()->back()->with('status', 'Saldo tidak mencukupi');
    }

    // Menambahkan transaksi withdraw langsung
    Wallet::create([
        'user_id' => $user->id,
        'debit' => $request->credit,
        'credit' => 0,
        'description' => 'Withdraw Saldo',
        'status' => 'done', // Status langsung 'done', tanpa persetujuan
    ]);

    return redirect()->back()->with('status', 'Withdraw berhasil');
}


public function transfer(Request $request)
{
    $user = Auth::user(); // Mendapatkan user yang sedang login

    // Validasi amount dan penerima
    $validated = $request->validate([
        'recepient_id' => 'required|exists:users,id', // Pastikan penerima ada di database
        'amount' => 'required|numeric|min:1', // Pastikan amount lebih dari 0
    ]);

    // Mendapatkan penerima
    $recepient = User::find($request->recepient_id);

    // Mengecek apakah pengirim memiliki saldo cukup
    $wallets = Wallet::where('user_id', $user->id)->where('status', 'done')->get();
    $credit = 0;
    $debit = 0;

    foreach ($wallets as $wallet) {
        $credit += $wallet->credit;
        $debit += $wallet->debit;
    }

    $saldoPengirim = $credit - $debit;

    if ($saldoPengirim < $request->amount) {
        return redirect()->back()->with('error', 'Saldo Anda tidak cukup untuk melakukan transfer.');
    }

    // Proses transfer, update saldo pengirim dan penerima
    // Debit dari pengirim
    Wallet::create([
        'user_id' => $user->id,
        'credit' => 0,
        'debit' => $request->amount,
        'description' => 'Transfer ke ' . $recepient->name,
        'status' => 'done',
    ]);

    // Kredit ke penerima
    Wallet::create([
        'user_id' => $recepient->id,
        'credit' => $request->amount,
        'debit' => 0,
        'description' => 'Transfer dari ' . $user->name,
        'status' => 'done',
    ]);

    return redirect()->route('home')->with('success', 'Transfer berhasil.');
}


    public function acceptRequest(Request $request, $walletId)
    {
        $wallet = Wallet::findOrFail($walletId);
        $wallet->update(['status' => 'done']);

        return redirect()->back()->with('status', 'Permintaan Berhasil disetujui');
    }

    public function rejectRequest(Request $request, $walletId)
    {
        $wallet = Wallet::findOrFail($walletId);
        $wallet->update(['status' => 'rejected']);

        return redirect()->back()->with('status', 'Permintaan Ditolak');
    }

    public function topupsiswa(Request $request)
    {
        $request->validate([
            'recepient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1'
        ]);

        $recipient = User::findOrFail($request->recepient_id);
        $amount = $request->amount;

        Wallet::create([
            'user_id' => $recipient->id,
            'description' => 'Top-up from Bank',
            'debit' => 0,
            'credit' => $amount,
            'status' => 'done'
        ]);

        return redirect()->back()->with('success', 'Top-up berhasil dikirim ke ' . $recipient->name);
    }



}