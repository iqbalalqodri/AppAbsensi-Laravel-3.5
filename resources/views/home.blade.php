@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <center><H4>JABATAN : {{$data_users->position}} </H4></center>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $info['status']}}</div>
                

                <div class="panel-body">
                    <table class="table table-responsive">

                        <form action="/absen" method="post">
                            {{csrf_field()}}
                            
                            <div class="form-group mb-3 col-sm-12 col-md-3">
                                <label for="email-addr"> </label>
                                <br>
                                <select name="note" class="form-control">
                                    <option value="Hadir">Hadir</option>
                                </select>

                              </div>
                              <div class="form-group mb-2 col-sm-12 col-md-3">
                                <label for="email-addr"> </label>
                                <br>
                                <input type="text" name="activity" class="form-control" placeholder="kegiatan...">

                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-3">
                                <label for="email-addr"> </label>
                                <br>
                                <button type="submit" class="btn btn-flat btn-primary" name="btnIn" {{$info['btnIn']}}>ABSEN MASUK</button>

                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-3">
                                <label for="email-addr"> </label>
                                <br>
                                <button type="submit" class="btn btn-flat btn-primary" name="btnOut" {{$info['btnOut']}}>ABSEN KELUAR</button>

                              </div>
                                
                                
                                
                                
                                
                            
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Riwayat Absensi</div>

                <div class="panel-body">
                    <table class="table table-responsive table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Keterangan</th>
                                <th>Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_absen as $absen)
                                <tr>
                                    <td>{{$absen->date}}</td>
                                    <td>{{$absen->time_in}}</td>
                                    <td>{{$absen->time_out}}</td>
                                    <td>{{$absen->note}}</td>
                                    <td>{{$absen->activity}}</td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $data_absen->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

