@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Presensi Santri Asrama <br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-santri-kelas.index')}}">Manajemen Akademik</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-santri-kelas.index')}}">Presensi Santri Asrama</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('presensi-santri-kelas.create')}}">Tambah Presensi Santri Asrama</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div >
<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Ubah Supplier
			</div>
		</div>
		<div class="portlet-body form">
			<form method="POST" action="{{ route('presensi-santri-kelas.update', $data->id) }}" enctype="multipart/form-data">
			@csrf
			@method("PUT")
            <div class="form-body">
                <div class="form-group">
                    <label for="pesantren_id">Pesantren</label>
                    <select name="pesantren_id" id="pesantren_id" data-with="100%" class="form-control @error('pesantren_id') is-invalid @enderror">
                        <option value="{{ $pesantren->id }}">{{ $pesantren->nama_pesantren }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="santri_id">Santri</label>
                    <select name="santri_id" id="santri_id" data-with="100%" class="form-control @error('santri_id') is-invalid @enderror">
                        @foreach ($santri as $s)
                        <option value="{{ $s->id }}" {{ old('santri_id', $s->id) == $data->santri_id  ? 'selected' : null }}>{{ $s->nama_santri }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" data-with="100%" class="form-control @error('kelas_id') is-invalid @enderror">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $s)
                        <option value="{{ $s->id }}" {{ old('kelas_id', $s->id) == $data->kelas_id  ? 'selected' : null }}>{{ $s->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_presensi">Tanggal Presensi</label>
                    <div>
                        <input type="date" id="tanggal_presensi" name="tanggal_presensi" class="form-control @error('tanggal_presensi') is-invalid @enderror" placeholder="dd-mm-yyyy" value="{{ old('tanggal_presensi', date('Y-m-d', $data->tanggal_presensi==null ? null : strtotime($data->tanggal_presensi)))}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <select name="keterangan" id="keterangan" data-with="100%" class="form-control @error('keterangan') is-invalid @enderror">
                        <option value="Masuk" {{ old('keterangan', "Masuk") == $data->keterangan  ? 'selected' : null }}>Masuk</option>
                        <option value="Sakit" {{ old('keterangan', "Sakit") == $data->keterangan  ? 'selected' : null }}>Sakit</option>
                        <option value="Ijin" {{ old('keterangan', "Ijin") == $data->keterangan  ? 'selected' : null }}>Ijin</option>
                        <option value="Alpha" {{ old('keterangan', "Alpha") == $data->keterangan  ? 'selected' : null }}>Alpha</option>
                    </select>
                </div>
            </div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Ubah</button>
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
