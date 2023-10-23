<!DOCTYPE html>
<html lang="eng" class="dark">
    <head>
       @include('dashboard.header')
    </head>
    <body class="antialiased bg-slate-50">
    <div class="relative">


{{-- Navbar --}}
    @include('dashboard.navbar')
{{-- End Navbar --}}

    @vite('resources/js/app.js')
    <script src="../path/to/flowbite/dist/datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
    </div>
    </body>
</html>
