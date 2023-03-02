@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Data Pegawai &nbsp;&nbsp;
    <a type= "button" href="{{route('pegawai.create')}}" class="btn btn-primary btn-sm">
        + Tambah Data Pegawai
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
            <a href="{{route('pegawai.index')}}">Data Pegawai</a>
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
            <th>Gambar</th>
            <th>Nama Pegawai</th>
            <th>Tanggal Lahir</th>
            <th>Alamat Santri</th>
            <th>Kontak Pegawai</th>
            <th>Unit Pegawai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>
                @if ($d->foto_pegawai)
                <button type = "button" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden;">
                    <img src="{{ asset('image_upload/foto_pegawai/'.$d->foto_pegawai) }}" width="100px" alt="" data-toggle="modal" href="#detail_{{$d->id}}">
                @endif
                </button>
                <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{ $d->nama_pegawai }}</h4>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('image_upload/foto_pegawai/'.$d->foto_pegawai) }}" width="500px" style="display: block; margin-left: auto; margin-right: auto;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>{{ $d->nama_pegawai }}</td>
            <td>{{ $d->tanggal_lahir_pegawai }}</td>
            <td>{{ $d->alamat_pegawai }}</td>
            <td>{{ $d->kontak_pegawai }}</td>
            <td>{{ $d->nama_pesantren }}</td>

            <td>
                <a class="btn btn-success" href="{{ route('pegawai.edit', $d->id) }}">Ubah</a> <br> <br>
                <form method="POST" action="{{route('pegawai.destroy' , $d->id)}}">
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


