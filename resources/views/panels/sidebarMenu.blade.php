
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar text-sm flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    
       {{--  @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))  --}}

         <li class="nav-item has-treeview @yield('dashboardM')">
            <a href="{{asset('/')}}" class="nav-link @yield('dashboard')">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="up">
                Dashboard

                </p>
            </a>
        </li>
        {{--  @endif  --}}

    @if (Auth::user()->hasAnyRole(['administrator','super_administrator','manager','agent_chief']))


     {{-- MODULE ADMINISTRATION --}}
        <li class="nav-item has-treeview @yield('administration')">
            <a href="#" class="nav-link @yield('administration')">
                <i class="nav-icon fas fa-copy"></i>
                <p class="up">
                ADMINISTRATION
                <i class="fas fa-angle-left right"></i>

                </p>
            </a>
            <ul class="nav nav-treeview">
                {{-- <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="up">Rôles</p>
                </a>
                </li> --}}
                  @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))

                <li class="nav-item">
                    <a href="{{ route('businessman.list') }}" class="nav-link @yield('intermediary')">
                      <i class="far fa-circle nav-icon"></i>
                      <p class="up">COMMERCIAL</p>
                    </a>
                </li>
                @endif
                @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))
                    <li class="nav-item">
                    <a href="{{ route('partners.list') }}" class="nav-link @yield('partner')">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="up">Partenaire</p>
                    </a>
                    </li>
                @endif
                @if (Auth::user()->hasAnyRole(['manager']))

                    <li class="nav-item">
                    <a href="{{ route('agencies.list') }}" class="nav-link @yield('agency')">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="up">PDV</p>
                    </a>
                    </li>
                @endif
              
                @if (Auth::user()->hasAnyRole(['agent_chief']))
                    <li class="nav-item">
                    <a href="{{ route('agents.list') }}" class="nav-link @yield('agent')">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="up">Agent</p>
                    </a>
                    </li>
                @endif
                @if (Auth::user()->hasAnyRole(['manager']))
                    <li class="nav-item">
                    <a href="{{ route('products.list') }}" class="nav-link @yield('product')">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="up">Equipement</p>
                    </a>
                    </li>
                @endif
                @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))
                    <li class="nav-item">
                        <a href="{{ route('category.list') }}" class="nav-link @yield('category')">
                            <i class="far fa-circle nav-icon"></i>
                            <p class="up">Categorie</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))
                    <li class="nav-item">
                        <a href="{{ route('customers.list') }}" class="nav-link @yield('listcustomers')">
                            <i class="far fa-circle nav-icon"></i>
                            <p class="up">Client</p>
                        </a>
                    </li>
                @endif

            </ul>
        </li>
     {{-- FIN MODULE ADMINISTRATION --}}


    @endif
    {{-- MODULE OPERATION --}}
    @if (Auth::user()->hasAnyRole(['agent','agent_chief','manager',]))
        <li class="nav-item has-treeview @yield('operation')">
            <a href="#" class="nav-link @yield('operation')">
                <i class="nav-icon fas fa-copy"></i>
                <p class="up">
                OPERATIONS
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Auth::user()->hasAnyRole(['agent','agent_chief']))
                    <li class="nav-item">
                    <a href="{{ route('subscription.customer') }}" class="nav-link @yield('subscription')">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="up">Souscription</p>
                    </a>
                    </li>
                @endif
               


            </ul>
        </li>
    @endif
    @if (Auth::user()->hasAnyRole(['agent','agent_chief','claims_manager',"administrator","super_administrator"]))

      <li class="nav-item has-treeview @yield('sinister_menu')">
      <a href="#" class="nav-link @yield('sinister_menu')">
        <i class="nav-icon fas fa-copy"></i>
        <p class="up">
          SINISTRES
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @if (Auth::user()->hasAnyRole(['agent','agent_chief']))

        <li class="nav-item">
            <a href="{{ route('sinister.search') }}" class="nav-link @yield('sinister_decla')">
              <i class="far fa-circle nav-icon"></i>
              <p class="up">DECLARATION</p>
            </a>
        </li>
        @endif
        @if (Auth::user()->hasAnyRole(['administrator','super_administrator']))

        <li class="nav-item">
            <a href="{{ route('sinister.claimsManager.list') }}" class="nav-link @yield('sinisters_claimsManager')">
              <i class="far fa-circle nav-icon"></i>
              <p class="up">GESTIONNAIRE</p>
            </a>
        </li>
        @endif
        @if (Auth::user()->hasAnyRole(['claims_manager']))

        <li class="nav-item">
            <a href="{{ route('sinister.manage.demandlist') }}" class="nav-link @yield('sinister_manage')">
              <i class="far fa-circle nav-icon"></i>
              <p class="up">GESTION</p>
            </a>
        </li>
        @endif
        @if (Auth::user()->hasAnyRole(['claims_manager','agent_chief','agent']))

        <li class="nav-item">
            <a href="{{ route('sinister.list') }}" class="nav-link @yield('listeSinistre')">
              <i class="far fa-circle nav-icon"></i>
              <p class="up">LISTE</p>
            </a>
        </li>

        @endif
    </ul>

    @endif

    @if (Auth::user()->hasAnyRole(["administrator","super_administrator"]))

      <li class="nav-item has-treeview @yield('commission_menu')">
      <a href="#" class="nav-link @yield('commission_menu')">
        <i class="nav-icon fas fa-copy"></i>
        <p class="up">
          COMMISSION
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
       
        </ul>

    @endif
    @if (Auth::user()->hasAnyRole(['administrator','super_administrator','manager','agent_chief']))
    <li class="nav-item has-treeview @yield('commission_menu')">
        <a href="#" class="nav-link @yield('commission_menu')">
          <i class="nav-icon fas fa-copy"></i>
          <p class="up">
            Statistiques
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('statistics.etatpartenaire') }}" class="nav-link @yield('statistiques')">
                <i class="far fa-circle nav-icon"></i>
                <p class="up">Global</p>
                </a>
            </li>
          </ul>
          
    </li>
@endif
  </ul>
</nav>
<!-- /.sidebar-menu -->
