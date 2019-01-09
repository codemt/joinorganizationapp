<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('_partials.links')
    @stack('page-style')
<title>{{env('APP_NAME')}}</title>
</head>
<body class="layout layout-header-fixed">
    <div class="layout-header">
        @include('_partials.top_nav')
    </div>
    <div class="layout-main">
        <div class="layout-sidebar">
            <div class="layout-sidebar-backdrop"></div>
            <div class="layout-sidebar-body">
                @include('_partials.side_nav')
            </div>
        </div>
        <div class="layout-content">
            <div class="layout-content-body">
                @yield('page-content')
            </div>
        </div>
        @include('_partials.modal')
        @include('_partials.footer')
    </div>
    @stack('modals')
    @include('_partials.scripts')
    @stack('page-script')
</body>
</html>
