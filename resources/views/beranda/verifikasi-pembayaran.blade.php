@extends('layouts.layout')

@section('content')
<h3 class="page-title">
    Verifikasi Pembayaran
</h3>
{{-- <div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('verifikasi-pembayaran.index')}}">Transaksi</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ route('verifikasi-pembayaran.create') }}">Tambah Verifikasi Pembayaran</a>
        </li>
    </ul>
</div> --}}
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
<div class="portlet">
    <div class="portlet-body form">
        {{-- <div class="form-body">
            <a href="{{ route('transaksi.bahanbaku.detail.create', $data->id )}}" class="btn btn-success btn-sm">+ Tambah Detail</a>
        </div> --}}
    </div>
</div>
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Verifikasi Pembayaran
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- <h4 class="control-label"><strong>Supplier</strong></h4> --}}
                        <p class="control-label">Pembayaran : {{ $data->nama_pembayaran }}</p>
                        <p class="control-label">Santri : {{ $data->nama_santri }}</p>
                        <p class="control-label">Debet Pembayaran : {{ $data->debet_pembayaran }}</p>
                        <p class="control-label">Kredit Pembayaran : {{ $data->kredit_pembayaran }}</p>
                        <p class="control-label">Keterangan : {{ $data->keterangan_pembayaran }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- <h4 class="control-label"><strong>Penjahit</strong></h4> --}}
                        <p class="control-label">Tanggal : {{ $data->tanggal_pembayaran }}</p>
                        <p class="control-label">Status : {{ $data->status_pembayaran }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Verifikasi Pembayaran
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('save-verifikasi-pembayaran') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="jenis_pembayaran_id">Jenis Pembayaran</label>
                    <select name="jenis_pembayaran_id" id="jenis_pembayaran_id" data-with="100%" class="form-control @error('jenis_pembayaran_id') is-invalid @enderror">
                        @foreach ($jenisPembayaran as $jp)
                            <option value="{{ $jp->id }}" {{ old('jenis_pembayaran_id') }}>{{ $jp->nama_pembayaran }} || Rp. {{ number_format($jp->kredit_pembayaran ,2,',','.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="upload_bukti" class="form-label">Upload Bukti</label>
                    <input class="form-control" type="file" id="upload_bukti" name="upload_bukti" onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
                    @error('upload_bukti')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                    <img class="img-fluid" id="img-preview" style="max-height:400px">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Bayar</label>
                    <div>
                        <input type="date" data-date-format="dd-mm-yyyy" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                    </div>
                </div>
                <input type="hidden" name="status_verifikasi" id="status_verifikasi" value=0>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>

</script>
@stop
