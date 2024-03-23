<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->

  <!-- /Search -->
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <span class="fw-medium d-block">{{Auth::user()->name}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-grow-1 text-center">
                  <small class="text-dark">{{Auth::user()->degre()}}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="nav-link dropdown-toggle hide-arrow text-center" href="javascript:void(0);" data-bs-toggle="dropdown" class="nav-link pr-2" href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="adminpro-icon adminpro-locked author-log-ic"></span>
                Chiqish
                <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
          </li>

        </ul>
      </li>
    <!-- Place this tag where you want the button to render. -->
  </ul>
</div>
</nav>
