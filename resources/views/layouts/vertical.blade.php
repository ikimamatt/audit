<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.partials/head-css')
</head>

<body data-menu-color="light" data-sidebar="default" @yield('body') >

<div id="app-layout">

    @include('layouts.partials/topbar')
    @include('layouts.partials/sidebar')

    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>
                @endif
                @yield('content')
            </div>
        </div>

        @include("layouts.partials/footer")

    </div>

</div>

@vite(['resources/js/app.js'])
@include("layouts.partials/vendor")
@yield('script')

</body>
</html>
