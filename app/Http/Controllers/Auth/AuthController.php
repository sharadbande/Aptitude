<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Hash;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
       $quote = Inspiring::quote();
       return view('auth.login')->with('quote',$quote);

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $UserInfo = user::where('email', '=', $request->email)->first();
         if(!$UserInfo){
            return redirect("login")->with('error-message', 'Oppes! Please Enter Valid Email...');
         }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $UserInfo = user::where('email', '=', $request->email)->first();

            Session::put('userid', $UserInfo->id);
            Session::put('name', $UserInfo->name);
            Session::put('email', $UserInfo->email);
            return redirect()->intended('dashboard')->with('success-message', 'You have Successfully loggedin');
        }

        return redirect("login")->with('error-message', 'Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        // echo "<pre>";
        // print_r($check);
        // die;
        return redirect("dashboard")->with('error-message', 'Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->with('error-message', 'Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
