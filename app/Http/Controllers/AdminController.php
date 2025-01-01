<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    function index(Request $request)
    {
        try {
            $today = Carbon::today();
            if ($request->has('startDate')) {

                $request->validate([
                    'startDate' => 'date',
                ]);
                $startDate = Carbon::parse($request->startDate);
            } else {
                $startDate = Carbon::today();
            }
            if ($request->has('endDate')) {
                $request->validate([
                    'endDate' => 'date',
                ]);
                $endDate = Carbon::parse($request->endDate);
            } else {
                $endDate = $startDate->copy()->addDays(6);
            }
            // Fetch data from today to +7 days
            $bookingList = DB::table('booking')
                ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
                ->get();

            // Map the data into the desired format


            $formattedBookingList = $bookingList->map(function ($booking) use ($today) {
                return [
                    'start' => Carbon::parse($today->toDateString() . ' ' . $booking->jam_mulai)->format('Y-m-d\TH:i:s'),
                    'end' => Carbon::parse($today->toDateString() . ' ' . $booking->jam_selesai)->format('Y-m-d\TH:i:s'),
                    'id' => $booking->id,
                    'text' => $booking->name,
                    'resource' => Carbon::parse($booking->tanggal)->format('d-m-Y'),
                ];
            });
            return view('admin.index', ['bookingList' => $formattedBookingList, 'startDate' => $startDate->format('d-m-Y'), 'endDate' => $endDate->format('d-m-Y')]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function tambah_booking()
    {
        return view('admin.tambah_booking');
    }

    public function add_booking(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'tanggal' => 'required|date',
                'jam_mulai' => 'required|date_format:H:i:s',
                'jam_selesai' => 'required|date_format:H:i:s',
            ]);

            if ($request->jam_selesai == '00:00:00') {
                $request->jam_selesai = '24:00:00';
            }
            //change tanggal to Y-m-d format
            $request->tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
            $id = DB::table('booking')->insertGetId([
                'name' => $request->name,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);
        
            return response()->json([
                'status' => 200,
                'message' => 'Booking added successfully',
                'data' => [
                    'id' => $id,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function update_booking($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'sometimes|required',
                'tanggal' => 'sometimes|required|date',
                'jam_mulai' => 'sometimes|required|date_format:H:i:s',
                'jam_selesai' => 'sometimes|required|date_format:H:i:s',
            ]);
            $updateValue = [];
            if ($request->has('name')) {
                $updateValue['name'] = $request->name;
            }
            if ($request->has('tanggal')) {
                $updateValue['tanggal'] = Carbon::parse($request->tanggal)->format('Y-m-d');
            }
            if ($request->has('jam_mulai')) {
                $updateValue['jam_mulai'] = $request->jam_mulai;
            }
            if ($request->has('jam_selesai')) {
                $updateValue['jam_selesai'] = $request->jam_selesai;
            }
            if (empty($updateValue)) {
                throw new \Exception('No data to update', 400);
            }

            $table = DB::table('booking')->where('id', $id)->update($updateValue);
            if (!$table) {
                throw new \Exception('Failed to update booking', 500);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Booking updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function delete_booking($id)
    {
        try {
            $table = DB::table('booking')->where('id', $id)->delete();
            if (!$table) {
                throw new \Exception('Failed to delete booking', 500);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Booking deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
