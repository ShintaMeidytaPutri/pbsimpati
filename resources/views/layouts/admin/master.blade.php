<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="{{ asset('assets/images/pbsimpati.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->

    <script src="{{asset('assets/js/daypilot/daypilot-all.min.js')}}"></script>
</head>

<body>
    <div class="relative flex xl:w-[1280px] h-full mx-auto border border-red-500">
        <sidebar class=" w-[236px] h-max-full bg-[#2E3190] md:inline hidden  " id="sidebar" >
            <div class="max-w-44 max-h-24 mx-auto">
                <a href="/" class="block w-full h-full">
                    <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="Logo" class="object-contain w-full h-full" style="filter: brightness(10000%) saturate(0) contrast(100%) drop-shadow(4px 4px 2px rgba(0, 0, 0, 0.2));">
                </a>
            </div>
            <div class="max-w-44 h-[40vh] mx-auto py-24 flex flex-col gap-4">

                <a href="" class="w-full h-[50px] items-center flex gap-[11px] justify-center border border-white rounded-[8px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[24px] h-[24px] text-white">
                        <path d="M21 20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V9.48907C3 9.18048 3.14247 8.88917 3.38606 8.69972L11.3861 2.47749C11.7472 2.19663 12.2528 2.19663 12.6139 2.47749L20.6139 8.69972C20.8575 8.88917 21 9.18048 21 9.48907V20ZM19 19V9.97815L12 4.53371L5 9.97815V19H19Z"></path>
                    </svg>
                    <span class="text-white">Home</span>
                </a>
                <!--                 <a href="" class="w-full h-[50px] items-center flex gap-[11px] justify-center border border-white rounded-[8px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[24px] h-[24px] text-white">
                        <path d="M7 3V1H9V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V9H20V5H17V7H15V5H9V7H7V5H4V19H10V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7ZM17 12C14.7909 12 13 13.7909 13 16C13 18.2091 14.7909 20 17 20C19.2091 20 21 18.2091 21 16C21 13.7909 19.2091 12 17 12ZM11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16ZM16 13V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V13H16Z"></path>
                    </svg>
                    <span class="text-white">Jadwal Lapangan</span>
                </a> -->
            </div>
            <div class="max-w-44 max-h-24 mx-auto">
                <a href="/logout" class="w-full h-full flex gap-[11px] justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[24px] h-[24px] text-white">
                        <path d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z"></path>
                    </svg>
                    <span class="text-white">Logout</span>
                </a>
            </div>
        </sidebar>

        <div class="flex-1 h-full bg-[#D9D9D9]">
            <navbar class="h-[88px] bg-white flex items-center justify-end py-[14px] px-[38px]">
                <div class="flex gap-[5px] items-center cursor-pointer" id="menu">
                    <div class="text-[#2E3190] text-[15px] font-normal leading-[18px]">
                        <span>Azka (admin)</span>
                    </div>
                    <div class="w-[60px] h-[60px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class=" text-[#2E3190]">
                            <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM12.1597 16C10.1243 16 8.29182 16.8687 7.01276 18.2556C8.38039 19.3474 10.114 20 12 20C13.9695 20 15.7727 19.2883 17.1666 18.1081C15.8956 16.8074 14.1219 16 12.1597 16ZM12 4C7.58172 4 4 7.58172 4 12C4 13.8106 4.6015 15.4807 5.61557 16.8214C7.25639 15.0841 9.58144 14 12.1597 14C14.6441 14 16.8933 15.0066 18.5218 16.6342C19.4526 15.3267 20 13.7273 20 12C20 7.58172 16.4183 4 12 4ZM12 5C14.2091 5 16 6.79086 16 9C16 11.2091 14.2091 13 12 13C9.79086 13 8 11.2091 8 9C8 6.79086 9.79086 5 12 5ZM12 7C10.8954 7 10 7.89543 10 9C10 10.1046 10.8954 11 12 11C13.1046 11 14 10.1046 14 9C14 7.89543 13.1046 7 12 7Z"></path>
                        </svg>
                    </div>
                </div>
            </navbar>
            <main class="px-[22px] py-[22px]">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        const menu = document.getElementById('menu');
        const sidebar = document.getElementById('sidebar');
        menu.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        })
    </script>
    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}")
    </script>
    @endif
    @if (session('error'))
    <script>
        toastr.error("{{ session('error') }}")
    </script>
    @endif
    @if (session('message'))
    <script>
        toastr.info("{{ session('message') }}")
    </script>
    @endif
    @stack('bottom-script')
</body>

</html>