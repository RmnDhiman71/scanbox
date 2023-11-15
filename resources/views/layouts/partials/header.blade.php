<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="widget-content-wrapper navbar-poition">
                <div class="widget-content-left">
                    <div class="btn-group">
                        <a aria-haspopup="true" aria-expanded="false" class="p-0 btn" data-bs-toggle="dropdown">
                            <img width="42" class="rounded-circle" src="{{ asset('images/profile.png') }}" alt="">
                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                        </a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(58px, 44px, 0px);">
                            <a href="{{ route('profile') }}" class="dropdown-item">User Account</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="widget-content-left  ml-3 header-user-info">
                    <div class="widget-heading">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="widget-subheading">
                    </div>
                </div>
                <!-- <div class="widget-content-right header-user-info ml-3">
                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                    </button>
                </div> -->
            </div>
        </div>
    </div>
</nav>