@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
   Wali Santri <br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('walisantri.index')}}">Pemesanan</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('walisantri.index')}}">Pengunaan Bahan Baku</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('walisantri.create')}}">TambahWali Santri</a>
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
			<form method="POST" action="{{ route('walisantri.update', $data->id) }}" enctype="multipart/form-data">
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
                        <label for="nama_walisantri">Nama Wali Santri</label>
                        <div>
                            <input type="text" class="form-control @error('nama_walisantri') is-invalid @enderror" id="nama_walisantri" name="nama_walisantri" value="{{ old('nama_walisantri', $data->nama_walisantri) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kontak_walisantri">Kontak Wali santri</label>
                        <div>
                            <input type="text" class="form-control @error('kontak_walisantri') is-invalid @enderror" id="kontak_walisantri" name="kontak_walisantri" value="{{ old('kontak_walisantri', $data->kontak_walisantri) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_walisantri">Email Wali Santri</label>
                        <div>
                            <input type="text" class="form-control @error('email_walisantri') is-invalid @enderror" id="email_walisantri" name="email_walisantri" value="{{ old('email_walisantri', $data->email_walisantri) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="santri_id">Santri</label>
                        <select name="santri_id" id="santri_id" data-with="100%" class="form-control @error('santri_id') is-invalid @enderror">
                            <option value="">Pilih Santri</option>
                            @foreach ($santri as $g)
                            <option value="{{ $g->id }}" {{ old('santri_id', $g->id) == $data->santri_id  ? 'selected' : null }}>{{ $g->nama_santri }}</option>
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
