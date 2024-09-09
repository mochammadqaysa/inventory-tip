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
          ->item('Dashboard', 'ni ni-tv-2', 'inventory/dashboard', Request::is('inventory/dashboard'), ["super_admin","exim"])
          ->end_group();

          $obj_menu->start_group()
          ->start_accordion()
          ->sub_item_accordion('Master Data','master',['super_admin','exim'],'fas fa-database')
          ->start_item_accordion('master', (
            Request::is('inventory/bahan') ||
            Request::is('inventory/barang')
          ))
          ->item('Bahan Baku', 'ni ni-briefcase-24', 'inventory/bahan', Request::is('inventory/bahan'),['super_admin','exim'])
          ->item('Barang Jadi', 'ni ni-briefcase-24', 'inventory/barang', Request::is('inventory/barang'),['super_admin','exim'])
          ->end_item_accordion()
          ->end_accordion()
          ->end_group();

          $obj_menu->start_group()
          ->start_accordion()
          ->sub_item_accordion('Data Management','data-management',['super_admin','exim'],'fas fa-server')
          ->start_item_accordion('data-management', (
            Request::is('inventory/backup_data')
          ))
          ->item('Backup Data', 'fas fa-digital-tachograph', 'inventory/backup_data', Request::is('inventory/backup_data'),['super_admin','exim'])
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
  
            $menu = $obj_menu->to_html();
        @endphp
        {!! $menu !!}
      </div>
    </div>
</nav>
  