<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Image Upload Dashboard · Material 3 Style</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    <div class="layout" style="display: flex; height: 100vh; overflow: hidden;">
        @include('layouts.sidebar')

            <main class="content"
            style="margin: 10px 10px 10px 10px; padding: 10px; width: calc(100% - 300px); min-height: 100vh; overflow-y: auto; transition: all 0.3s ease-in-out;">
            @yield('content')
        </main>

    </div>
    <script src="{{ asset('scripts/dashboard.js') }}"></script>
    <script src="{{ asset('scripts/sidebar-icons.js') }}"></script>
</body>

</html>