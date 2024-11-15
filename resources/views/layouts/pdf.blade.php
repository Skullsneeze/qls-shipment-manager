<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            Pakbon
        @endif
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    @yield('header.scripts')
    @yield('header.styles')

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Source Sans 3',"ui-sans-serif","system-ui","sans-serif"],
                    },
                },
            },
        }
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</head>
{{-- Body set to a4 width x height @ 96DPI (794 x 1123)--}}
<body class="leading-normal tracking-normal text-gray-900 max-w-[210mm] max-h-[297mm]" style="font-family: 'Source Sans Pro', sans-serif;">
<main class="w-10/12 mx-auto mt-10 flex flex-col min-h-[297mm] relative">
    {{ $slot }}
</main>
</body>
</html>
