<?php

namespace App\Http\Controllers;

use App\Models\ReaderWallet;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Exception;

class WithdrawController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        $wallet = ReaderWallet::where('user_id',Auth::id())->first();

        if((int)$request->amount >= 10000 && $wallet->amount >= 10000){

            DB::beginTransaction();

            try {
                $withdraw = new Withdraw();
                $withdraw->amount = (int)$request->amount;
                $withdraw->user_id = $wallet->user_id;
                $withdraw->gmail = $request->gmail;
                $withdraw->save();

                $wallet->decrement('amount',(int)$request->amount);
                $wallet->update();

                DB::commit();
                return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully Withdraw']);

            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->back()->with('message',['icon'=>'success','text'=>$e->getMessage()]);

            }


        }

        return redirect()->back()->with('message',['icon'=>'error','text'=>'minimal withdraw is 10K']);

    }
}
