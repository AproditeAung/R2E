<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\ReaderWallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::when(isset(request()->role) && request()->role != 3,function ($q){
            return $q->where('role',request()->role);
        })->simplePaginate(5);

        return view('FrontEnd.userCRUD.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('FrontEnd.userCRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->reference_id = uniqid();
        $user->save();

        $wallet = new ReaderWallet();
        $wallet->user_id  = $user->id;
        $wallet->wallet_no = uniqid();
        $wallet->amount = 0;
        $wallet->save();
        return redirect()->route('user.index')->with('message',['icon'=>'success','text'=>'successfully created']);
    }


    public function generateUser()
    {
        $name ='kndf'.User::orderBy('id','desc')->first()->id;
        $email ='kndf'.User::orderBy('id','desc')->first()->id.'@kndf.com';
        $user = new User();
        $user->name =$name;
        $user->email =$email;
        $user->password = Hash::make('mustbewin'); // mustbewin
        $user->save();

        $wallet = new ReaderWallet();
        $wallet->user_id  = $user->id;
        $wallet->wallet_no = uniqid();
        $wallet->amount = 0;
        $wallet->save();
        return redirect()->route('user.create')->with('message',['icon'=>'success','text'=>'successfully created','user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('FrontEnd.userCRUD.edit',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('FrontEnd.userCRUD.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->role != '2'){
            return redirect()->back()->with('message',['icon'=>'error','text'=>'UnAuthorize']);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password) ?? $user->getAuthPassword();
        $user->role = $request->role;
        $user->update();
        return redirect()->route('user.index')->with('message',['icon'=>'success','text'=>'successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('message',['icon'=>'success','text'=>'successfully deleted']);

    }

    public function upgradeAdmin(Request $request){

        $user = User::findOrFail($request->user_id);
        if(isset($request->admin_upgrade)){
            $user->role = '2';
            $user->update();
            return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully upgraded admin']);
        }else{
            $user->role = '1';
            $user->update();
            return redirect()->route('user.index')->with('message',['icon'=>'success','text'=>'successfully downgraded editor']);

        }
    }
}
