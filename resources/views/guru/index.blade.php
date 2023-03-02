@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Guru &nbsp;&nbsp;
    <a type= "button" href="{{route('guru.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH GURU
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
            <a href="{{route('guru.index')}}">Guru</a>
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

{{-- <div class="alert alert-default">
    <form method="POST" action="">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label">Nama Pemesanan</label>
            <div class="col-md-10">
                <select name="s_pemesanan_id" id="s_pemesanan_id" data-with="100%" class="form-control @error('s_pemesanan_id') is-invalid @enderror">
                    <option value="">Pilih Nama Pemesanan</option>
                    @foreach($viewTransaksiPemesanan as $p)
                        <option value="{{ $p->detail_pemesanan_model_id }}" {{ old('s_pemesanan_id', $id) == $p->detail_pemesanan_model_id ? 'selected' : null }}>Pelanggan : {{ $p->nama_pelanggan }} | Tanggal : {{ $p->tanggal }} | Jenis Model : {{ $p->jenis_model }} | Jumlah : {{ $p->jumlah }} {{ $p->satuan }}</option>
                    @endforeach
                </select>
                @error('s_pemesanan_id')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <a href="" id="btn-search" class="btn btn-info">Search</a>
            </div>
        </div>
   </form>
</div> --}}

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<table class="table" id="sample_1">
<thead>
    <tr>
    <th>Foto</th>
    <th>Nama Guru</th>
    <th>Alamat</th>
    <th>No. Hp</th>
    <th>Kategori Guru</th>
    <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($data as $d)
    <tr>
    <td>
        @if ($d->foto_guru)
        <button type = "button" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden;">
            <img src="{{ asset('image_upload/foto_guru/'.$d->foto_guru) }}" width="100px" alt="" data-toggle="modal" href="#detail_{{$d->id}}">
        @endif
        </button>
        <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{ $d->nama_guru }}</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('image_upload/foto_guru/'.$d->foto_guru) }}" width="500px" style="display: block; margin-left: auto; margin-right: auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>
    </td>
    <td>{{ $d->nama_guru }}</td>
    <td>{{ $d->alamat_guru }}</td>
    <td>{{ $d->nomor_guru  }}</td>
    <td>{{ $d->kategori_guru  }}</td>
    <td>
        <ul class="nav nav-pills">
            <li >
                <button onclick="window.location='{{ route('guru.edit', $d->id) }}'" type="button" class="btn btn-success">Ubah</button>
            </li>
            <li>
                <form method="POST" action="{{route('guru.destroy' , $d->id)}}">
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
