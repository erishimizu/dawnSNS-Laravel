<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    //
    public function index(){
        $id = Auth::id();
        $lists = \DB::table('users')
        ->select('posts.*','users.username','users.images')
        ->join('posts','users.id','posts.user_id')
        ->leftJoin('follows','users.id','=','follows.follow')
        ->where('posts.user_id',$id)
        ->orWhere('follows.follower',$id)
        ->orderBy('posts.created_at','desc')
        ->groupBy('posts.id')
        ->get();
        return view('posts.index',['lists'=>$lists]);
    }

    public function create(Request $request){
        $post = $request->input('newPost');
        $id = Auth::id();
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => $id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        return redirect('top'); //view('posts.index')ではエラーが出る
    }
}
