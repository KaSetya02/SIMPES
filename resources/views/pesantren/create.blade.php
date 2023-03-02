@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Pesantren<br>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.index')}}">Setting</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.index')}}">Pesantren</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.create')}}">Tambah Pesantren</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Tambah Data Pesantren
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{ route('pesantren.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="namaPesantren">Nama Pesantren</label>
                    <input type="text" class="form-control @error('namaPesantren') is-invalid @enderror" name="namaPesantren" value="{{ old('namaPesantren') }}" placeholder="Isikan Nama Pesantren">
                    @error('namaPesantren')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-group">
                    <label for="alamatPesantren">Alamat Pesantren</label>
                    <textarea class="form-control @error('alamatPesantren') is-invalid @enderror" name="alamatPesantren" placeholder="Isikan Alamat Unit Pesantren" rows="3">{{ old('alamatPesantren') }}</textarea>
                    @error('alamatPesantren')
                    <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection

