<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview @yield('dashboardM')">
      <a href="{{asset('/')}}" class="nav-link @yield('dashboard')">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard

        </p>
      </a>
    </li>



    {{-- MODULE ADMINISTRATION --}}
    <li class="nav-item has-treeview @yield('administration')">
      <a href="#" class="nav-link @yield('administration')">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          ADMINISTRATION
          <i class="fas fa-angle-left right"></i>

        </p>
      </a>
      <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
          <a href="pages/layout/top-nav.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Rôles</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('partners.list') }}" class="nav-link @yield('partner')">
            <i class="far fa-circle nav-icon"></i>
            <p>Partenaires</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('agencies.list') }}" class="nav-link @yield('agency')">
            <i class="far fa-circle nav-icon"></i>
            <p>PDV</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('agents.list') }}" class="nav-link @yield('agent')">
            <i class="far fa-circle nav-icon"></i>
            <p>Agents</p>
          </a>
        </li>
       <li class="nav-item">
          <a href="{{ route('products.list') }}" class="nav-link @yield('product')">
            <i class="far fa-circle nav-icon"></i>
            <p>Equipements</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('customers.list') }}" class="nav-link @yield('listcustomers')">
            <i class="nav-icon fas fa-copy"></i>
            <p>Clients</p>
          </a>
        </li>

      </ul>
    </li>
 {{-- FIN MODULE ADMINISTRATION --}}

  {{-- MODULE OPERATION --}}


    <li class="nav-item has-treeview @yield('operation')">
      <a href="#" class="nav-link @yield('operation')">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          OPERATIONS
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('subscription.customer') }}" class="nav-link @yield('subscription')">
            <i class="far fa-circle nav-icon"></i>
            <p>Souscriptions</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Sinistres</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/layout/boxed.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Statistiques</p>
          </a>
        </li> --}}
      </ul>
    </li>
 {{-- FIN MODULE OPERATION --}}

  </ul>
</nav>
<!-- /.sidebar-menu -->
