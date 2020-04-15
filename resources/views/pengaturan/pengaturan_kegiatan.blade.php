@extends('layouts.app')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kegiatan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Daftar Kegiatan</h2>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="float-sm-right">
                                        <a class="btn btn-app" data-toggle="modal" data-target="#modalTambah">
                                            <i class="fas fa-plus"></i> Tambah
                                        </a>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                         <!-- Modal Tambah-->
                         <div class="modal fade" id="modalTambah">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- form start -->
                                    <form role="form" method="POST" action="/pengaturan/kegiatan/tambah">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Kegiatan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nip_baru">Nama Kegiatan</label>
                                                    <input type="text" class="form-control" id="kegiatan_baru" name="kegiatan_baru" placeholder="Masukan Nama Kegiatan" required>
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="nip_baru">Dokumen Digunakan</label>
                                                    <div class="form-check">    
                                                        @foreach ($dokumen as $d)
                                                            <input class="form-check-input" type="checkbox"  id="{{ $d->kode_dokumen }}" name="daftar_dokumen[]" value="{{ $d->kode_dokumen }}"><label for="{{ $d->kode_dokumen }}" class="form-check-label">{{ $d->nama_dokumen }}</label><br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


                        <div class="col-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Kegiatan Aktif</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Kegiatan Tidak Aktif</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            @foreach ($dokumen as $d)
                                                                <th>{{ $d->nama_dokumen }}</th>
                                                            @endforeach
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($kegiatan as $k)
                                                            <tr>
                                                                <td>{{ $k->nama_agenda }}</td>
                                                                @foreach ($dokumen as $d)
                                                                    <td>Ok</td>
                                                                @endforeach
                                                                <td>
                                                                    @if ($d->deleted_at !== NULL)
                                                                        <center><small class="badge badge-danger"> Non-aktif</small></center>
                                                                    @else
                                                                        <center><small class="badge badge-primary"> Aktif</small></center>
                                                                    @endif
                                                                </td>
                                                                <td><button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-edit-agenda{{ $k->kode_agenda }}" id="edit">Edit</button></td>            
                                                            </tr>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-edit-agenda{{ $k->kode_agenda }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <!-- form start -->
                                                                        <form role="form" method="POST" action="/pengaturan/kegiatan/edit">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Edit Kegiatan</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ csrf_field() }}
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label for="nip_baru">Nama Agenda</label>
                                                                                        <input type="hidden" class="form-control" id="kode_agenda_edit" name="kode_agenda_edit" value="{{ $k->kode_agenda }}">
                                                                                        <input type="text" class="form-control" id="nama_agenda_edit" name="nama_agenda_edit" placeholder="Masukan Nama Agenda" value="{{ $k->nama_agenda }}" required>
                                                                                    </div>
                                                                                    <div class="form-group"> 
                                                                                        <label for="nip_baru">Dokumen Digunakan</label>
                                                                                        <div class="form-check">    
                                                                                            @foreach ($dokumen as $d2)
                                                                                                <input class="form-check-input" type="checkbox"  id="{{ $d2->kode_dokumen }}" name="daftar_dokumen[]" value="{{ $d2->kode_dokumen }}"><label for="{{ $d2->kode_dokumen }}" class="form-check-label">{{ $d2->nama_dokumen }}</label><br>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Status Kegiatan</label>
                                                                                        <select class="form-control" name="status_akun[]">
                                                                                            @if($k->deleted_at === NULL)
                                                                                                <option value=1 selected>Aktif</option>
                                                                                                <option value=2>Tidak Aktif</option>
                                                                                            @else 
                                                                                                <option value=1>Aktif</option>
                                                                                                <option value=2 selected>Tidak Aktif</option>
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            @foreach ($dokumen as $d)
                                                                <th>{{ $d->nama_dokumen }}</th>
                                                            @endforeach
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example2" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            @foreach ($dokumen as $d)
                                                                <th>{{ $d->nama_dokumen }}</th>
                                                            @endforeach
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($kegiatan2 as $k2)
                                                            <tr>
                                                                <td>{{ $k2->nama_agenda }}</td>
                                                                @foreach ($dokumen as $d)
                                                                    <td>Ok</td>
                                                                @endforeach
                                                                <td>
                                                                    @if ($k2->deleted_at !== NULL)
                                                                        <center><small class="badge badge-danger"> Non-aktif</small></center>
                                                                    @else
                                                                        <center><small class="badge badge-primary"> Aktif</small></center>
                                                                    @endif
                                                                </td>
                                                                <td><button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-edit-agenda{{ $k2->kode_agenda }}" id="edit">Edit</button></td>            
                                                            </tr>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-edit-agenda{{ $k2->kode_agenda }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <!-- form start -->
                                                                        <form role="form" method="POST" action="/pengaturan/kegiatan/edit/restore">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Edit Agenda</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ csrf_field() }}
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label for="nip_baru">Nama Agenda</label>
                                                                                        <input type="hidden" class="form-control" id="kode_agenda_edit" name="kode_agenda_edit" value="{{ $k2->kode_agenda }}">
                                                                                        <input type="text" class="form-control" id="nama_agenda_edit" name="nama_agenda_edit" placeholder="Masukan Nama Dokumen" value="{{ $k2->nama_agenda }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group"> 
                                                                                        <label for="nip_baru">Dokumen Digunakan</label>
                                                                                        <div class="form-check">    
                                                                                            @foreach ($dokumen as $d)
                                                                                                <input class="form-check-input" type="checkbox"  id="{{ $d->kode_dokumen }}" name="daftar_dokumen[]" value="{{ $d->kode_dokumen }}" onclick="return false;"/><label for="{{ $d->kode_dokumen }}" class="form-check-label">{{ $d->nama_dokumen }}</label><br>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Status Dokumen</label>
                                                                                        <select class="form-control" name="status_akun[]">
                                                                                            @if($k2->deleted_at === NULL)
                                                                                                <option value=1 selected>Aktif</option>
                                                                                                <option value=2>Tidak Aktif</option>
                                                                                            @else 
                                                                                                <option value=1>Aktif</option>
                                                                                                <option value=2 selected>Tidak Aktif</option>
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Nama Kegiatan</th>
                                                            @foreach ($dokumen as $d)
                                                                <th>{{ $d->nama_dokumen }}</th>
                                                            @endforeach
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
    });
</script>
@endsection
