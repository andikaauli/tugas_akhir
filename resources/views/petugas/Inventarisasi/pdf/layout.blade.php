<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}

        <style>
            body {
                font-family: 'quicksand';
            }

            .flex {
                display: flex;
            }

            .text-center{
                text-align: center;
            }

            .w-60{
                width: 300px;
            }

            .w-40{
                width: 200px;
            }

            .items-center {
                align-items: center;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .pt-4 {
                padding-top: 1rem;
            }

            .my-5 {
                margin-top: 1.25rem;
            }

            .text-3xl {
                font-size: 1.75rem;
                line-height: 2.25rem;
            }

             .text-2xl {
                font-size: 1.5rem; /* 24px */
                line-height: 2rem; /* 32px */
            }
            .text-xl {
                font-size: 1.25rem; /* 20px */
                line-height: 1.75rem; /* 28px */
            }

            .font-bold {
                font-weight: 700;
            }

            .h-full {
                height: 100%;
            }

            .border-y {
                border-top-width: 1px;
                border-bottom-width: 1px;
            }

            .border-solid {
                border-style: solid;
            }

            .table-auto {
                table-layout: auto;
            }

            th{
                height: 40px;
            }

            td{
                padding-left: 12px;
                padding-right: 12px;'
                padding-top: 6px;
                padding-bottom: 6px;
            }

            table {
                border-collapse: collapse;
                margin-left: auto;
                margin-right: auto;
            }
            table, td, th {
                border: 1px solid black;
            }
            table, td, td {
                border: 1px solid black;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
<body>
    @include('petugas.Inventarisasi.pdf.header')

    @yield('content')

</body>
</html>
