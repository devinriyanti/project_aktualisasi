<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik hari ini
        $todayCount = Guest::whereDate('created_at', now()->toDateString())->count();
        $todayGuests = Guest::whereDate('created_at', now()->toDateString())->latest()->take(5)->get();

        // Statistik bulan ini
        $thisMonthCount = Guest::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->count();

        // Total semua tamu
        $totalGuests = Guest::count();

        // Data keperluan terbanyak
        $topReasons = Guest::select('keperluan', DB::raw('count(*) as total'))
            ->groupBy('keperluan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Data per hari dalam 7 hari terakhir
        $sevenDaysData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Guest::whereDate('created_at', $date->toDateString())->count();
            $sevenDaysData[] = [
                'date' => $date->format('d M'),
                'day' => $date->format('l'),
                'count' => $count,
            ];
        }

        // Data instansi terbanyak
        $topInstitutions = Guest::select('instansi', DB::raw('count(*) as total'))
            ->where('instansi', '!=', null)
            ->where('instansi', '!=', '')
            ->groupBy('instansi')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        // Perhitungan growth rate
        $lastMonthCount = Guest::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ])->count();

        $growthRate = $lastMonthCount > 0
            ? round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 1)
            : 0;

        return view('dashboard', compact(
            'todayCount',
            'todayGuests',
            'thisMonthCount',
            'totalGuests',
            'topReasons',
            'sevenDaysData',
            'topInstitutions',
            'growthRate'
        ));
    }
}
