@include('admin.layouts.header')
@yield('css')
</head>
<body>

<div class="page">
    @include('admin.layouts.sidebar')
    @include('admin.layouts.menu')
    <div class="page-wrapper">
        @yield('main')
    </div>
</div>


@include('admin.layouts.footer')