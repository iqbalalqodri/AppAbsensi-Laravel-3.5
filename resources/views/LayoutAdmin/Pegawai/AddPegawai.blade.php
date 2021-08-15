
@extends('LayoutAdmin.MasterMain')

@section('title', 'Add Pegawai')

@section('Konten')


<div class="row justify-content-md-center">
    <div class="col-md-6">
        @if(session('status'))
                        <a href="" class='btn btn-success col-12'>{{session('status')}}</a>
                    @endif
                    @if(session('status1'))
                    <a href="" class='btn btn-warning col-12'>{{session('status1')}}</a>
                @endif
                <br>

      <div class="card">
        <div class="card-header">
          <h4 class="card-title" id="horz-layout-card-center">Add Pegawai</h4>
          <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collpase show">
          <div class="card-body">
            <div class="card-text">
            </div>
            <form class="form form-horizontal" action="{{url('AddData-Pegawai')}}"  method="POST">
                {{csrf_field()}}

              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="eventRegInput1">Name</label>
                  <div class="col-md-9">
                    <input type="text" id="eventRegInput1" class="form-control" placeholder="Entri name" name="name" required>
                  </div>
                </div>
                   <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="eventRegInput1">Email</label>
                  <div class="col-md-9">
                    <input type="email" id="eventRegInput1" class="form-control" placeholder="Entri email" name="email"  required>
                  </div>

                </div>
               
                </div>
                <div class="form-group row">
                    <label class="col-md-3 label-control" for="eventRegInput2">Password</label>
                    <div class="col-md-9">
                      <input type="password" id="eventRegInput2" class="form-control" placeholder="Entri New Password" name="password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="eventRegInput2">Jabatan</label>
                    <div class="col-md-9">
                      <select class="form-control" name="position" id="position">
                        <option value="">Pilih Jabatan</option>
                         @foreach($GetJabatan as $data)
                        <option value="{{$data->id}}">{{$data->position}}</option>
                         @endforeach</select>
                    </div>
                  </div>
              <div class="form-actions center">
                <a href="/homeAdmin" class="btn btn-warning mr-1"><i class="ft-x"></i> Cancel</a>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    

@endsection
















