@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Kelas<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('kelas.index')}}">Manajemen Akademik</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('kelas.index')}}">Kelas</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('kelas.create')}}">Tambah Kelas</a>
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
			<form method="POST" action="{{ route('kelas.update', $data->id) }}" enctype="multipart/form-data">
			@csrf
			@method("PUT")
                <div class="form-body">
                    {{-- <div class="form-group">
                        <label for="pesantren_id">Pesantren</label>
                        <select name="pesantren_id" id="pesantren_id" data-with="100%" class="form-control @error('pesantren_id') is-invalid @enderror">
                                <option value="{{ $data->pesantren_id }}" {{ old('pesantren_id', $data->pesantren_id) == $data->pesantren_id  ? 'selected' : null }}>{{ $data->nama_pesantren }}</option>
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="pesantren_id">Pesantren</label>
                        <select name="pesantren_id" id="pesantren_id" data-with="100%" class="form-control @error('pesantren_id') is-invalid @enderror">
                            <option value="{{ $pesantren->id }}">{{ $pesantren->nama_pesantren }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <div>
                            <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $data->nama_kelas) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        <select name="guru_id" id="guru_id" data-with="100%" class="form-control @error('guru_id') is-invalid @enderror">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id', $g->id) == $data->guru_id  ? 'selected' : null }}>{{ $g->nama_guru }}</option>
                            @endforeach
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
