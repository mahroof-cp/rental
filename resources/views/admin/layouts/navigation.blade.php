<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a class="brand-logo app-brand-link mt-5" href="{{route('admin_dashboard')}}">
            <img class="hide-on-med-and-down small-logo img-fluid" src="{{asset("images/admin/car-icon.jpg")}}" alt="materialize logo" style="max-width: 100px; height: 100px;" />
            <img class="hide-on-med-and-down big-logo img-fluid" src="{{asset("images/admin/car-icon.jpg")}}" alt="materialize logo" style="max-width: 218px; height: 141px;" />
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    @include('admin.layouts.menu')
</aside>
