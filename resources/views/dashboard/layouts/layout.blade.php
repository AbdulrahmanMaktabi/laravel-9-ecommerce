<!doctype html>
<html lang="en">

@include('dashboard.layouts.header')

<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('dashboard.layouts.navbar')
        @include('dashboard.layouts.sidebar')
        <!--begin::App Main-->
        <main class="app-main">
            @yield('content')
        </main>
        <!--end::App Main-->
        @include('dashboard.layouts.footer')
    </div>
    <!--end::App Wrapper-->
    @include('dashboard.layouts.scripts')
</body>
<!--end::Body-->

</html>
