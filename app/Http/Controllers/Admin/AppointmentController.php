<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::query()
            ->with('client:id,first_name,last_name')
            ->when(request('status'), function ($query) {
                return $query->where('status', AppointmentStatus::from(request('status')));
            })
            ->latest()
            ->paginate()
            ->through(fn ($appoinment) => [
                'id' => $appoinment->id,
                'start_time' => $appoinment->start_time->format('Y-m-d h:i A'),
                'end_time' => $appoinment->end_time->format('Y-m-d h:i A'),
                'status' => [
                    'name' => $appoinment->status->name,
                    'color' => $appoinment->status->color(),
                ],
                'client' => $appoinment->client,
            ]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Appointment::create([
            'title' => request('title'),
            'client_id' => 1,
            'start_time' => now(),
            'end_time' => now(),
            'description' => request('description'),
            'status' => AppointmentStatus::SCHEDULED,
        ]);

        return response()->json(['message' => 'success']);
    }
}
