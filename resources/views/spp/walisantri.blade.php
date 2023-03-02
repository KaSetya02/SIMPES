@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    {{-- Daftar Ulang | {{ $pesantren->nama_pesantren }} &nbsp;&nbsp; --}}
    {{-- <a type= "button" href="{{route('daftar-ulang.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH DAFTAR ULANG
    </a> --}}
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('daftar-ulang.index')}}">SPP</a>
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
                <div id="accordion1" class="panel-group">
                    @for ($i=1; $i<=12; $i++)
                        @if($i== 1)
                            @php
                            $bulan = "Januari";
                            @endphp
                        @elseif ($i == 2)
                            @php
                            $bulan = "Februari";
                            @endphp
                        @elseif ($i == 3)
                            @php
                            $bulan = "Maret";
                            @endphp
                        @elseif ($i == 4)
                            @php
                            $bulan = "April";
                            @endphp
                        @elseif ($i == 5)
                            @php
                            $bulan = "Mei";
                            @endphp
                        @elseif ($i == 6)
                            @php
                            $bulan = "Juni";
                            @endphp
                        @elseif ($i == 7)
                            @php
                            $bulan = "July";
                            @endphp
                        @elseif ($i == 8)
                            @php
                            $bulan = "Agustus";
                            @endphp
                        @elseif ($i == 9)
                            @php
                            $bulan = "September";
                            @endphp
                        @elseif ($i == 10)
                            @php
                            $bulan = "Oktober";
                            @endphp
                        @elseif ($i == 11)
                            @php
                            $bulan = "November";
                            @endphp
                        @elseif ($i == 12)
                            @php
                            $bulan = "Desember";
                            @endphp
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_{{ $i }}">
                                SPP pada bulan <b>{{ $bulan }}</b></a>
                                </h4>
                            </div>
                            <div id="accordion1_{{ $i }}" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    @foreach ($data as $item)
                                    @php
                                        $month = \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('m');
                                    @endphp
                                    @if($month == $i)
                                    <p>Jatuh Tempo : {{ date("Y") }} - {{ $i }} - 15</p>
                                    <p>Tanggal Bayar : {{ $item->tanggal_pembayaran }}</p>
                                    <p>Nominal : Rp. {{ number_format($item->debet_pembayaran ,2,',','.') }}</p>
                                    <p>Status Pembayaran : {{ $item->status_pembayaran }}</p>
                                    <p>Keterangan : {{ $item->keterangan_pembayaran }}</p>
                                    @else

                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endfor
                </div>
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
