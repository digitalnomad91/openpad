<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use DB;
use auth;
use LRedis;
use App\User;
use App\Page;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
class PageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('log', ['only' => ['fooAction', 'barAction']]);
        $this->middleware('auth');
    }

    /**
     * Show the page itself.
     *
     * @param  null
     * @return Response
     */
    public function showPage(Request $request, $id)
    {
        $user = Auth::user(); $token = false;
        if($user) { 
            try {
               
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::fromUser($user)) {
                   // return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                //return response()->json(['error' => 'could_not_create_token'], 500);
            }
        }
                
        $page = DB::table('pages')->where('id', $id)->first();
        DB::table('pages')->where('id', $id)->increment('views', 1);

        $active_users = LRedis::get('user_list-page-'.$page->id);
        $decode = json_decode($active_users);
        $count = count($decode);
        return view('pages.view', ["title"=>$page->name, "token"=>$token, "id"=>$id, "page"=>$page, "active_count"=>$count]);
    }
    
    
    /**
        * Show the create page.
        *
        * @param  null
        * @return Response
    */
    public function myPages() {
        $user = \Auth::User();
        $pages = $user->Pages()->orderBy("created_at", "DESC")->get();
        
        return view("pages.list", ['pages'=>$pages]);
    }
    
    
    /**
        * Show the create page.
        *
        * @param  null
        * @return Response
    */
    public function showCreate()
    {
        return view('pages.create');
    }
    
    /**
        * Process post request for create page.
        *
        * @param  null
        * @return Response
    */
    public function postCreate(Request $request) {
        $user_id = Auth::id();
        $name = $request->input('name');
        $description = $request->input('description');
        
        $id = DB::table('pages')->insertGetId([
             'name' => $name,
             'description' => $description,
             'user_id' => $user_id,
             'contents' => "",
             'views' => 0,
        ]);
        
         return redirect('/page/'.$id."/view");
    }
    
    
    /**
        * Process post request for create page.
        *
        * @param  null
        * @return Response
    */
    public function postCopy($id, Request $request) {
        $user_id = Auth::id();
        $page = Page::findOrFail($id);
        
        $page1 = new Page;
        $page1->name = $request->name ? $request->name : $page->name;
        $page1->description = $page->description;
        $page1->contents = $page->contents;
        $page1->views = 1;
        $page1->user_id = $user_id;
        $page1->save();
        
         return response()->json(["success" => "Page successfully copied.", "data" => ["page_id" => $page1->id]]);
    }
    
    /**
        * Process save page request.
        *
        * @param  string $json
        * @return Response
    */
    public function savePage($data) {
        $arr = json_decode($data);
        if(!$arr->pageData) return;
        DB::table('pages')->where('id', $arr->pageID)->update(['contents' => $arr->pageData]);
        return ($arr->pageData);
    }
    
    
}
