@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Daftar Data Perizinan Santri<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.index')}}">Manajemen Santri</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.index')}}">Daftar Data Perizinan Santri</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.create')}}">Tambah Daftar Data Perizinan Santri</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Tambah Daftar Data Perizinan Santri
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('perizinan.update',$data->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-body">
                <div class="form-group">
                    <label for="santri_id">Nama Santri</label>
                    <select id="santri_id" class="form-control @error('santri_id') is-invalid @enderror" name="santri_id">
                        <option value="">Pilih Nama Santri</option>
                        @foreach($datasantri as $ds)
                        <option value="{{ $ds->id }}" {{ old('santri_id', $ds->id) == $data->santri_id  ? 'selected' : null }}>{{ $ds->nama_santri }}</option>
                        @endforeach
                    </select>
                    @error('santri_id')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="riwayat_perizinan">Riwayat Perizinan</label>
                    <input type="number" class="form-control @error('riwayat_perizinan') is-invalid @enderror" name="riwayat_perizinan" value="{{ old('riwayat_perizinan', $data->riwayat_perizinan) }}" placeholder="Isikan Izin">
                    @error('riwayat_perizinan')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="keterangan_perizinan">Keterangan Perizinan</label>
                    <input type="text" class="form-control @error('keterangan_perizinan') is-invalid @enderror" name="keterangan_perizinan" value="{{ old('keterangan_perizinan', $data->keterangan_perizinan) }}" placeholder="Isikan nama Santri">
                    @error('keterangan_perizinan')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" placeholder="Isikan Tanggal Lahir Santri">
                    @error('tanggal_mulai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" value="{{ old('tanggal_selesai', $data->tanggal_selesai) }}" placeholder="Isikan Tanggal Lahir Santri">
                    @error('tanggal_selesai')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
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
