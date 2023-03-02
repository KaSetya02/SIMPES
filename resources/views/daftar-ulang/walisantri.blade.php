@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    {{-- Daftar Ulang | {{ $pesantren->nama_pesantren }} &nbsp;&nbsp; --}}
    <a type= "button" href="{{route('daftar-ulang.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH DAFTAR ULANG
    </a>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('daftar-ulang.index')}}">Daftar Ulang</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content">
                @foreach($data as $d)
                @php
                    $month = \Carbon\Carbon::parse($d->tanggal_pembayaran)->format('M');
                    $date = \Carbon\Carbon::parse($d->tanggal_pembayaran)->format('d F Y');
                @endphp
                    <div id="accordion1" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
                                Daftar Ulang <b>{{ $date }}</b> </a>
                                </h4>
                            </div>
                            <div id="accordion1_1" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <p>Jatuh Tempo : {{ date("Y") }} - {{ $month }} - 15</p>
                                    <p>Tanggal Bayar : {{ $d->tanggal_pembayaran }}</p>
                                    <p>Nominal : Rp. {{ number_format($d->debet_pembayaran ,2,',','.') }}</p>
                                    <p>Status Pembayaran : {{ $d->status_pembayaran }}</p>
                                    <p>Keterangan : {{ $d->keterangan_pembayaran }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
<script>
jQuery(document).ready(function() {
	//plugin datatable
	$('#sample_1').DataTable();

});
</script>
@stop
