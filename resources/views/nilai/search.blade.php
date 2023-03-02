@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Mata Pelajaran &nbsp;&nbsp;
    <a type= "button" href="{{route('mata-pelajaran.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH MATA PELAJARAN
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
            <a href="{{route('mata-pelajaran.index')}}">Mata Pelajaran</a>
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
    <form  action="{{route('nilai-search')}}" method ="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="container-fluid">
                    <div class="form-group row">
                        <label for="date" class="col-form-label col-sm-2">Filter</label>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="santri_id" id="santri_id" data-with="100%" class="form-control @error('santri_id') is-invalid @enderror">
                                <option value="">Pilih Santri</option>
                                @foreach ($santri as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_santri }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="kelas_id" id="kelas_id" data-with="100%" class="form-control @error('kelas_id') is-invalid @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_kelas }}</option>
                                @endforeach
                            </select>
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
    <th>Kelas</th>
    <th>Nama Santri</th>
    <th>Mata Pelajaran</th>
    <th>Nilai Tugas</th>
    <th>Nilai UTS</th>
    <th>Nilai UAS</th>
    <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @php
        $no = 1;
    @endphp
    @foreach($data as $d)
    <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $d->nama_kelas }}</td>
    <td>{{ $d->nama_santri }}</td>
    <td>{{ $d->nama_mata_pelajaran }}</td>
    <td>{{ $d->nilai_tugas }}</td>
    <td>{{ $d->nilai_uts }}</td>
    <td>{{ $d->nilai_uas }}</td>
    <td>
        <ul class="nav nav-pills">
            <li >
                <button onclick="window.location='{{ route('mata-pelajaran.edit', $d->id) }}'" type="button" class="btn btn-success">Ubah</button>
            </li>
            <li>
                <form method="POST" action="{{route('mata-pelajaran.destroy' , $d->id)}}">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger " type="SUBMIT" value="Hapus"
                    onclick="if(!confirm('Apakah Anda yakin akan menghapus data jadwal-progres dan data sediaan bahan baku yang berkaitan?')) {return false;}">
                </form>
            </li>
        </ul>
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
