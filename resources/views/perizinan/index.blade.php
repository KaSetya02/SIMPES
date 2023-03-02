@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Daftar Data Perizinan Santri &nbsp;&nbsp;
    <a type= "button" href="{{route('perizinan.create')}}" class="btn btn-primary btn-sm">
        + Tambah Daftar Data Perizinan Santri
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
            <a href="{{route('perizinan.index')}}">Daftar Data Perizinan Santri</a>
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

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<table class="table" id="sample_1">
    <thead>
        <tr>
            <!-- <th>ID</th> -->
            <th>Nama Santri</th>
            <th>Nama Perizinan</th>
            <th>Keterangan Perizinan</th>
            <th>Tanggal Awal Perizinan</th>
            <th>Tanggal Selesai Perizinan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->nama_santri }}</td>
            <td>{{ $d->riwayat_perizinan }}</td>
            <td>{{ $d->keterangan_perizinan }}</td>
            <td>{{ $d->tanggal_mulai }}</td>
            <td>{{ $d->tanggal_selesai }}</td>

            <td>
                <a class="btn btn-success" href="{{ route('perizinan.edit', $d->id) }}">Ubah</a> <br> <br>
                <form method="POST" action="{{route('perizinan.destroy' , $d->id)}}">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger" type="SUBMIT" value="Hapus" onclick="if(!confirm('Apakah Anda yakin?')) {return false;}">
                </form>
            </td>
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
