<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $scheduledClasses = ScheduledClass::upcoming()
            ->with('classType')->notBooked()->oldest('date_time')
            ->get();
        return view("member.book")->with("scheduledClasses", $scheduledClasses);
    }

    public function store(Request $request)
    {
        auth()->user()->bookings()->attach($request->scheduled_class_id);
        return to_route("booking.index");
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()->where("date_time", ">", now())->get();
        return view("member.upcoming", ["bookings" => $bookings]);
    }

    public function destroy(Request $request)
    {
        auth()->user()->bookings()->detach($request->scheduled_class_id);
        return to_route("booking.index");
    }
}
