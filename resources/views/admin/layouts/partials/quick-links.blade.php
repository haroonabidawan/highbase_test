<li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
    <a
        class="nav-link dropdown-toggle hide-arrow"
        href="javascript:void(0);"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside"
        aria-expanded="false">
        <i class="ti ti-layout-grid-add ti-md"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0">
        <div class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                {{--                <a--}}
                {{--                    href="javascript:void(0)"--}}
                {{--                    class="dropdown-shortcuts-add text-body"--}}
                {{--                    data-bs-toggle="tooltip"--}}
                {{--                    data-bs-placement="top"--}}
                {{--                    title="Add shortcuts"--}}
                {{--                ><i class="ti ti-sm ti-apps"></i--}}
                {{--                    ></a>--}}
            </div>
        </div>
        <div class="dropdown-shortcuts-list scrollable-container">
            <div class="row row-bordered overflow-visible g-0">
                <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-chart-bar fs-4"></i>
                          </span>
                    <a href="{{ route('admin.dashboard')  }}" class="stretched-link">Dashboard</a>
                    <small class="text-muted mb-0">User Profile</small>
                </div>
                <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-settings fs-4"></i>
                          </span>
                    <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                    <small class="text-muted mb-0">Account Settings</small>
                </div>
            </div>
        </div>
    </div>
</li>
