<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'username.required' => '名前を入力してください',
            'username.between' => '4〜12字で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.between' => '4〜50字で入力してください',
            'mail.unique' => '既に使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '4〜12字で入力してください',
            'password.alpha_num' => '英数字で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
            'password_confirmation.required' => '確認用パスワードを入力してください'
        ];
        return Validator::make($data, [
            'username' => 'required|string|between:4,12|',
            'mail' => 'required|string|email|between:4,50|unique:users',
            'password' => 'required|string|between:4,12|alpha_num:1|confirmed',
            'password_confirmation' => 'required'
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        $rules = [
          'username' => 'required|string|between:4,12|',
          'mail' => 'required|string|email|between:4,50|unique:users',
          'password' => 'required|string|between:4,12|alpha_num:1|confirmed',
          'password_confirmation' => 'required'
        ];
        $message = [
            'username.required' => '名前を入力してください',
            'username.between' => '4〜12字で入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.between' => '4〜50字で入力してください',
            'mail.unique' => '既に使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '4～12字で入力してください',
            'password.alpha_num' => '英数字で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
            'password_confirmation.required' => '確認用パスワードを入力してください'
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($request->isMethod('post')){
            $data = $request->input();
            if ($validator->fails()) {
              return redirect('/register')
              ->withErrors($validator)
              ->withInput();
            } else {
                $username = $request->username;
                $this->create($data);
                $input_data = ['username' => $username];
                return view('auth.added',$input_data);
            }
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');

    }

}
