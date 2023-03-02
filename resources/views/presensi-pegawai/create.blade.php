@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Presensi Pegawai<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-pegawai.index')}}">Manajemen Akademik</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-pegawai.index')}}">Presensi Pegawai</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-pegawai.create')}}">Tambah Presensi Pegawai</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div>
    <div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Tambah Presensi Pegawai
			</div>
		</div>
		<div class="portlet-body form">
			<form method="POST" action="{{ route('presensi-pegawai.store') }}" enctype="multipart/form-data">
			@csrf
				<div class="form-body">
                    <div class="form-group">
                        <label for="pesantren_id">Pesantren</label>
                        <select name="pesantren_id" id="pesantren_id" data-with="100%" class="form-control @error('pesantren_id') is-invalid @enderror">
                            <option value="{{ $pesantren->id }}">{{ $pesantren->nama_pesantren }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pegawai_id">Pegawai</label>
                        <select name="pegawai_id" id="pegawai_id" data-with="100%" class="form-control @error('pegawai_id') is-invalid @enderror">
                            <option value="">Pilih Pegawai</option>
                            @foreach ($pegawai as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_pegawai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_presensi">Tanggal Presensi</label>
                        <div>
                            <input type="datetime-local" id="tanggal_presensi" name="tanggal_presensi" class="form-control @error('tanggal_presensi') is-invalid @enderror" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" data-with="100%" class="form-control @error('keterangan') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="Masuk">Masuk</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Ijin">Ijin</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                    </div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection
