@extends('layouts.app')

@section('header')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    
    <script type="text/javascript">
        // Tambah Peneliti
        var room = 1;
        function tambah_pegawai() {
            room++;
            var objTo = document.getElementById('tambah_pegawai');
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass"+room);
            var rdiv = 'removeclass'+room;
            divtest.innerHTML = '<div class="row"><div class="col-md-5"><div class="form-group "><label for="inputEstimatedBudget">Nama Pegawai</label><select class="form-control select2bs4" style="width: 100%;" name="namaTim[]"> @foreach($pegawai as $p) <option value={{ $p->nip }}>{{ $p->nama }} </option> @endforeach </select></div></div><div class="col-md-5"><div class="form-group "><label for="inputEstimatedBudget">Peran Pegawai</label><select class="form-control select2bs4" style="width: 100%;" name="peranPegawai[]"> @foreach($peranPeneliti as $pr) <option value={{ $pr->id_peran }}>{{ $pr->peran }} </option> @endforeach </select></div></div><div class="form-group "><label class="form-control-label text-muted" style="opacity: 0;">Tambah</label><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="tambah_pegawai();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"> + </span></button></div></div><div class="form-group"><label class="form-control-label text-muted" style="opacity: 0;">Kurang</label><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_tambah_pegawai('+room+');"><span class="glyphicon glyphicon-plus" aria-hidden="true"> - </span></button></div></div></div>';
            objTo.appendChild(divtest);
            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        }
        function remove_tambah_pegawai(rid) {
            $('.removeclass'+rid).remove();
        }

        // Tambah Kegiatan
        var room2 = 1;
        var reservation = 2;
        function tambah_kegiatan() {
            room2++;
            reservation++;
            var objTo = document.getElementById('tambah_kegiatan');
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass"+room2);
            var rdiv = 'removeclass'+room2;
            divtest.innerHTML = '<div class="card-body"><div class="row"><div class="col-md-12"><div class="form-group "><label for="inputEstimatedBudget">Nama Agenda</label><input type="text" class="form-control" name="namaAgenda[]" placeholder="Nama Agenda" required></div></div><div class="col-md-12"><div class="form-group "><label for="inputEstimatedBudget">Kode Agenda</label><input type="text" class="form-control" name="kodeKegiatan[]" placeholder="Kode Agenda" value="{{ old('+kodeKegiatan[]+') }}" required></div></div><div class="col-md-6"><div class="form-group"><label for="inputDescription">Waktu Penelitian</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div><input type="text" class="form-control float-right" id="reservation'+reservation+'" name="reservation2[]"></div></div></div><div class="form-group "><label class="form-control-label text-muted" style="opacity: 0;">Tambah</label><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="tambah_kegiatan();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"> + </span> </button></div></div><div class="form-group"><label class="form-control-label text-muted" style="opacity: 0;">Kurang</label><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_tambah_kegiatan('+room2+');"><span class="glyphicon glyphicon-plus" aria-hidden="true"> - </span></button></div></div></div></div>';
            objTo.appendChild(divtest);
            $(function () {$('#reservation'+reservation).daterangepicker()});
            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
        }
        function remove_tambah_kegiatan(rid) {
            $('.removeclass'+rid).remove();
        }
    </script>

@endsection

@section('section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Penelitian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Penelitian</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form name="regForm" method="POST" action="/kegiatan_penelitian_baru/simpan">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <!-- Header -->
                            <div class="card-header">
                                <h3 class="card-title">Penelitian Baru</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama Penelitian</label>
                                    <input type="text" id="namaPenelitian" name="namaPenelitian" class="form-control" placeholder="Judul Penelitian" value="{{ old('namaPenelitian') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Kode Penelitian</label>
                                    <input type="text" id="kodePenelitian" name="kodePenelitian" class="form-control" placeholder="Format : Tahun_Kode Penelitian" value="{{ old('kodePenelitian') }}" required>
                                </div>
                                <!-- <div class="form-group">
                                <label for="inputDescription">Penjelasan Penelitian</label>
                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                </div> -->
                                <div class="form-group">
                                    <label for="inputDescription">Waktu Penelitian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation" name="reservation">
                                    </div>
                                </div>

                            </div>
                            <!-- End Bodi -->
                        </div>
                    </div>

                    <!-- Main content -->
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Tim Peneliti</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="inputEstimatedBudget">Nama Pegawai</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="namaTim[]">
                                                @foreach($pegawai as $p)
                                                    <option value={{ $p->nip }}>{{ $p->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="inputEstimatedBudget">Peran Pegawai</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="peranPegawai[]">
                                                @foreach($peranPeneliti as $peran)
                                                    <option value={{ $peran->id_peran }}>{{ $peran->peran }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-control-label text-muted" style="opacity: 0;">Tambah</label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" type="button"  onclick="tambah_pegawai();"> 
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"> + </span> 
                                            </button>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="form-control-label text-muted" style="opacity: 0;">Kurang</label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button" onclick="remove_tambah_pegawai('+room+');">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"> - </span>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                                <div id="tambah_pegawai">
                            
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Agenda Penelitian</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="inputEstimatedBudget">Nama Agenda</label>
                                            <input type="text" class="form-control" name="namaAgenda[]" placeholder="Nama Agenda" value="{{ old('namaAgenda[]') }}" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="inputEstimatedBudget">Tipe Kegiatan</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="tipeKegiatan[]">
                                                @foreach($agendaKegiatan as $agenda_kegiatan)
                                                    <option value={{ $agenda_kegiatan->id_agenda_kegiatan }}>{{ $agenda_kegiatan->nama_kegiatan }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="inputEstimatedBudget">Kode Agenda</label>
                                            <input type="text" class="form-control" name="kodeKegiatan[]" placeholder="Kode Agenda" value="{{ old('kodeKegiatan[]') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="inputDescription">Waktu Penelitian</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation2" name="reservation2[]">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-control-label text-muted" style="opacity: 0;">Tambah</label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" type="button"  onclick="tambah_kegiatan();"> 
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"> + </span> 
                                            </button>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="form-control-label text-muted" style="opacity: 0;">Kurang</label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button" onclick="remove_tambah_kegiatan('+room2+');">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"> - </span>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            
                            <div id="tambah_kegiatan">
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" id="submitBtn" value="Buat Penelitian Baru" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script>
        var startDate;
        var endDate;

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker
            $('#reservation2').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                startDate = start;
                endDate = end; 
            }
            )
            $('#submitBtn').click(function(){
            console.log(startDate.format('D MMMM YYYY') + ' - ' + endDate.format('D MMMM YYYY'));
            });
            //Timepicker
            $('#timepicker').datetimepicker({
            format: 'LT'
            })
            
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });

            $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        })
    </script>
@endsection
