<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="{{ asset('assets/images/pbsimpati.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lapangan PB Simpati</title>

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

<body class="antialiased font-teachers">
    <div class="relative container w-11/12 lg:w-[1280px] mx-auto">
        <navbar class="sticky top-0  flex items-center md:justify-normal justify-between py-[1.58rem] md:h-[130px] w-full xl:mb-[26px] px-[24px] md:pl-[48px] md:pr-[48px] text-[#2E3190] bg-white z-10 border">
            <div class="max-w-36 max-h-18 md:max-w-44 md:max-h-24 overflow-hidden">
                <a href="/" class="block w-full h-full">
                    <img src="{{ asset('assets/images/logo-transparent.png') }}" alt="Logo" class="object-contain w-full h-full">
                </a>
            </div>
            <div class="hidden md:flex w-full justify-center items-center gap-8">
                <div class="w-7/12 flex justify-end gap-[53px]">
                    <a class="text-lg" href="{{ route('home') }}">Home</a>
                    <a class="text-lg" href="{{ route('home') }}#jadwal">Jadwal Lapangan</a>
                    <a class="text-lg" href="{{ route('home') }}#about">Tentang Kami</a>
                </div>
                <div class="w-5/12 flex gap-[32px] justify-end mx">
                    <span class="text-xl font-semibold bg-[#FFC300AD] px-7 py-2 flex items-center justify-center rounded-xl">
                        <a href="/booking">Booking</a>
                    </span>
                    <span class="text-xl font-semibold bg-[#2E3190] px-7 py-2 flex items-center justify-center rounded-xl text-[#FFC300]">
                        <a href="/login">Login</a>
                    </span>
                </div>
            </div>
            <div class="flex items-center md:hidden">
                <button class="h-8 w-8 flex items-center justify-center md:hidden" id="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <div class="hidden md:hidden w-full h-full bg-white fixed top-0 left-0 z-20" id="mobile-menu">
                <div class="flex flex-col items-center justify-center gap-8 h-full">
                    <a class="text-lg" href="{{ route('home') }}">Home</a>
                    <a class="text-lg" href="{{ route('home') }}#jadwal">Jadwal Lapangan</a>
                    <a class="text-lg" href="{{ route('home') }}#about">Tentang Kami</a>
                    <span class="text-xl font-semibold bg-[#FFC300AD] px-7 py-2 flex items-center justify-center rounded-xl">
                        <a href="/booking">Booking</a>
                    </span>
                    <span class="text-xl font-semibold bg-[#2E3190] px-7 py-2 flex items-center justify-center rounded-xl text-[#FFC300]">
                        <a href="/login">Login</a>
                    </span>
                </div>
            </div>
        </navbar>
        @yield('content')
        <footer class=" w-full mt-14 xl:mt-24 bg-[#2E3190] flex items-center flex-col md:flex-row px-[39px] md:gap-0 gap-10 md:py-4 py-8">
            <div class="w-full lg:w-6/12 leading-[24px] font-[500px] text-[16px]  text-white flex justify-between md:justify-normal h-full md:flex-col gap-5 md:order-1 order-2">
                <div class="w-7/12">
                    <p class="">Lokasi</p>
                    <p class="">No. 5 A Rt. 005/02, Jl. Raya Condet, RT.5/RW.2, Balekambang, Kec. Kramat jati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13530</p>
                </div>
                <div>
                    <p class="">Narahubung</p>
                    <p class="">089652273675</p>
                </div>
            </div>
            <div class="w-full lg:w-6/12  justify-center lg:justify-end flex h-[224px] lg:order-2 order-1">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.86694923825326!2d106.85484826214267!3d-6.280660094190199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f26648be30d1%3A0x3115e9005ace6dae!2sTK%20(Taman%20Kanak%20Kanak)%20Islam%20%26%20TPA%20Nurul%20Hasanah!5e0!3m2!1sid!2sid!4v1731080316271!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>


        </footer>



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>
            const hamburger = document.getElementById('menu');
            const mobileMenu = document.getElementById('mobile-menu');
            //if hamburger clicked then show mobile menu
            hamburger.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            //if anywhere clicked then hide mobile menu
            mobileMenu.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
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