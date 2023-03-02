@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Pembayaran<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pembayaran.index')}}">Manajemen Keuangan</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pembayaran.index')}}">Pembayaran</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('pembayaran.create')}}">Tambah Pembayaran</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div>
    <div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Tambah Pembayaran
			</div>
		</div>
		<div class="portlet-body form">
			<form method="POST" action="{{ route('pembayaran.store') }}" enctype="multipart/form-data">
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
                        <select name="pegawai_id" id="pegawai_id" data-with="100%" class="form-control @error('pegawai_id') is-invalid @enderror" required>
                            <option value="">Pilih Pegawai</option>
                            @foreach ($pegawai as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_pegawai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_pembayaran">Nama Pembayaran</label>
                        <div>
                            <input type="text" id="nama_pembayaran" name="nama_pembayaran" class="form-control @error('nama_pembayaran') is-invalid @enderror" placeholder="Nama Pembayaran">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" id="jenis_pembayaran" data-with="100%" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nominal_pembayaran">Nominal Pembayaran</label>
                        <div>
                            <input type="number" id="nominal_pembayaran" name="nominal_pembayaran" class="form-control @error('nominal_pembayaran') is-invalid @enderror" placeholder="Nominal">
                        </div>
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
