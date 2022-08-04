<?php

namespace App\Http\Controllers;

use App\Models\ReaderWallet;
use App\Models\Withdraw;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReaderWalletController extends Controller
{
    public function index()
    {
        $wallet = ReaderWallet::where('user_id',Auth::id())->first();
        $withdraws = Withdraw::where('user_id',Auth::id())->paginate(5);
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('wallet',compact('wallet','withdraws','notifications'));
    }
}
