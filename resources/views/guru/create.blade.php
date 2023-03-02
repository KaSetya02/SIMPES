@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Guru<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('guru.index')}}">Manajemen Akademik</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('guru.index')}}">Guru</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('guru.create')}}">Tambah Guru</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Tambah Guru
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('guru.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="pesantren_id">Pesantren</label>
                    <select name="pesantren_id" id="pesantren_id" data-with="100%" class="form-control @error('pesantren_id') is-invalid @enderror">
                            <option value="{{ $getPesantren->id }}" {{ old('pesantren_id', $getPesantren->id) == $getPesantren->id  ? 'selected' : null }}>{{ $getPesantren->nama_pesantren }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_guru">Nama Guru</label>
                    <div>
                        <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" id="nama_guru" name="nama_guru" value="{{ old('nama_guru') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat_guru">Alamat</label>
                    <div>
                        <input type="text" class="form-control @error('alamat_guru') is-invalid @enderror" id="alamat_guru" name="alamat_guru" value="{{ old('alamat_guru') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto_guru" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="foto_guru" name="foto_guru" onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
                    @error('foto_guru')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                    <img class="img-fluid" id="img-preview" style="max-height:400px">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir_guru">Tanggal Lahir</label>
                    <div>
                        <input type="date" data-date-format="dd-mm-yyyy" class="form-control @error('tanggal_lahir_guru') is-invalid @enderror" id="tanggal_lahir_guru" name="tanggal_lahir_guru" value="{{ old('tanggal_lahir_guru') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nomor_guru">No. Hp</label>
                    <div>
                        <input type="text" class="form-control @error('nomor_guru') is-invalid @enderror" id="nomor_guru" name="nomor_guru" value="{{ old('nomor_guru') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pendidikan_guru">Pendidikan</label>
                    <div>
                        <input type="text" class="form-control @error('pendidikan_guru') is-invalid @enderror" id="pendidikan_guru" name="pendidikan_guru" value="{{ old('pendidikan_guru') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="walikelas">Wali Kelas</label>
                    <select name="walikelas" id="walikelas" data-with="100%" class="form-control @error('walikelas') is-invalid @enderror">
                            <option value="yes">Iya</option>
                            <option value="no">Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kategori_guru">Kategori Guru</label>
                    <select name="kategori_guru" id="kategori_guru" data-with="100%" class="form-control @error('kategori_guru') is-invalid @enderror">
                            <option value="Tetap">Tetap</option>
                            <option value="Honorer">Honorer</option>
                    </select>
                </div>
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
