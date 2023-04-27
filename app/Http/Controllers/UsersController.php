<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\Current;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use DB; // use App\Http\Controllers\DB;　ではエラーになる

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }
    protected function validator(array $data)
    {
        $messages = [
            'username.required' => '名前を入力してください',
            'username.between' => '4〜12字で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.between' => '4〜50字で入力してください',
            'mail.unique' => '既に使用されています',
            'current_password.check_password' => 'パスワードが違います',
            'password.different' => '同じパスワードは使用できません',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '4～12字で入力してください',
            'password.alpha_num' => '英数字で入力してください',
            'bio.max' => '200字以内で入力してください',
            'image.mimes' => 'jpg,png,bmp,gif,svgのみアップロードできます'
        ];
        return Validator::make($data, [
            'username' => 'required|string|between:4,12',
            'mail' => 'required|string|email|between:4,50',
            // Rule::unique('users')->ignore($request->mail),
            // 'current_password' => new Current(),
            'password' => 'required|string|between:4,12|different:current_password|alpha_num:1',
            // 'password_confirmation' => 'required',
            'bio' => 'string|max:200'
            // 'images' => 'image|mimes:jpg,png,bmp,gif,svg'
        ],$messages);
    }

    public function update(Request $request){
        $id = Auth::id();
        $input_current_password = $request->current_password;
        $current_password = Auth::user()->password;
        $rules = [
            'username' => 'required|string|between:4,12',
            'mail' => 'required|string|email|between:4,50',
            Rule::unique('users')->ignore($request->mail),
            'current_password' => new Current(), // App/Rules/Current.phpを作成する必要がある
            'password' => 'required|string|between:4,12|different:current_password|alpha_num:1',
            'password_confirmation' => 'required',
            'bio' => 'max:200'
            // 'images' => 'image|mimes:jpg,png,bmp,gif,svg'
        ];
        $messages = [
            'username.required' => '名前を入力してください',
            'username.between' => '4〜12字で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.between' => '4〜50字で入力してください',
            'current_password.check_password' => 'パスワードが違います',
            'password.different' => '同じパスワードは使用できません',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '4～12字で入力してください',
            'password.alpha_num' => '英数字で入力してください',
            'bio.max' => '200字以内で入力してください',
            // 'images.mimes' => 'jpg,png,bmp,gif,svgのみアップロードできます'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect('/profile')
                ->withErrors($validator)
                ->withInput();
        } else {
            $newData = [
                'username' => $request->username,
                'mail' => $request->mail,
                'password' => Hash::make($request->password),
                'bio' => $request->bio
                // 'images' => $path
            ];
            DB::table('users')
                ->where('id', $id)
                ->update($newData);

        return redirect('/profile');
        }
    }
    public function searchList(Request $request){
        $search = $_GET["search"];
        $users = DB::table('users')->where('username','like',"%$search%")->get();
        return view('users.search',['users'=>$users, 'search'=>$search]);
    }
    public function usersProfile($id){
        $profile = DB::table('users')
            ->select('*')
            ->where('id',$id)
            ->get();

        $posts = DB::table('posts')
            ->select('posts.posts','posts.created_at','users.username','users.images')
            ->join('users','posts.user_id','=','users.id')
            ->where('posts.user_id',$id)
            ->get();

        return view('users.usersProfile',['profile'=>$profile,'posts'=>$posts]);
    }
    public function userProfileFollow($id) {
        $auth = Auth::id();
        DB::table('follows')
            ->insert([
                'follower' => $auth,
                'follow' => $id
            ]);
        $profile = DB::table('users')
            ->select('*')
            ->where('id',$id)
            ->get();

        $posts = DB::table('posts')
            ->select('posts.posts','posts.created_at','users.username','users.images')
            ->join('users','posts.user_id','=','users.id')
            ->where('posts.user_id',$id)
            ->get();

        return redirect('/user'.$id);
    }
    public function userProfileUnfollow($id) {
        $auth = Auth::id();
        DB::table('follows')
            ->where([['follow',$id],['follower',$auth]])
            ->delete();

        return redirect('/user'.$id);
    }
}
