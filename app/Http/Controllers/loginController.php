<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class loginController extends Controller
{
    //
    function createUser(Request $request){
        $userCreate=new User();
        // $userCreate->name=$request->name;
        // $userCreate->email=$request->email;
        // $userCreate->rol=$request->rol;
        // $userCreate->password=bcrypt($request->password);


        // $userCreate->name=$request->name;
        // $userCreate->email=$request->email;
        // $userCreate->rol=$request->rol;
        // $userCreate->password=bcrypt($request->password);

        $userCreate->name = $request->name;
        $userCreate->ruc = $request->ruc;
        // $user->password = Hash::make($request->password);
        $userCreate->password=bcrypt($request->password);

        $userCreate->rol = "usuario";

       $userCreate->save();
    // $userCreate=User::create([
    //    'name'=>$request->name,
    //    'email'=>$request->email,
    //    'password'=>bcrypt($request->password),

    // ]);
        $token=JWTAuth::fromUser($userCreate);
        return response()->json(['response'=>'ok','data'=>$userCreate->name,$token]);
        // return response()->json(['response'=>'ok',$token]);
// return 23;
    }
    public function loginUser(Request $request)
    {
        $credencials=[
               'ruc'=>$request->ruc,
               'password'=>$request->password,
            //    'password'=>bcrypt($request->password),
            // 'email'=>$email,
            // 'password'=>$password
          ];
        //   if (Auth::attempt($credencials)) {
            if ($token=JWTAuth::attempt($credencials)) {
            //   session(['email'=>$email]);
            //   session(['rol'=>'4']);
              // return view('admin.home');
            //   $userRol=Auth::attempt($credencials);
            // $userRol=User::get();
            // $userRol=User::where('email',$request->email,'password',$request->password)->get()->where('password',$request->password)->get();
            $userRol=User::where('ruc',$request->ruc)->get();
            foreach($userRol as $key){
                // return
                 $key->rol;
            }
            // where('password',$request->password)->get();
            // $userRol= DB::table('users')
            // ->where('email',$request->email)
            // ->orWhere(function($query) {
            //     $query->where('email',$request->email)
            //           ->where('password',$request->password);
            // })
            // ->get();
              return response()->json(['status'=>'ok', 'code'=>'200','data'=>$userRol,'token'=>$token,'rol'=>$key->rol]);
          }else{
              return response()->json(['status'=>'error', 'code'=>'404']);
            }

    }
    // function loginAdmin($email,$password){
    //   }
    function info(){
        // return ;
        return response()->json(['status'=>'access', 'code'=>'200']);

    }
}
