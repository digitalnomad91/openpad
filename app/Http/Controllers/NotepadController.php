<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use DB;
use auth;
 
class NotepadController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');

        $this->middleware('log', ['only' => ['fooAction', 'barAction']]);

        //$this->middleware('subscribed', ['except' => ['fooAction', 'barAction']]);
    }
    
    public function getIndex()
    {
        return view('notepads.home');
    }
    
    public function notepadList() {
        $books = DB::table('notepads')->orderBy('id', 'desc')->paginate(15);
        
        return view("notepads.list", ['books'=>$books]);
    }
    
    public function create(Request $request) {
        $user_id = Auth::id();
        $name = $request->input('name');
        $description = $request->input('description');
        
        $id = DB::table('notepads')->insertGetId([
             'name' => $name,
             'creator_user_id' => $user_id,
             'description' => $description
        ]);
        
         return redirect('/notepads');
        
    }
    
    
}
