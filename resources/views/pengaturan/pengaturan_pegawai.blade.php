@extends('layouts.app')

@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    
   
@endsection

@section('section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pegawai</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            
            <!-- Error Handling -->
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Pegawai Puslitbang Aptika & IKP</h2>
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

                        <!-- Modal Tambah-->
                        <div class="modal fade" id="modalTambah">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- form start -->
                                    <form role="form" method="POST" action="/pengaturan/pegawai/tambah">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Pegawai</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nip_baru">NIP</label>
                                                    <input type="text" class="form-control" id="nip_baru" name="nip_baru" placeholder="Masukan NIP" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_baru">Nama</label>
                                                    <input type="text" class="form-control" id="nama_baru" name="nama_baru" placeholder="Masukan Nama" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_baru">Email</label>
                                                    <input type="email" class="form-control" id="email_baru" name="email_baru" placeholder="Masukan Email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_tlp_baru">Nomor Telepon</label>
                                                    <input type="text" class="form-control" id="no_tlp_baru" name="no_tlp_baru" placeholder="Masukan Nomor Telepon">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan_baru">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan_baru" name="jabatan_baru" placeholder="Masukan Jabatan" required>
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
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pegawai Aktif</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pegawai Tidak Aktif</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Jabatan</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($pegawai as $p)
                                                            <tr>
                                                                <td><center>
                                                                    @if ($p->img === NULL)
                                                                        <img class="profile-user-img img-fluid img-circle" src="/img/default.jpg" alt="User profile picture">
                                                                    @else
                                                                        <img class="profile-user-img img-fluid img-circle" src="/img/{{ $p->nip }}/{{ $p->img }}" alt="User profile picture">
                                                                    @endif
                                                                </center></td>
                                                                <td>{{ $p->nip }}</td>
                                                                <td>{{ $p->nama }}</td>
                                                                <td>{{ $p->email }}</td>
                                                                <td>{{ $p->no_tlp }}</td>
                                                                <td>{{ $p->jabatan }}</td>
                                                                <td>
                                                                    @if ($p->deleted_at !== NULL)
                                                                        <center><small class="badge badge-danger"> Non-aktif</small></center>
                                                                    @else
                                                                        <center><small class="badge badge-primary"> Aktif</small></center>
                                                                    @endif
                                                                </td>
                                                                <td><button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-edit-pegawai{{ $p->nip }}" id="edit">Edit</button></td>
                                                            </tr>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-edit-pegawai{{ $p->nip }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <!-- form start -->
                                                                        <form role="form" method="POST" action="/pengaturan/pegawai/edit">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Edit Pegawai</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ csrf_field() }}
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" class="form-control" id="nip_lama" name="nip_lama" placeholder="NIP" value="{{ $p->nip }}" required>
                                                                                        <label for="nip_edit">NIP</label>
                                                                                        <input type="text" class="form-control" id="nip_edit" name="nip_edit" placeholder="NIP" value="{{ $p->nip }}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="nama_edit">Nama</label>
                                                                                        <input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama" value="{{ $p->nama }}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" class="form-control" id="email_lama" name="email_lama" placeholder="Email" value="{{ $p->email }}" required>
                                                                                        <label for="email_edit">Email</label>
                                                                                        <input type="email" class="form-control" id="email_edit" name="email_edit" placeholder="Email" value="{{ $p->email }}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                    <label for="no_tlp_edit">Nomor Telepon</label>
                                                                                        <input type="text" class="form-control" id="no_tlp_edit" name="no_tlp_edit" placeholder="Nomor Telepon" value="{{ $p->no_tlp }}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="jabatan_edit">Jabatan</label>
                                                                                        <input type="text" class="form-control" id="jabatan_edit" name="jabatan_edit" placeholder="Jabatan" value="{{ $p->jabatan }}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Status Akun</label>
                                                                                        <select class="form-control" name="status_akun[]">
                                                                                            @if($p->deleted_at === NULL)
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
                                                            <th></th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Jabatan</th>
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
                                                            <th></th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Jabatan</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($pegawai2 as $p2)
                                                            <tr>
                                                                <td><center>
                                                                    @if ($p2->img === NULL)
                                                                        <img class="profile-user-img img-fluid img-circle" src="/img/default.jpg" alt="User profile picture">
                                                                    @else
                                                                        <img class="profile-user-img img-fluid img-circle" src="/img/{{ $p->nip }}/{{ $p->img }}" alt="User profile picture">
                                                                    @endif
                                                                </center></td>
                                                                <td>{{ $p2->nip }}</td>
                                                                <td>{{ $p2->nama }}</td>
                                                                <td>{{ $p2->email }}</td>
                                                                <td>{{ $p2->no_tlp }}</td>
                                                                <td>{{ $p2->jabatan }}</td>
                                                                <td>
                                                                    @if ($p2->deleted_at !== NULL)
                                                                        <center><small class="badge badge-danger"> Non-aktif</small></center>
                                                                    @else
                                                                        <center><small class="badge badge-primary"> Aktif</small></center>
                                                                    @endif
                                                                </td>
                                                                <td><button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-edit-pegawai{{ $p2->nip }}" id="edit">Edit</button></td>
                                                            </tr>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-edit-pegawai{{ $p2->nip }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <!-- form start -->
                                                                        <form role="form" method="POST" action="/pengaturan/pegawai/edit/restore">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Edit Pegawai</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {{ csrf_field() }}
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label for="nip_edit">NIP</label>
                                                                                        <input type="text" class="form-control" id="nip_edit" name="nip_edit" placeholder="NIP" value="{{ $p2->nip }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="nama_edit">Nama</label>
                                                                                        <input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama" value="{{ $p2->nama }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="email_edit">Email</label>
                                                                                        <input type="email" class="form-control" id="email_edit" name="email_edit" placeholder="Email" value="{{ $p2->email }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                    <label for="no_tlp_edit">Nomor Telepon</label>
                                                                                        <input type="text" class="form-control" id="no_tlp_edit" name="no_tlp_edit" placeholder="Nomor Telepon" value="{{ $p2->no_tlp }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="jabatan_edit">Jabatan</label>
                                                                                        <input type="text" class="form-control" id="jabatan_edit" name="jabatan_edit" placeholder="Jabatan" value="{{ $p2->jabatan }}" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Status Akun</label>
                                                                                        <select class="form-control" name="status_akun[]">
                                                                                            @if($p2->deleted_at === NULL)
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
                                                            <th></th>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                            <th>Jabatan</th>
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
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script>
        $(function () {
            $("#example1").DataTable();
            $("#example2").DataTable();
        });
    </script>  
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#modalEdit').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type : 'POST',
                    url : '/pengaturan/pegawai/edit_tampil',
                    data :  'rowid='+ rowid,
                    success : function(data){
                    $('.fetched-data').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
@endsection
