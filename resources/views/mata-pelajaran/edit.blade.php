@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Mata Pelajaran<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('mata-pelajaran.index')}}">Manajemen Akademik</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('mata-pelajaran.index')}}">Mata Pelajaran</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('mata-pelajaran.create')}}">Tambah Mata Pelajaran</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div >
<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Ubah Mata Pelajaran
			</div>
		</div>
		<div class="portlet-body form">
			<form method="POST" action="{{ route('mata-pelajaran.update', $data->id) }}" enctype="multipart/form-data">
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
                        <label for="nama_mata_pelajaran">Nama Mata Pelajaran</label>
                        <div>
                            <input type="text" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror" id="nama_mata_pelajaran" name="nama_mata_pelajaran" value="{{ old('nama_mata_pelajaran', $data->nama_mata_pelajaran) }}">
                        </div>
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
