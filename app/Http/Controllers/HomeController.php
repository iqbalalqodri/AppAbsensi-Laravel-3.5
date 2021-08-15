<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use Illuminate\Support\Facades\DB;

use App\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeZone($location){
        return date_default_timezone_set($location);
    }
    public function index()
    {
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
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
                        $data_users = DB::table('position')
                        ->join('users', 'position.id', '=', 'users.id')
                        ->where('position_id',$user_id)
                        ->first();
        return view('home', compact('data_absen', 'info','data_users'));
    }
    public function absen(Request $request){
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        $date = date("Y-m-d"); // 2017-02-01
        $time = date("H:i:s"); // 12:31:20
        $note = $request->note;
        $activity = $request->activity;
        // dd($activity);

        $absen = new Absen;
       
        // absen masuk
        if (isset($request->btnIn)) {
             // cek double data
            $cek_double = $absen->where(['date' => $date, 'user_id' => $user_id])
                                ->count();
            if ($cek_double > 0) {
                return redirect()->back();
            }
            $absen->create([
                'user_id' => $user_id,
                'date' => $date,
                'time_in' => $time,
                ]);
            return redirect()->back();

        }
        // absen keluar
        elseif (isset($request->btnOut)) {
            $absen->where(['date' => $date, 'user_id' => $user_id])
                ->update([
                    'time_out' => $time,
                    'note' => $note,
                    'activity'=>$activity]);
            return redirect()->back();
        }
        return $request->all();
    }
}
