<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>

    @include('layouts.admin.partials.head-tag')

</head>
<body>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
        @include('layouts.admin.partials.sidenav')
    </div>
    <!-- /#sidebar-wrapper -->


    <!-- Page Content -->
    <div id="page-content-wrapper">

        {{--StartHeader--}}
        @include('layouts.admin.partials.modal')
        @include('layouts.admin.partials.topnav')
        {{--end header--}}


        {{--Start MainBody--}}
        <div class="container-fluid px-4 ">

            @yield('content')

        </div>


        {{--end mainbody--}}
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- Livewire js -->

@include('layouts.admin.partials.script')

@yield('custom-script')
<!-- Vite -->
@vite(['resources/js/app.js'])
@stack('scripts')
@livewireScripts
</body>
</html>
