<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        @if (auth()->user()->is_admin === 1)
        <li class="menu-item @if (Request::is('/')) active @endif">
          <a href="{{ url('/') }}" class="menu-link">
              <i class="menu-icon tf-icons mdi mdi-package-variant"></i>
              <div data-i18n="Produk">Produk</div>
          </a>
      </li>
      @endif
      
      <li class="menu-item @if (Request::is('list-product')) active @endif">
          <a href="{{ route('list-product') }}" class="menu-link">
              <i class="menu-icon tf-icons mdi mdi-format-list-bulleted"></i>
              <div data-i18n="List Produk">List Produk</div>
          </a>
      </li>
      

      <li class="menu-item">
        <a href="" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="mdi mdi-logout me-2"></i>
            <div data-i18n="Transaksi">Log Out</div>
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
      
      </ul>
    </div>
  </aside>