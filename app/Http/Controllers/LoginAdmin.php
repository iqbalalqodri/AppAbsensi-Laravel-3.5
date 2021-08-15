<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginAdmin extends Controller
{
  public function index()
    {
        $id = session()->get('id');
        if (isset($id)) {
            return redirect('homeAdmin');
        }else {
            return View('LayoutAdmin.LoginAdmin');
        }
    }

    public function PostLogin(Request $request)
    {
        // return dd($request->username,$request->password);
        $Data = DB::table('loginadmin')
        ->where([
            ['username',$request->username],
            ['password',$request->password]
            ])->first();

            if(isset($Data)){
                $nisn = $Data->username;
                $id = $Data->id;

                session()->put('id',$id);

                    return redirect('homeAdmin');
                
                
            }else{
                return redirect('Login-Admin')->with('pesan','Maaf Username / Password anda Salah !');
            }
        
    
    }
    public function Logout()
    {
        session()->Flush();
        return redirect('Login-Admin');

        
    }
}
