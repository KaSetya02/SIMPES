@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Data Santri<br>
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
            <a href="{{route('santri.index')}}">Data Santri</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.create')}}">Tambah Data Santri</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<div >
<div class="portlet">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Ubah Data Santri
			</div>
		</div>
		<div class="portlet-body form">
            <form method="POST" action="{{ route('santri.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-body">
                    <div class="form-group">
                        <label for="foto_santri" class="form-label">Foto</label>
                        <input class="form-control" type="file" id="foto_santri" name="foto_santri" onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])">
                        @error('foto_santri')
                            <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                        @if($data->foto_santri)
                            <img src="{{ asset('image_upload/foto_santri/'.$data->foto_santri) }}" class="img-fluid" id="img-preview" style="max-height:400px">
                        @else
                            <img class="img-fluid" id="img-preview" style="max-height:400px">
                            @error('foto_santri')
                                <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nisSantri">NIS Santri</label>
                        <input type="number" class="form-control @error('nisSantri') is-invalid @enderror" name="nisSantri" value="{{ old('nisSantri', $data->nis) }}" placeholder="Isikan NIS Santri">
                        @error('nisSantri')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="namaSantri">Nama Santri</label>
                        <input type="text" class="form-control @error('namaSantri') is-invalid @enderror" name="namaSantri" value="{{ old('namaSantri', $data->nama_santri) }}" placeholder="Isikan nama Santri">
                        @error('namaSantri')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="tanggalSantri">Tanggal Lahir Santri</label>
                        <input type="date" class="form-control @error('tanggalSantri') is-invalid @enderror" name="tanggalSantri" value="{{ old('tanggalSantri', $data->tanggal_lahir_santri) }}" placeholder="Isikan Tanggal Lahir Santri">
                        @error('tanggalSantri')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="alamatSantri">Alamat Santri</label>
                        <textarea class="form-control @error('alamatSantri') is-invalid @enderror" name="alamatSantri" placeholder="Isikan deskripsi Alamat Santri" rows="3">{{ old('alamatSantri', $data->alamat_santri) }}</textarea>
                        @error('alamatSantri')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="namaAyah">Nama Ayah</label>
                        <input type="text" class="form-control @error('namaAyah') is-invalid @enderror" name="namaAyah" value="{{ old('namaAyah', $data->nama_ayah) }}" placeholder="Isikan Nama Ayah" min="0">
                        @error('namaAyah')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="namaIbu">Nama Ibu</label>
                        <input type="text" class="form-control @error('namaIbu') is-invalid @enderror" name="namaIbu" value="{{ old('namaIbu', $data->nama_ibu) }}" placeholder="Isikan Nama Ibu" min="0">
                        @error('namaIbu')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="asrama">Gedung Asrama Santri</label>
                        <input type="text" class="form-control @error('asrama') is-invalid @enderror" name="asrama" value="{{ old('asrama', $data->asrama_santri) }}" placeholder="Isikan Nama Gedung Asrama Santri" min="0">
                        @error('asrama')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="kamar">Nama Kamar Santri</label>
                        <input type="text" class="form-control @error('kamar') is-invalid @enderror" name="kamar" value="{{ old('kamar',$data->kamar_santri) }}" placeholder="Isikan Nama Kamar Santri" min="0">
                        @error('kamar')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label for="nominal_spp_perbulan">Nominal Spp Perbulan</label>
                        <input type="number" class="form-control @error('nominal_spp_perbulan') is-invalid @enderror" name="nominal_spp_perbulan" value="{{ old('nominal_spp_perbulan', $data->nominal_spp_perbulan) }}" placeholder="Isikan Nama Nominal Spp Perbulan Santri" min="0">
                        @error('nominal_spp_perbulan')
                        <div class="invalid-feedback" style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="statusAktif">Status Aktif</label> <br>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="statusAktif" id="statusAktif" value="yes" {{ $data->status_aktif == 'yes' ? 'checked' : ''}}>
                            <label for="aktif" class="form-check-label"> Aktif </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="statusAktif" id="statusAktif" value="Tidak" {{ $data->status_aktif == 'tidak' ? 'checked' : ''}}>
                            <label for="tidak" class="form-check-label"> Tidak Aktif </label>
                        </div>
                    </div><br>
                    <br>
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

