<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;

class DashboardStatController extends Controller
{
    public function appointments()
    {
        $totalAppointmentsCount = Appointment::query()
            ->when(request('status') === 'scheduled', function ($query) {
                $query->where('status', AppointmentStatus::SCHEDULED);
            })
            ->when(request('status') === 'confirmed', function ($query) {
                $query->where('status', AppointmentStatus::CONFIRMED);
            })
            ->when(request('status') === 'cancelled', function ($query) {
                $query->where('status', AppointmentStatus::CANCELLED);
            })
            ->count();

        return response()->json([
            'totalAppointmentsCount' => $totalAppointmentsCount,
        ]);
    }

    public function users()
    {
        $totalUsersCount = User::query()
            ->when(request('date_range') === 'today', function ($query) {
                $query->whereBetween('created_at', [now()->today(), now()]);
            })
            ->when(request('date_range') === '30_days', function ($query) {
                $query->whereBetween('created_at', [now()->subDays(30), now()]);
            })
            ->when(request('date_range') === '60_days', function ($query) {
                $query->whereBetween('created_at', [now()->subDays(60), now()]);
            })
            ->when(request('date_range') === '360_days', function ($query) {
                $query->whereBetween('created_at', [now()->subDays(360), now()]);
            })
            ->when(request('date_range') === 'month_to_date', function ($query) {
                $query->whereBetween('created_at', [now()->firstOfMonth(), now()]);
            })
            ->when(request('date_range') === 'year_to_date', function ($query) {
                $query->whereBetween('created_at', [now()->firstOfYear(), now()]);
            })
            ->count();

        return response()->json([
            'totalUsersCount' => $totalUsersCount,
        ]);
    }
}
