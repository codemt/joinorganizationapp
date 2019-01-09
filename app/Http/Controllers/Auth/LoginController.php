<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use App\Member;
use App\OtpVerify;
use App\User;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected function authenticated(Request $request, $user)
    {
        if (Auth::user()["role"] == 0)
        {
          return redirect()->route('home');
        }


        if (Auth::user()["role"] == 1)
        {
           return redirect()->route('User_Profile');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function postLogin(Request $request)
   {
        //dd($request->all());

       //return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
    if($request->type == "member")
    {
        $phone = $request->email;
        $password = $request->password;

        $m_type = substr($phone,0,2);
        $m_code = substr($phone,2);

        $db = DB::table('members')->where(['member_type'=>$m_type,'member_code'=>$m_code])->select('user_id')->get();

        if(sizeof(json_decode($db,true))<=0)
        {
             Session::flash('success','Login Failed! Please Try again');
             return redirect('/login');
        }

        foreach($db as $val)
        {
            $id = $val->user_id;
           //dd($id);

             $user = DB::table('users')->where([
                        ['id','=',$id]
                        ]
                        )->get();

            $user = json_decode($user,true);

            if(isset($user[0]))
            {
                $user = $user[0];

                if(Hash::check($password, $user['password']))
                {
                    Auth::loginUsingId($user['id']);
                    if ($user['role'] == 0)
                    {
                      return redirect()->route('home');
                    }


                    if ($user['role'] == 1)
                    {
                       return redirect()->route('User_Profile');
                    }
                }
            }


        }

        Session::flash('success','Login Failed! Please Try again');
        return redirect('/login');
    }
    else
    {
        $code = $request->otp;
   		$phone=$request->phone;

   		$otp = OtpVerify::where('phone',$phone)->where('code',$code)->first();


        if($otp==null)
        {
             Session::flash('success','Login Failed! Please Try again');
   			 return redirect('/login');
   		}
        else
        {
            $exist = User::where('phone',$phone)->first();


        	if($exist == null){

                 Session::flash('success','Login Failed! Please Try again');
                 return redirect('/login');
        	}
            else
            {
                if(Auth::loginUsingId($exist->id)){
                    if ($exist->role == 0)
                    {
                      return redirect()->route('home');
                    }


                    if ($exist->role == 1)
                    {
                       return redirect()->route('User_Profile');
                    }
                }
            }
   		}
    }

    }

}
