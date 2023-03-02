@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    {{-- SPP | {{ $pesantren->nama_pesantren }} &nbsp;&nbsp;
    <a type= "button" href="{{route('spp.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH SPP
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
            <a href="{{route('spp.index')}}">SPP</a>
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

<div class="alert alert-default">
    <form  action="{{route('rekap-laporan-search')}}" method ="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="container-fluid">
                    <div class="form-group row">
                        <label for="date" class="col-form-label col-sm-2">Dari Tanggal</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" value="{{ old('fromDate') }}" required/>
                        </div>
                        <label for="date" class="col-form-label col-sm-2">Sampai Tanggal</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="toDate" name="toDate" value="{{ old('toDate') }}" required/>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn" name="search" title="Search"><i class="icon-magnifier"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<table class="table" id="sample_1">
<thead>
    <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama</th>
    <th>Keterangan</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Nama Santri</th>
    <th>Status</th>
    {{-- <th>Aksi</th> --}}
    </tr>
</thead>
<tbody>
    @php
        $no = 1;
    @endphp
    @foreach($data as $d)
    <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $d->tanggal_pembayaran }}</td>
    <td>{{ $d->nama_pembayaran }}</td>
    <td>{{ $d->keterangan_pembayaran }}</td>
    <td>Rp. {{ number_format($d->debet_pembayaran ,2,',','.') }}</td>
    <td>Rp. {{ number_format($d->kredit_pembayaran ,2,',','.') }}</td>
    <td>{{ $d->nama_santri }}</td>
    <td>{{ $d->status_pembayaran }}</td>
    {{-- <td>
        <ul class="nav nav-pills">
            <li >
                <button onclick="window.location='{{ route('spp.edit', $d->id) }}'" type="button" class="btn btn-success">Ubah</button>
            </li>
            <li>
                <form method="POST" action="{{route('spp.destroy' , $d->id)}}">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger " type="SUBMIT" value="Hapus"
                    onclick="if(!confirm('Apakah Anda yakin akan menghapus data jadwal-progres dan data sediaan bahan baku yang berkaitan?')) {return false;}">
                </form>
            </li>
        </ul>
    </td> --}}
    </tr>
    @endforeach
</tbody>
</table>
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
