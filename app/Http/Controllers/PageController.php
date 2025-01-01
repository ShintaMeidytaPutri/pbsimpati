<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;



class PageController extends Controller
{
    public function index()
    {

        $today = Carbon::today();
        $endDate = $today->copy()->addDays(7);
        // Fetch data from today to +7 days
        $formattedBookingList = Cache::remember('bookingList', 60 * 5, function () use ($today, $endDate) {
            try {
                $bookingList = DB::table('booking')
                    ->whereBetween('tanggal', [$today->toDateString(), $endDate->toDateString()])
                    ->get();

                // Map the data into the desired format


                $formattedBookingList = $bookingList->map(function ($booking) use ($today) {
                    return [
                        'start' => Carbon::parse($today->toDateString() . ' ' . $booking->jam_mulai)->format('Y-m-d\TH:i:s'),
                        'real_start' => Carbon::parse($booking->tanggal . ' ' . $booking->jam_mulai)->format('Y-m-d\TH:i:s'),
                        'end' => Carbon::parse($today->toDateString() . ' ' . $booking->jam_selesai)->format('Y-m-d\TH:i:s'),
                        'real_end' => Carbon::parse($booking->tanggal . ' ' . $booking->jam_selesai)->format('Y-m-d\TH:i:s'),
                        'id' => $booking->id,
                        'text' => $booking->name,
                        'resource' =>
                        Carbon::parse($booking->tanggal)->format('d-m-Y'),
                    ];
                });
            } catch (\Illuminate\Database\QueryException $ex) {
                return [];
            }
            return $formattedBookingList;
        });

        return view('welcome', ['bookingList' => $formattedBookingList, 'startDate' => $today->toDateString(), 'endDate' => $endDate->toDateString()]);
    }
    public function booking()
    {
        return view('booking');
    }
    public function booking_action(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'tanggal' => 'required|date',
                'jam' => 'required|numeric|min:6|max:23',
                'duration' => 'required|numeric|max:18'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            return redirect()->back()->with('error', 'Invalid input');
        }


        //jam is start time get the end_time from jam+duration
        $name = $request->name;
        $tanggal = $request->tanggal;
        $jam = $request->jam.":00";
        $duration = $request->duration;

        $end_time = Carbon::parse($jam)->addHours($duration)->format('H:i');
  
        $basePrice = 50000;
        $discountPrice = 40000;
        if ($duration > 3) {
            $harga = $basePrice + ($duration - 3) * $discountPrice;
        } else {
            $harga = $basePrice * $duration;
        }


        return redirect()->away("https://wa.me/6289652273675?text=Booking%20Name:%20$name%0ABooking%20Date:%20$tanggal%0ABooking%20Time:%20$jam%20-$end_time%0aHarga:%20$harga");
    }
}
