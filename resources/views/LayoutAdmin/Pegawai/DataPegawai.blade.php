
@extends('LayoutAdmin.MasterMain')

@section('title', 'List Data Pegawai')

@section('link')

  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">

@endsection

  @section('Konten')


      <!-- HTML5 export buttons table -->
      <section id="html5">
        <div class="row">
          @if (session('status'))
                    <div class="alert alert-success col-12">
                      {{ session('status') }}
                   </div>
                   @endif
                   @if (session('status_hapus'))
                   <div class="alert alert-danger col-12">
                     {{ session('status_hapus') }}
                  </div>
                @endif
                @if (session('status_edit'))
                   <div class="alert alert-info col-12">
                     {{ session('status_edit') }}
                  </div>
                @endif
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">List Data Pegawai</h4>
                <br>
                <a class="btn btn-success" href="/AddData-Pegawai">Tambah Pegawai</a>
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
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                  
                    <table class="table table-striped table-bordered dataex-html5-export">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Position</th>
                          <th>aksi</th>
                        </tr>
                      </thead>
                      <tbody>

                        @forelse($GetPegawai as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->position}}</td>
                                    <td><a class="btn btn-info" href="{{url('EditData-Pegawai-'.$data->id)}}"><i class="fa fa-pencil"></i></a> ||
                                      <form action="{{ url('DeleteData-Pegawai-'.$data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin Hapus Data')">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
 
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><b><i>TIDAK ADA DATA UNTUK DITAMPILKAN</i></b></td>
                                </tr>
                            @endforelse
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nama</th>

                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--/ HTML5 export buttons table -->

@endsection

@section('script')
{{-- datatables --}}
<!-- BEGIN PAGE VENDOR JS-->
<script src="app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"
type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="app-assets/vendors/js/tables/buttons.colVis.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

@endsection