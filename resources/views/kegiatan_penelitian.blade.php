@extends('layouts.app')

@section('header')
    <!-- Timeline -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('plugins/horizontal-timeline/dist/style.css') }}">
@endsection

@section('section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Total Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer"> </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Penelitian Berlangsung</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">  </i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>Penelitian Selesai</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        <a href="#" class="small-box-footer">  </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Buat Penelitian Baru</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/kegiatan_penelitian_baru" class="small-box-footer">Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

                @if(count($penelitian) === 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title"></h2>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <h2>Penelitian Tidak Tersedia</h2>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                @else
                    @foreach($penelitian as $p)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title"><a href="/kegiatan_penelitian_rincian?id={{ $p->kode_penelitian }}" class="dropdown-item">{{ $p->judul_penelitian }}</a></h2>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <a href="#" class="dropdown-item">Edit</a>
                                                    <a href="#" class="dropdown-item">Hapus</a>
                                                    <!-- <a href="#" class="dropdown-item">Something else here</a>
                                                    <a class="dropdown-divider"></a>
                                                    <a href="#" class="dropdown-item">Separated link</a> -->
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <section class="cd-horizontal-timeline">
                                            <div class="timeline">
                                                <div class="events-wrapper">
                                                    <div class="events">
                                                        <ol>
                                                            @php $tahun = strtotime("01/01/2000"); $sudah=0; @endphp
                                                            @foreach($timelinePenelitian as $kp)
                                                                @if($kp->kode_penelitian === $p->kode_penelitian)
                                                                    @if($kp->status === 0 && $sudah===0)
                                                                        <li><a href="#0" data-date="{{ date('d/m/Y', $tahun) }}" class="selected">{{ date("d M", strtotime($kp->tgl_mulai)) }}</a></li>
                                                                        @php $tahun = strtotime("+15 day", $tahun);  $sudah++; @endphp
                                                                    @else
                                                                        <li><a href="#0" data-date="{{ date('d/m/Y', $tahun) }}">{{ date("d M", strtotime($kp->tgl_mulai)) }}</a></li>
                                                                        @php $tahun = strtotime("+15 day", $tahun); @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <!-- <li><a href="#0" data-date="16/01/2014" class="selected">16 Jan</a></li> -->
                                                        </ol>

                                                        <span class="filling-line" aria-hidden="true"></span>
                                                    </div> <!-- .events -->
                                                </div> <!-- .events-wrapper -->
                                                    
                                                <ul class="cd-timeline-navigation">
                                                    <li><a href="#0" class="prev inactive">Prev</a></li>
                                                    <li><a href="#0" class="next">Next</a></li>
                                                </ul> <!-- .cd-timeline-navigation -->
                                            </div> <!-- .timeline -->

                                            <div class="events-content">
                                                <ol>
                                                    @php $tahun = strtotime("01/01/2000"); $sudah=0; @endphp
                                                    @foreach($timelinePenelitian as $kp)
                                                        @if($kp->kode_penelitian === $p->kode_penelitian)
                                                            @if($kp->status === 0 && $sudah===0)
                                                                <li data-date="{{ date('d/m/Y', $tahun) }}" class="selected">
                                                                    <h2>{{ $kp-> agenda}}</h2>
                                                                    <em>{{ date('d/m/Y', strtotime($kp->tgl_mulai)) }} - {{ date('d/m/Y', strtotime($kp->tgl_selesai)) }}</em>
                                                                    <!-- <p>	
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                                    </p> -->
                                                                </li>
                                                                @php $tahun = strtotime("+15 day", $tahun); $sudah++; @endphp
                                                            @else
                                                                <li data-date="{{ date('d/m/Y', $tahun) }}">
                                                                    <h2>{{ $kp-> agenda}}</h2>
                                                                    <em>{{ date('d/m/Y', strtotime($kp->tgl_mulai)) }} - {{ date('d/m/Y', strtotime($kp->tgl_selesai)) }}</em>
                                                                    <!-- <p>	
                                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                                    </p> -->
                                                                </li>
                                                                @php $tahun = strtotime("+15 day", $tahun); @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    <!-- <li class="selected" data-date="16/01/2014">
                                                    <h2>Horizontal Timeline</h2>
                                                    <em>January 16th, 2014</em>
                                                    <p>	
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
                                                    </p>
                                                    </li> -->
                                                </ol>
                                            </div> <!-- .events-content -->
                                        </section>
                                    </div>
                                    <!-- ./card-body -->
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-3 col-6">
                                                <div class="description-block border-right">
                                                    <span class="description-text">Koordinator</span>
                                                    <h5 class="description-header" style="opacity: 0;">-</h5>
                                                    @foreach($timPenelitian as $tp)
                                                        @if(($tp->id_peran === 3) && ($tp->kode_penelitian === $p->kode_penelitian))
                                                            @foreach($pegawai as $pgw)
                                                                @if($pgw->nip === $tp->nip)
                                                                    <span class="description-text">{{ $pgw->nama }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 col-6">
                                                <div class="description-block border-right">
                                                    <span class="description-text">Waktu Penelitian</span>
                                                    <h5 class="description-header" style="opacity: 0;">-</h5>
                                                    <span class="description-text">{{ date('d/m/Y', strtotime($p->tgl_mulai)) }} - {{ date('d/m/Y', strtotime($p->tgl_selesai)) }}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 col-6">
                                                <div class="description-block border-right">
                                                    <span class="description-text">Jumlah Anggota</span>
                                                    <h5 class="description-header" style="opacity: 0;">-</h5>
                                                    @php
                                                        $total=0
                                                    @endphp
                                                    @foreach($timPenelitian as $tp)
                                                        @if($tp->kode_penelitian === $p->kode_penelitian)
                                                            @php
                                                                $total++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <span class="description-text">{{ $total ?? '' }}</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 col-6">
                                                <div class="description-block">
                                                    <span class="description-text"> Status</span>
                                                    <h5 class="description-header" style="opacity: 0;">-</h5>
                                                    @if($p->status === 1)
                                                        <span class="description-text">Selesai</span>
                                                    @else
                                                        <span class="description-text">Belum Selesai</span>
                                                    @endif
                                                    
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    @endforeach
                @endif
                
                
        
            <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footer')
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- PAGE SCRIPTS -->
  <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
  <!-- Timeline -->
  <script  src="{{ asset('plugins/horizontal-timeline/dist/script.js') }}"></script>
@endsection
