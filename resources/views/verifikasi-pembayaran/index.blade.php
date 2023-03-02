@extends('layouts.layout')

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
    Verfikasi Pembayaran &nbsp;&nbsp;
    {{-- <a type= "button" href="{{route('santri.create')}}" class="btn btn-primary btn-sm">
        + TAMBAH DATA SANTRI
    </a> --}}
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{url('/dashboard')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('santri.index')}}">Verfikasi Pembayaran</a>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

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

<!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
<table class="table" id="sample_1">
<thead>
    <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama Pembayaran</th>
    <th>Santri</th>
    <th>Nominal</th>
    <th>Status</th>
    <th>Bukti</th>
    <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @php
        $no = 1;
    @endphp
    @foreach($data as $d)
    <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $d->tanggal }}</td>
    <td>{{ $d->nama_pembayaran }}</td>
    <td>{{ $d->nama_santri }}</td>
    <td>{{ $d->kredit_pembayaran  }}</td>
    <td>
        @if ($d->status_verifikasi == 0)
            <p class="badge badge-default">Belum</p>
        @elseif ($d->status_verifikasi == 1)
            <p class="badge badge-success">Sukses</p>
        @else
            <p class="badge badge-danger">Tolak</p>
        @endif
    </td>
    <td>
        @if ($d->upload_bukti)
        <button type = "button" style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden;">
            <img src="{{ asset('file_upload/upload_bukti/'.$d->upload_bukti) }}" width="100px" alt="" data-toggle="modal" href="#detail_{{$d->id}}">
        @endif
        </button>
        <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{ $d->nama_guru }}</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('file_upload/upload_bukti/'.$d->upload_bukti) }}" width="500px" style="display: block; margin-left: auto; margin-right: auto;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>
    </td>
    <td>
        @if($d->status_verifikasi==0)
        <ul class="nav nav-pills">
            <li >
                <form method="POST" action="{{route('update-verifikasi-pembayaran')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <input type="hidden" name="status_verifikasi" value="1">
                    <button class="btn btn-success " type="submit" onclick="if(!confirm('Apakah Anda yakin akan verifikasi data berkaitan?')) {return false;}">Sukses</button>
                </form>
            </li>
            <li>
                <form method="POST" action="{{route('update-verifikasi-pembayaran')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <input  type="hidden" name="status_verifikasi" value="2">
                    <button class="btn btn-danger" type="submit" onclick="if(!confirm('Apakah Anda yakin akan verifikasi data berkaitan?')) {return false;}">Tolak</button>
                </form>
            </li>
        </ul>
        @endif
    </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
<script>
jQuery(document).ready(function() {
	//plugin datatable
	$('#sample_1').DataTable();
});
</script>
@stop

