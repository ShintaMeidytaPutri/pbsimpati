@extends('layouts.master')
@section('content')
<div class="lg:h-[104px] lg:w-[803px] mx-auto">
    <div class="text-center">
        <h1 class="lg:text-[48px] text-[36px] font-[500]">Ayo Bermain Bulu Tangkis,<br />Booking Lapangan Mudah dan Cepat!</h1>
    </div>
</div>
<div class="relative w-full  xl:w-[1280px] h-[218px] lg:h-[426px] mx-auto mt-[26px] lg:mt-[53px] border">
    <div class="absolute inset-0 shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] bg-[linear-gradient(180deg,_rgba(46,49,144,0)_0%,_rgba(46,49,144,0.66)_100%)]"></div>
    <img src="{{ asset('assets/images/banner.png') }}" alt="Banner" class="object-cover w-full h-full">
</div>
<div class="mt-[26px] xl:mt-[53px]" id="jadwal">
    <span class="text-[#000000] xl:ml-[45px] xl:mr-[70px] text-[24px] xl:text-[36px] font-[500]">Jadwal Lapangan</span>
</div>
<div class="mt-[26px] xl:mt-[31px] bg-[#2E3190] h-[88px] flex items-center mb-[26px] xl:mb-[52px]">
</div>
<div class="max-h-[856px] max-w-full  xl:ml-[45px] xl:mr-[70px] overflow-auto ">    
    <div id="dp" class="overflow-auto w-full h-full"></div>
</div>
<div class="mt-[54px] xl:mt-[154px] xl:max-h-[594px] xl:ml-[45px] xl:mr-[70px]  " id="about">
    <div class="text-center mb-[23px] xl:mb-[57px]">
        <h1 class="text-[36px] md:text-[48px] xl:text-[64px] font-[700]">Tentang Kami</h1>
    </div>
    <div class="flex md:flex-row flex-col items-center gap-8 xl:gap-0 ">
        <div class="w-full lg:w-6/12  ">
            <img src="{{ asset('assets/images/orang-main.jpg') }}" alt="About" class="object-cover w-[600px] h-[483px] m-auto md:w-[400px] md:h-[400px] xl:w-[504px] xl:h-[483px] rounded-[3%]">
        </div>
        <div class="w-full  lg:w-7/12 flex items-center ">
            <p class="text-[16px] xl:text-[20px] font-[500] text-justify  leading-[32px] xl:leading-[40px]">Lapangan Simpati telah berdiri sejak tahun 2015, namun awalnya tidak dibuka untuk penyewaan umum. Seiring berjalannya waktu, tepatnya pada tahun 2020 saat pandemi Covid-19, kami mulai membuka lapangan ini untuk masyarakat umum, dengan penyewaan yang terbatas pada pagi dan malam hari. Sejak saat itu, usaha kami terus berkembang hingga sekarang. Untuk memberikan kemudahan bagi para pelanggan, kami menghadirkan website resmi Lapangan Simpati, yang memungkinkan pengguna untuk melihat jadwal ketersediaan lapangan serta melakukan pemesanan secara online dengan lebih cepat dan mudah.
            </p>

        </div>

    </div>
</div>
@endsection

@push('bottom-script')
<script>
    const dp = new DayPilot.Calendar("dp", {
        viewType: "Resources",
        cellDuration: 60,
        timeRangeSelectedHandling: "Disabled",
        eventMoveHandling: "Disabled",
        eventResizeHandling: "Disabled",
        eventClickHandling: "Disabled",
        eventHoverHandling: "Disabled",
    });
    dp.heightSpec = "BusinessHoursNoScroll";
    dp.businessBeginsHour = 6;
    dp.businessEndsHour = 24;
    dp.width = 856;

    const dayList = [];
    const today = new Date();

    for (let i = 0; i < 7; i++) {
        const currentDate = new Date(today);
        currentDate.setDate(today.getDate() + i);

        const day = currentDate.getDate().toString().padStart(2, '0');
        const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        const year = currentDate.getFullYear();

        const formattedDate = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long', // Full day name (e.g., "Sabtu")
            day: 'numeric', // Day of the month
            month: 'short', // Month name (e.g., "November")
            year: 'numeric', // Full year
        }).format(currentDate);

        dayList.push({

            name: formattedDate, // Example: "Sabtu, 23 November 2024"
            id: `${day}-${month}-${year}` // Example: "23-11-2024"
        });
    }
    dp.columns.list = dayList;
    dp.events.list = @json($bookingList);
    dp.init();
</script>
@endpush