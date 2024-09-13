<style>
  
</style>
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">

  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand">
        <img src="{{ asset('argon2/assets/img/logo.png') }}" class="navbar-brand-img" alt="..."
          style="max-height: 2rem !important;">
        <span class="text-sm font-weight-bold">PT. Tiara Indoprima</span><br>
        
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
      ->item('Dashboard', 'ni ni-tv-2', 'inventory/dashboard', Request::is('inventory/dashboard'),
      ["super_admin","exim"])
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Master Data','master',['super_admin','exim'],'fas fa-database')
      ->start_item_accordion('master', (
      Request::is('inventory/bahan') ||
      Request::is('inventory/barang') ||
      Request::is('inventory/jenis-waste') ||
      Request::is('inventory/waste') ||
      Request::is('inventory/supplier') ||
      Request::is('inventory/customer') ||
      Request::is('inventory/gudang') ||
      Request::is('inventory/bagian')
      ))
      ->item('Bahan Baku', 'fas fa-cube', 'inventory/bahan', Request::is('inventory/bahan'),['super_admin','exim'])
      ->item('Barang Jadi', 'fas fa-box-open', 'inventory/barang', Request::is('inventory/barang'),['super_admin','exim'])
      ->item('Jenis Waste', 'fas fa-biohazard', 'inventory/jenis-waste', Request::is('inventory/jenis-waste'),['super_admin','exim'])
      ->item('Waste', 'fas fa-dumpster', 'inventory/waste', Request::is('inventory/waste'),['super_admin','exim'])
      ->item('Supplier', 'fas fa-parachute-box', 'inventory/supplier', Request::is('inventory/supplier'),['super_admin','exim'])
      ->item('Customer', 'fas fa-address-card', 'inventory/customer', Request::is('inventory/customer'),['super_admin','exim'])
      ->item('Gudang', 'fas fa-warehouse', 'inventory/gudang', Request::is('inventory/gudang'),['super_admin','exim'])
      ->item('Bagian', 'fas fa-people-carry', 'inventory/bagian', Request::is('inventory/bagian'),['super_admin','exim'])
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();


      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Inventory','inventory',['super_admin','exim'],'fas fa-truck-loading')
      ->start_item_accordion('inventory', (
        Request::is('inventory/bahan-masuk')
        ))
      ->customIconItem('Pemasukan Bahan Baku', asset('assets/img/brand/import_bahan.svg'), 'inventory/bahan-masuk',Request::is('inventory/bahan-masuk'),['super_admin','exim'])
      ->customIconItem('Pengeluaran Bahan Baku', asset('assets/img/brand/export_bahan.svg'), 'inventory/bahan-keluar',Request::is('inventory/bahan-keluar'),['super_admin','exim'])
      ->customIconItem('Pemasukan Barang Jadi', asset('assets/img/brand/import_barang.svg'), 'inventory/barang-masuk',Request::is('inventory/barang-masuk'),['super_admin','exim'])
      ->customIconItem('Pengeluaran Barang Jadi', asset('assets/img/brand/export_barang.svg'), 'inventory/barang-keluar',Request::is('inventory/barang-keluar'),['super_admin','exim'])
      ->customIconItem('Pemasukan Waste / Scrap', asset('assets/img/brand/import_waste.svg'), 'inventory/waste-masuk',Request::is('inventory/waste-masuk'),['super_admin','exim'])
      ->customIconItem('Pengeluaran Waste / Scrap', asset('assets/img/brand/export_waste.svg'), 'inventory/waste-keluar',Request::is('inventory/waste-keluar'),['super_admin','exim'])
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Manajemen Data','data-management',['super_admin','exim'],'fas fa-server')
      ->start_item_accordion('data-management', (Request::is('inventory/backup-data')))
      ->item('Backup Data', 'fas fa-digital-tachograph', 'inventory/backup-data', Request::is('inventory/backup-data'),['super_admin','exim'])
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Manajemen User','user-management',['super_admin'], 'ni ni-badge')
      ->start_item_accordion('user-management', (
      Request::is('inventory/user') ||
      Request::is('inventory/role')
      ))
      ->item('Manage Role', 'fas fa-user-astronaut', 'inventory/role', Request::is('inventory/role'),['super_admin'])
      ->item('Manage User', 'ni ni-circle-08', 'inventory/user', Request::is('inventory/user'),['super_admin'])
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Settings','settings',['super_admin', 'exim'], 'fas fa-cogs')
      ->start_item_accordion('settings', (
      Request::is('inventory/profile')
      ))
      ->item('Profile', 'fas fa-id-badge', 'inventory/profile', Request::is('inventory/profile'),['super_admin','exim'])
      // ->item('Change Password', 'fas fa-key', 'inventory/user', Request::is('inventory/user'),['super_admin'])
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $menu = $obj_menu->to_html();
      @endphp
      {!! $menu !!}
    </div>
  </div>
</nav>