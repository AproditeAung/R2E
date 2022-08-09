<?php

namespace App\Http\Controllers;

use App\Models\RequestEditor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestEditorController extends Controller
{

    public function index()
    {
        $editors = RequestEditor::paginate(10);

        return view('Backend.Editor.index',compact('editors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255|string',
            'description' => 'required|min:1|string',
        ]);

        $RequestEditor = new RequestEditor();
        $RequestEditor->user_id = Auth::id();
        $RequestEditor->title = $request->title;
        $RequestEditor->description = $request->description;
        $RequestEditor->save();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully requested']);
    }

    public function show(RequestEditor $requestEditor)
    {
        return view('Backend.Editor.show',compact('requestEditor'));
    }
    public function destroy(RequestEditor $requestEditor)
    {
        $user = User::where('id',$requestEditor->user_id)->first();

        $user->role = '1';
        $user->update();

        $requestEditor->delete();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully upgraded']);
    }
}
