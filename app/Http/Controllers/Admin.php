<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Absen;
use Auth;
use Validator;

class Admin extends Controller
{

    public function timeZone($location){
        return date_default_timezone_set($location);
    }


    public function index()
    {

        if(session()->get('id')){
               return view('LayoutAdmin.homeAdmin');
       }else{
       return redirect()->back();
       }
    }
    

    public function indexAbsensi()
    {
        if(session()->get('id')){

            $users = DB::table('users')->get();
               return view('LayoutAdmin.absensi',compact('users'));
       }else{
       return redirect()->back();
       }
    }

    public function DetailAbsensi($id)
    {
        if(session()->get('id')){

            $this->timeZone('Asia/Jakarta');
            $user_id = $id;
            $get1users = DB::table('users')->where('id', $user_id)->first();
            $date = date("Y-m-d");
            $cek_absen = Absen::where(['user_id' => $user_id, 'date' => $date])
                                ->get()
                                ->first();
            if (is_null($cek_absen)) {
                $info = array(
                    "status" => "Anda belum mengisi absensi!",
                    "btnIn" => "",
                    "btnOut" => "disabled");
            } elseif ($cek_absen->time_out == NULL) {
                $info = array(
                    "status" => "Jangan lupa absen keluar",
                    "btnIn" => "disabled",
                    "btnOut" => "");
            } else {
                $info = array(
                    "status" => "Absensi hari ini telah selesai!",
                    "btnIn" => "disabled",
                    "btnOut" => "disabled");
            }
    
            $data_absen = Absen::where('user_id', $user_id)
                            ->orderBy('date', 'desc')
                            ->paginate(20);
               return view('LayoutAdmin.detailAbsen',compact('data_absen','info','get1users'));
       }else{
       return redirect()->back();
       }
    }


     




    public function indexSettingAkun()
    {
        if(session()->get('id')){
            $id = session()->get('id');
            $GetAdmin = DB::table('loginadmin')->where('id', $id)->first();
               return view('LayoutAdmin.SettingAkun',compact('GetAdmin'));
       }else{
       return redirect()->back();
       }
    }

    public function PostSettingAkun(Request $req)
    {
        if(session()->get('id')){
                $id = session()->get('id');
            $GetAdmin = DB::table('loginadmin')->where('id', $id)->first();
                $username = $req->username;
                $password = $req->password;
                $passwordL = $req->passwordL;
                $passwordDB = $GetAdmin->password;

                if ($passwordL === $passwordDB) {
                    $SAVE = DB::table('loginadmin')
                        ->where('id',$id)
                        ->update([
                                    'username'=>$username,
                                    'password'=>$password
                                ]);
                    return Redirect('Setting-Akun')->with('status','Data Berhasil Di Edit');
                }else{
                    return Redirect('Setting-Akun')->with('status1','Password Lama Salah !!!');
                }
        }else{
        return redirect()->back();
        }
    }

    public function indexDataPegawai()
    {
        if(session()->get('id')){
            $GetPegawai = DB::table('position')
            ->join('users', 'position.id', '=', 'users.position_id')
            ->get();
               return view('LayoutAdmin.Pegawai.DataPegawai',compact('GetPegawai'));
       }else{
       return redirect()->back();
       }
    }
    

     public function indexAddDataPegawai()
    {
        if(session()->get('id')){
            $GetJabatan = DB::table('position')->get();
            
               return view('LayoutAdmin.Pegawai.AddPegawai',compact('GetJabatan'));
       }else{
       return redirect()->back();
       }
    }
    

    public function PostAddDataPegawai(Request $req)
    {
        // Bug Login Pegawai Ada Disi Kurang Menggunakan Parameter Hash di field password

        if(session()->get('id')){
            $save =  DB::table('users')->insert([
                    
                    'name' => $req->name,
                    'email' => $req->email,
                    'password' => hash::make($req->password),
                    'position_id' => $req->position,

                        ]);
               return redirect('Data-Pegawai')->with('status', 'Data Berhasil Di Tambah!');


       }else{
       return redirect()->back();
       }
    }


     public function indexEditDataPegawai($id)
    {
        if(session()->get('id')){
            $GetPegawai = DB::table('users')->where('id', $id)->first();
            $GetJabatan = DB::table('position')->get();


               return view('LayoutAdmin.Pegawai.EditPegawai',compact('GetPegawai','GetJabatan'));
       }else{
       return redirect()->back();
       }
    }
    public function PostEditDataPegawai(Request $req,$id)
    {
        if(session()->get('id')){

          if ($req->password ==="") {
            $save =  DB::table('users')->where('id', $id)->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'position_id' => $req->jabatan,
                        ]);
               return redirect('Data-Pegawai')->with('status', 'Data Berhasil Di Edit!');


          }else{
             $save =  DB::table('users')->where('id', $id)->update([
                    
                    'name' => $req->name,
                    'email' => $req->email,
                    'password' => hash::make($req->password),
                    'position_id' => $req->jabatan
                        ]);

               return redirect('Data-Pegawai')->with('status_edit', 'Data Berhasil Di Edit!');

          }

           
       }else{
       return redirect()->back();
       }
    }

     public function PostDeleteDataPegawai($id) 
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('Data-Pegawai')->with('status_hapus', 'Data Berhasil Di Hapus!');
    }


    // Fungsi Jabatan
    public function indexDataJabatan()
    {
        if(session()->get('id')){
            $GetJabatan = DB::table('position')->get();
               return view('LayoutAdmin.Jabatan.DataJabatan',compact('GetJabatan'));
       }else{
       return redirect()->back();
       }
    }
    

     public function indexAddDataJabatan()
    {
        if(session()->get('id')){
               return view('LayoutAdmin.Jabatan.AddJabatan');
       }else{
       return redirect()->back();
       }
    }
    

    public function PostAddDataJabatan(Request $req)
    {
        // Bug Login Jabatan Ada Disi Kurang Menggunakan Parameter Hash di field password

        if(session()->get('id')){
            $save =  DB::table('position')->insert([
                    
                    'position' => $req->Jabatan
                    

                        ]);
               return redirect('Data-Jabatan')->with('status', 'Data Berhasil Di Tambah!');


       }else{
       return redirect()->back();
       }
    }


     public function indexEditDataJabatan($id)
    {
        if(session()->get('id')){
            $GetJabatan = DB::table('position')->where('id', $id)->first();

               return view('LayoutAdmin.Jabatan.EditJabatan',compact('GetJabatan'));
       }else{
       return redirect()->back();
       }
    }
    public function PostEditDataJabatan(Request $req,$id)
    {
        if(session()->get('id')){

            $save =  DB::table('position')->where('id', $id)->update([
                    'position' => $req->position
                        ]);
               return redirect('Data-Jabatan')->with('status', 'Data Berhasil Di Edit!');


         

           
       }else{
       return redirect()->back();
       }
    }

     public function PostDeleteDataJabatan($id) 
    {
        DB::table('position')->where('id',$id)->delete();
        return redirect('Data-Jabatan')->with('status_hapus', 'Data Berhasil Di Hapus!');
    }

    


      
       
}
