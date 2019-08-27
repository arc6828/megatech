<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">@yield('title')</h3>

    </div>
    <div class="col-md-6 col-4 align-self-center">
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        @yield('breadcrumb-menu')
        <a href="https://wrappixel.com/templates/monsteradmin/" class="hide btn pull-right hidden-sm-down btn-success"> Upgrade to Pro</a>
    </div>
</div>
