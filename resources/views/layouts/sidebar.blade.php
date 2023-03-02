<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<form class="search-form" role="form" action="index.html" method="get">
						<div class="input-icon right">
							<i class="icon-magnifier"></i>
							<input type="text" class="form-control" name="query" placeholder="Search...">
						</div>
					</form>
				</li>
				<li class="{{ (request()->segment(1) == 'dashboard') ? 'active' : '' }} ">
					<a href="{{ route('dashboard') }}">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					{{-- <span class="selected"></span> --}}
					</a>
				</li>
                @if(Auth::user()->hasRole(['admin','super-admin']))
                <li class="{{ (request()->segment(1) == 'manajemen-santri') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-puzzle"></i>
                        <span class="title">Manajemen Santri</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'manajemen-santri') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'santri') ? 'active' : '' }}">
                            <a href="{{route('santri.index')}}">
                                <i class="icon-anchor"></i>
                                Data Santri</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'walisantri') ? 'active' : '' }}">
                            <a href="{{route('walisantri.index')}}">
                                <i class="icon-anchor"></i>
                                Wali Santri</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'kesehatan') ? 'active' : '' }}">
                            <a href="{{route('kesehatan.index')}}">
                                <i class="icon-book-open"></i>
                                Kesehatan</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'prestasi') ? 'active' : '' }}">
                            <a href="{{route('prestasi.index')}}">
                                <i class="icon-pin"></i>
                                Prestasi</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'ekstrakurikuler') ? 'active' : '' }}">
                            <a href="{{route('ekstrakurikuler.index')}}">
                                <i class="icon-vector"></i>
                                </span>Ekstrakurikuler</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'perizinan') ? 'active' : '' }}">
                            <a href="{{route('perizinan.index')}}">
                                <i class="icon-cursor"></i>
                                Perizinan</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'pelanggaran') ? 'active' : '' }}">
                            <a href="{{route('pelanggaran.index')}}">
                                <i class="icon-rocket"></i>
                                Pelanggaran</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'presensi-santri-asrama') ? 'active' : '' }}">
                            <a href="{{route('presensi-santri-asrama.index')}}">
                                <i class="icon-anchor"></i>
                                Presensi Asrama Santri</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->segment(1) == 'manajemen-pegawai') ? 'active' : '' }}">
                    <a href="javascript:;">
                    <i class="icon-briefcase"></i>
                    <span class="title">Manajemen Pegawai</span>
                    <span class="selected"></span>
                    <span class="arrow {{ (request()->segment(1) == 'manajemen-pegawai') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'pegawai') ? 'active' : '' }}">
                            <a href="{{route('pegawai.index')}}">
                                <i class="icon-anchor"></i>
                                Data Pegawai</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'presensi-pegawai') ? 'active' : '' }}">
                            <a href="{{route('presensi-pegawai.index')}}">
                                <i class="icon-anchor"></i>
                                Presensi Pegawai</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->segment(1) == 'manajemen-akademik') ? 'active' : '' }}">
                    <a href="javascript:;">
                    <i class="icon-present"></i>
                    <span class="title">Manajemen Akademik</span>
                    <span class="selected"></span>
                    <span class="arrow {{ (request()->segment(1) == 'manajemen-akademik') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'guru') ? 'active' : '' }}">
                            <a href="{{route('guru.index')}}">
                                <i class="icon-anchor"></i>
                                Data Guru</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'kelas') ? 'active' : '' }}">
                            <a href="{{route('kelas.index')}}">
                                <i class="icon-anchor"></i>
                                Data Kelas</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'mata-pelajaran') ? 'active' : '' }}">
                            <a href="{{route('mata-pelajaran.index')}}">
                                <i class="icon-anchor"></i>
                                Mata Pelajaran</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'nilai') ? 'active' : '' }}">
                            <a href="{{route('nilai.index')}}">
                                <i class="icon-anchor"></i>
                                Nilai Mata Pelajaran</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'presensi-santri-kelas') ? 'active' : '' }}">
                            <a href="{{route('presensi-santri-kelas.index')}}">
                                <i class="icon-anchor"></i>
                                Presensi Asrama Kelas</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->segment(1) == 'manajemen-keuangan') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-present"></i>
                        <span class="title">Manajemen Keuangan</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'manajemen-keuangan') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'pembayaran') ? 'active' : '' }}">
                            <a href="{{route('pembayaran.index')}}">
                                <i class="icon-anchor"></i>
                                Pembayaran</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'pengeluaran-pemasukan') ? 'active' : '' }}">
                            <a href="{{route('pengeluaran-pemasukan.index')}}">
                                <i class="icon-anchor"></i>
                                Pemasukan & Pengeluaran</a>
                        </li>
                       <!--  <li>
                            <a href="">
                                <i class="icon-anchor"></i>
                                Buku Besar</a>
                        </li> -->
                        <li class= "{{ (request()->segment(2) == 'daftar-ulang') ? 'active' : '' }}">
                            <a href="{{route('daftar-ulang.index')}}">
                                <i class="icon-anchor"></i>
                                Daftar Ulang</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'infaq') ? 'active' : '' }}">
                            <a href="{{route('infaq.index')}}">
                                <i class="icon-anchor"></i>
                                Infaq</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'spp') ? 'active' : '' }}">
                            <a href="{{route('spp.index')}}">
                                <i class="icon-anchor"></i>
                                SPP</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'verifikasi-pembayaran') ? 'active' : '' }}">
                            <a href="{{route('verifikasi-pembayaran.index')}}">
                                <i class="icon-anchor"></i>
                                Verifikasi Pembayaran</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'tagihan') ? 'active' : '' }}">
                            <a href="{{route('tagihan.index')}}">
                                <i class="icon-anchor"></i>
                                Tagihan</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'rekap-laporan') ? 'active' : '' }}">
                            <a href="{{route('rekap-laporan.index')}}">
                                <i class="icon-anchor"></i>
                                Rekap Laporan Pengeluaran & Pemasukan</a>
                        </li>
                    </ul>

                </li>
                <li class="{{ (request()->segment(1) == 'setting') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">Setting</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'setting') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'users') ? 'active' : '' }}">
                            <a href="{{route('users.index')}}">
                                <i class="icon-anchor"></i>
                               Users</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'roles') ? 'active' : '' }}">
                            <a href="{{route('roles.index')}}">
                                <i class="icon-book-open"></i>
                                Roles</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'pesantren') ? 'active' : '' }}">
                            <a href="{{route('pesantren.index')}}">
                                <i class="icon-anchor"></i>
                                Pesantren</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->hasRole('walisantri'))
                <li class="{{ (request()->segment(1) == 'manajemen-keuangan') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-present"></i>
                        <span class="title">Keuangan Bulanan</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'manajemen-keuangan') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'spp-walisantri') ? 'active' : '' }}">
                            <a href="{{route('spp-walisantri.index')}}">
                                <i class="icon-anchor"></i>
                                SPP</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'infaq') ? 'active' : '' }}">
                            <a href="{{route('infaq.index')}}">
                                <i class="icon-anchor"></i>
                                Infaq</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'daftar-ulang-walisantri') ? 'active' : '' }}">
                            <a href="{{route('daftar-ulang-walisantri.index')}}">
                                <i class="icon-anchor"></i>
                                Daftar Ulang</a>
                        </li>
                    </ul>

                </li>
                <li class="{{ (request()->segment(1) == 'manajemen-santri') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-puzzle"></i>
                        <span class="title">Status Santri</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'manajemen-santri') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'kesehatan') ? 'active' : '' }}">
                            <a href="{{route('kesehatan.index')}}">
                                <i class="icon-book-open"></i>
                                Kesehatan</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'prestasi') ? 'active' : '' }}">
                            <a href="{{route('prestasi.index')}}">
                                <i class="icon-pin"></i>
                                Prestasi</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'ekstrakurikuler') ? 'active' : '' }}">
                            <a href="{{route('ekstrakurikuler.index')}}">
                                <i class="icon-vector"></i>
                                </span>Ekstrakurikuler</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'perizinan') ? 'active' : '' }}">
                            <a href="{{route('perizinan.index')}}">
                                <i class="icon-cursor"></i>
                                Perizinan</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'pelanggaran') ? 'active' : '' }}">
                            <a href="{{route('pelanggaran.index')}}">
                                <i class="icon-rocket"></i>
                                Pelanggaran</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->segment(1) == 'pembayaran') ? 'active' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-present"></i>
                        <span class="title">Pembayaran</span>
                        <span class="selected"></span>
                        <span class="arrow {{ (request()->segment(1) == 'pembayaran') ? 'open' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class= "{{ (request()->segment(2) == 'tagihan-spp') ? 'active' : '' }}">
                            <a href="{{route('tagihan-spp.index')}}">
                                <i class="icon-anchor"></i>
                                SPP</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'infaq') ? 'active' : '' }}">
                            <a href="{{route('infaq.index')}}">
                                <i class="icon-anchor"></i>
                                Infaq</a>
                        </li>
                        <li class= "{{ (request()->segment(2) == 'tagihan-daftar-ulang') ? 'active' : '' }}">
                            <a href="{{route('tagihan-daftar-ulang.index')}}">
                                <i class="icon-anchor"></i>
                                Daftar Ulang</a>
                        </li>
                    </ul>

                </li>
                @endif
			</ul>
			<!-- END SIDEBAR MENU -->
