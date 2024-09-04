<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">

    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand">
          <img src="{{ asset('argon2/assets/img/logo.png') }}" class="navbar-brand-img" alt="..." style="max-height: 2rem !important;">
          <span class="text-sm font-weight-bold">PT. Tiara Indoprima</span>
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        @php
          use App\Helpers\Menu;
          use App\Helpers\AuthCommon;
          $menu = '';
          $role = session('role_permit');
  
          // dd($permission);
  
          $obj_menu = new Menu();
          $obj_menu->setRole($role);
          $obj_menu->init()
          ->start_group()
          ->item('Dashboard', 'ni ni-tv-2', 'inventory/dashboard', Request::is('inventory/dashboard'), ["super_admin"])
          ->end_group();

          $obj_menu->start_group()
          ->start_accordion()
          ->sub_item_accordion('Master Data','master',['super_admin'],'fas fa-database')
          ->start_item_accordion('master', (
            Request::is('inventory/bahan') ||
            Request::is('inventory/barang')
          ))
          ->item('Bahan Baku', 'ni ni-briefcase-24', 'inventory/bahan', Request::is('inventory/bahan'),['super_admin'])
          ->item('Barang Jadi', 'ni ni-briefcase-24', 'inventory/barang', Request::is('inventory/barang'),['super_admin'])
          ->end_item_accordion()
          ->end_accordion()
          ->end_group();

          $obj_menu->start_group()
          ->start_accordion()
          ->sub_item_accordion('Manajemen User','user-management',['super_admin'], 'ni ni-badge')
          ->start_item_accordion('user-management', (Request::is('inventory/user')) )
          ->item('Manage Role', 'fas fa-users', 'admin/role', Request::is('admin/role'),['super_admin'])
          ->item('Manage User', 'ni ni-circle-08', 'inventory/user', Request::is('inventory/user'),['super_admin'])
          ->end_item_accordion()
          ->end_accordion()
          ->end_group();
  
        //   $obj_menu->start_group()
        //   ->start_accordion()
        //   ->sub_item_accordion('Master','master',['dashboard.dashboard'])
        //   ->start_item_accordion('master', (Request::is('admin/kabid') ||
        //                                     Request::is('admin/kabag') ||
        //                                     Request::is('admin/kasie') ||
        //                                     Request::is('admin/sales') ||
        //                                     Request::is('admin/teller') ||
        //                                     Request::is('admin/kantor') ||
        //                                     Request::is('admin/jabatan') ||
        //                                     Request::is('admin/bulan') ||
        //                                     Request::is('admin/provinsi') ||
        //                                     Request::is('admin/kabupaten') ||
        //                                     Request::is('admin/kecamatan') ||
        //                                     Request::is('admin/kelurahan') ||
        //                                     Request::is('admin/target_kunjungan')) )
        //   ->item('Kepala Bidang', 'ni ni-briefcase-24', 'admin/kabid', Request::is('admin/kabid'),['super_admin'])
        //   ->item('Kepala Bagian', 'ni ni-briefcase-24', 'admin/kabag', Request::is('admin/kabag'),'kepala_bagian.list')
        //   ->item('Kasie', 'ni ni-briefcase-24', 'admin/kasie', Request::is('admin/kasie'),'kepala_seksi.list')
        //   ->item('Tim AO / FO', 'ni ni-briefcase-24', 'admin/sales', Request::is('admin/sales'),'sales.list')
        //   ->item('Teller', 'ni ni-building', 'admin/teller', Request::is('admin/teller'),'teller.list')
        //   ->item('Kantor', 'ni ni-building', 'admin/kantor', Request::is('admin/kantor'),'kantor.list')
        //   ->item('Jabatan', 'ni ni-building', 'admin/jabatan', Request::is('admin/jabatan'),'jabatan.list')
        //   ->item('Tenor Kredit', 'ni ni-building', 'admin/bulan', Request::is('admin/bulan'),'bulan.list')
        //   ->item('Provinsi', 'ni ni-building', 'admin/provinsi', Request::is('admin/provinsi'),'provinsi.list')
        //   ->item('Kabupaten', 'ni ni-building', 'admin/kabupaten', Request::is('admin/kabupaten'),'kabupaten.list')
        //   ->item('Kecamatan', 'ni ni-building', 'admin/kecamatan', Request::is('admin/kecamatan'),'kecamatan.list')
        //   ->item('Kelurahan', 'ni ni-building', 'admin/kelurahan', Request::is('admin/kelurahan'),'kelurahan.list')
        //   ->item('Target Kunjungan', 'ni ni-briefcase-24', 'admin/target_kunjungan', Request::is('admin/target_kunjungan'),'target_kunjungan.list')
        //   ->end_item_accordion()
        //   ->end_accordion()
        //   ->end_group();
  
        //   $obj_menu->start_group()
        //   ->start_accordion()
        //   ->sub_item_accordion('Emause','emause',['dashboard.dashboard'])
        //   ->start_item_accordion('emause', (Request::is('admin/nasabah') ||
        //                                     Request::is('admin/laporanPembayaran') ||
        //                                     Request::is('admin/laporanKunjungan') ||
        //                                     Request::is('admin/laporanSetoran') ||
        //                                     Request::is('admin/penagihan') ||
        //                                     Request::is('admin/settlement') ||
        //                                     Request::is('admin/lkh') ||
        //                                     Request::is('admin/setoran') ||
        //                                     Request::is('admin/penyelesaian') || 
        //                                     Request::is('admin/transaksiCbs')))
        //   ->item('Nasabah', 'fas fa-chalkboard-teacher', 'admin/nasabah', Request::is('admin/nasabah'),'nasabah.list')
        //   ->item('Transaksi CBS', 'fas fa-file-invoice-dollar', 'admin/transaksiCbs', Request::is('admin/transaksiCbs'),'lkh.list')
        //   ->item('Laporan Pembayaran', 'fas fa-file-contract', 'admin/laporanPembayaran', Request::is('admin/laporanPembayaran'),'laporan_pembayaran.list')
        //   ->item('Laporan Kunjungan AO', 'fas fa-file-contract', 'admin/laporanKunjungan', Request::is('admin/laporanKunjungan'),'laporan_kunjungan.list')
        //   ->item('Laporan Setoran AO', 'fas fa-file-contract', 'admin/laporanSetoran', Request::is('admin/laporanSetoran'),'laporan_setoran.list')
        //   ->item('Penagihan', 'fas fa-hand-holding-usd', 'admin/penagihan', Request::is('admin/penagihan'),'penagihan.list')
        //   ->item('Settlement', 'fas fa-coins', 'admin/settlement', Request::is('admin/settlement'),'settlement.list')
        //   ->item('Setoran Settlement', 'fas fa-funnel-dollar', 'admin/setoran', Request::is('admin/setoran'),'setoran.list')
        //   ->item('LKH', 'fas fa-calendar-check', 'admin/lkh', Request::is('admin/lkh'),'lkh.list')
        //   ->item('Penyelesaian', 'fas fa-clipboard-check', 'admin/penyelesaian', Request::is('admin/penyelesaian'),'lkh.list')
        //   ->end_item_accordion()
        //   ->end_accordion()
        //   ->end_group();
  
        //   $obj_menu
        //     ->start_group()
        //     ->start_accordion()
        //     ->sub_item_accordion('Mail Management', 'mailing', ['surat_peringatan.list','surat_angsuran.list','history_sp.list','approval_sp.list','surat_pjt.list','surat_ppj.list','surat_pppk.list','surat_somasi.list','invoice.list'], 'fas fa-envelope')
        //     ->start_item_accordion('mailing', Request::is('admin/surat/pemberitahuan') ||
        //                                       Request::is('admin/surat/pengamanan') ||
        //                                       Request::is('admin/surat/pengalihan') ||
        //                                       Request::is('admin/surat/angsuran') ||
        //                                       Request::is('admin/surat/somasi') ||
        //                                       Request::is('admin/surat/peringatan') ||
        //                                       Request::is('admin/surat/historysp') ||
        //                                       Request::is('admin/surat/invoice') ||
        //                                       Request::is('admin/approval_surat/surat_peringatan'))
  
        //     ->item('Surat Peringatan', 'fas fa-envelope', 'admin/surat/peringatan', Request::is('admin/surat/peringatan'), 'surat_peringatan.list')
        //     ->item('History SP', 'fas fa-envelope', 'admin/surat/historysp', Request::is('admin/surat/historysp'),'history_sp.list')
        //     ->item('Approval Surat Peringatan', 'fas fa-envelope', 'admin/approval_surat/surat_peringatan', Request::is('admin/approval_surat/surat_peringatan'),'approval_sp.list')
  
        //     ->item('Surat Pemberitahuan Jatuh Tempo', 'fas fa-envelope', 'admin/surat/pemberitahuan', Request::is('admin/surat/pemberitahuan'), 'surat_pjt.list')
        //     ->item('Surat Pemberitahuan Angsuran Kredit', 'fas fa-envelope', 'admin/surat/angsuran', Request::is('admin/surat/angsuran'), 'surat_angsuran.list')
  
        //     ->item('Surat Pemberitahuan Dan Penyerahan Jaminan', 'fas fa-envelope', 'admin/surat/pengamanan', Request::is('admin/surat/pengamanan'), 'surat_ppj.list')
        //     ->item('Surat Somasi Lelang', 'fas fa-envelope', 'admin/surat/somasi', Request::is('admin/surat/somasi'), 'surat_somasi.list')
        //     ->item('Invoice', 'fas fa-envelope', 'admin/invoice', Request::is('admin/invoice'), 'invoice.list')
  
        //     // Un-used
        //   //  ->item('Surat Pemberitahuan Pengalihan Pengelolaan Kredit', 'fas fa-envelope', 'admin/surat/pengalihan', Request::is('admin/surat/pengalihan'), 'surat_pppk.list')
        //     ->end_item_accordion()
        //     ->end_accordion()
        //     ->end_group();
  
          // $obj_menu->start_group()
          // ->start_accordion()
          // ->sub_item_accordion('Nasabah','nasabah',['dashboard.dashboard'])
          // ->start_item_accordion('nasabah',(Request::is('admin/nasabah/kredit') ||
          //                                   Request::is('admin/nasabah/tabungan') ||
          //                                   Request::is('admin/nasabah/deposito')) )
          // ->item('Kredit', 'fas fa-credit-card', 'admin/nasabah/kredit', Request::is('admin/nasabah/kredit'),'dashboard.dashboard')
          // ->item('Tabungan', 'fas fa-credit-card', 'admin/nasabah/tabungan', Request::is('admin/nasabah/tabungan'),'dashboard.dashboard')
          // ->item('Deposito', 'fas fa-credit-card', 'admin/nasabah/deposito', Request::is('admin/nasabah/deposito'),'dashboard.dashboard')
          // ->end_item_accordion()
          // ->end_accordion()
          // ->end_group();
  
          // $obj_menu->start_group()
          // ->start_accordion()
          // ->sub_item_accordion('Riwayat','riwayat',['dashboard.dashboard'])
          // ->start_item_accordion('riwayat', (Request::is('admin/perpindahan')))
          // ->item('Penagihan Nasabah', 'ni ni-app', 'admin/perpindahan', Request::is('admin/perpindahan'),'dashboard.dashboard')
          // ->end_item_accordion()
          // ->end_accordion()
          // ->end_group();
  
        //   $obj_menu->start_group()
        //   ->start_accordion()
        //   ->sub_item_accordion('User Management','user-management',['module.list','role.list','user.list'])
        //   ->start_item_accordion('user-management', (Request::is('admin/module') ||
        //                                              Request::is('admin/role') ||
        //                                              Request::is('admin/user')) )
        //   ->item('Manage Module', 'ni ni-app', 'admin/module', Request::is('admin/module'),'module.list')
        //   ->item('Manage Role', 'fas fa-users', 'admin/role', Request::is('admin/role'),'role.list')
        //   ->item('Manage User', 'ni ni-settings', 'admin/user', Request::is('admin/user'),'user.list')
        //   ->end_item_accordion()
        //   ->end_accordion()
        //   ->end_group();
  
            $menu = $obj_menu->to_html();
        @endphp
        {{-- @include('admin.submenu') --}}
        {!! $menu !!}
      </div>
    </div>
  </nav>
  