@extends('layouts.master')
@section('content')
<div class="mt-[29px] w-full lg:w-[803px] mx-auto h-[516px] bg-[#2E3190] py-[20px] px-[50px] lg:py-[33px] lg:px-[85px] rounded-[10px]">
    <div class="lg:w-[634px] lg:h-[449px] w-full h-full mx-auto border bg-white  rounded-[10px]">
        <div class="w-full md:w-[428px] mx-auto px-4 sm:px-14 md:px-0">
            <div class="pt-[13px]">
                <h1 class="text-[#2E3190] text-[24px] sm:text-[28px] md:text-[36px] font-semibold text-center leading-[43.2px]">Login Admin</h1>
            </div>
            <form action="{{route('login.action')}}" method="POST">
                @csrf
                <div class="mt-[52px] flex flex-col gap-[30px]">
                    <div>
                        <div class="relative">
                            <img src="{{ asset('assets/images/username.svg') }}" alt="Username Icon"
                                class="absolute top-[50%] left-[20px] transform -translate-y-1/2 w-[24px] h-[24px]">
                            @if(!session('username'))
                            <input type="text" name="username" id="username"
                                class="w-full h-[50px] border-[2px] pl-[50px] pr-[21px] rounded-[5px] border-[#D9D9D9] "
                                placeholder="Username" value="{{ old('username') }}">
                            @else
                            <input type="text" name="username" id="username"
                                class="w-full h-[50px] border-[2px] pl-[50px] pr-[21px] rounded-[5px] border-red-500"
                                placeholder="Username" value="{{ old('username') }}">

                            @endif
                        </div>
                        <span class=" text-red-500 text-sm">{{ session('username') }}</span>
                    </div>
                    <div>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="absolute top-[50%] left-[20px] transform -translate-y-1/2 w-[24px] h-[24px] text-[#2E3190]">
                                <path d="M19 10H20C20.5523 10 21 10.4477 21 11V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V11C3 10.4477 3.44772 10 4 10H5V9C5 5.13401 8.13401 2 12 2C15.866 2 19 5.13401 19 9V10ZM5 12V20H19V12H5ZM11 14H13V18H11V14ZM17 10V9C17 6.23858 14.7614 4 12 4C9.23858 4 7 6.23858 7 9V10H17Z"></path>
                            </svg>
                            @if(!session('password'))
                            <input type="password" name="password" id="password"
                                class="w-full h-[50px] border-[2px] pl-[50px] pr-[21px] rounded-[5px] border-[#D9D9D9]"
                                placeholder="Password">
                            @else
                            <input type="password" name="password" id="password"
                                class="w-full h-[50px] border-[2px] pl-[50px] pr-[21px] rounded-[5px] border-red-500"
                                placeholder="Password">
                            @endif
                        </div>
                        <span class=" text-red-500 text-sm">{{ session('password') }}</span>
                    </div>

                </div>
                <div class="mt-[51px]">
                    <button type="submit" class="w-full h-[50px] bg-[#2E3190] text-white text-[18px] md:text-[24px] leading-[28.8px] font-bold rounded-[10px]">Masuk</button>
                </div>
                <div class="mt-[11px] text-center">
                    <a href="{{ route('home') }}" class="text-[#5E5E5E] text-[12px] md:text-[15px] font-normal leading-[18px]">kembali ke Homepage</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection