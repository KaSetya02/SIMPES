@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Data Pegawai<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pegawai.index')}}">Manajemen Pegawai</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pegawai.index')}}">Data Pegawai</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pegawai.create')}}">Tambah Data Pegawai</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Tambah Data Pegawai
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="foto_pegawai" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="foto_pegawai" name="foto_pegawai" onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
                    @error('foto_pegawai')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                    <img class="img-fluid" id="img-preview" style="max-height:400px">
                </div>
                <div class="form-group">
                    <label for="namaPegawai">Nama Pegawai</label>
                    <input type="text" class="form-control @error('namaPegawai') is-invalid @enderror" name="namaPegawai" value="{{ old('namaPegawai') }}" placeholder="Isikan nama Pegawai">
                    @error('namaPegawai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="alamatPegawai">Alamat Pegawai</label>
                    <textarea class="form-control @error('alamatPegawai') is-invalid @enderror" name="alamatPegawai" placeholder="Isikan deskripsi Alamat Pegawai" rows="3">{{ old('alamatPegawai') }}</textarea>
                    @error('alamatPegawai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="kontakPegawai">Kontak Pegawai</label>
                    <input type="number" class="form-control @error('kontakPegawai') is-invalid @enderror" name="kontakPegawai" value="{{ old('kontakPegawai') }}" placeholder="Isikan Nomor Handphone Pegawai">
                    @error('kontakPegawai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="tanggalPegawai">Tanggal Lahir Pegawai</label>
                    <input type="date" class="form-control @error('tanggalPegawai') is-invalid @enderror" name="tanggalPegawai" value="{{ old('tanggalPegawai') }}" placeholder="Isikan Tanggal Lahir Pegawai">
                    @error('tanggalPegawai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                {{-- <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Nama Pesantren</label>
                    <div class="col-md-6">
                        <select name="namaPesantren" id="namaPesantren" class="form-control @error('namaPesantren') is-invalid @enderror">
                            <option value="">== Pilih Nama Unit Pesantren ==</option>
                            @foreach($datapesantren as $dp)
                            <option value="{{ $dp->id }}" {{ old('namaPesantren') == $dp->id ? 'selected' : null }}>{{ $dp->nama_pesantren }}</option>
                            @endforeach
                        </select>
                        @error('namaPesantren')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection
