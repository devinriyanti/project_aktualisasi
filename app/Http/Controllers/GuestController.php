<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGuestRequest;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuestsExport;

class GuestController extends Controller
{
    public function form()
    {
        // if (!Auth::check()) {
        //     $user = \App\Models\User::firstOrCreate(
        //         ['email' => 'guest@bukutamu.local'],
        //         ['name' => 'Guest User', 'password' => bcrypt('guestpass'), 'role' => 'user']
        //     );
        //     Auth::login($user);
        // }

        $todayCount = Guest::whereDate('created_at', now()->toDateString())->count();
        return view('guests.form', compact('todayCount'));
    }

    public function store(StoreGuestRequest $request)
    {
        Guest::create(array_merge($request->validated(), ['user_id' => Auth::id()]));
        return back()->with('success', 'Terima kasih, data tamu tersimpan.');
    }

    public function index(Request $request)
    {
        $query = Guest::query();

        // Default filter hari ini jika tidak ada filter
        if (!$request->filled('from') && !$request->filled('to')) {
            $query->whereDate('created_at', now()->toDateString());
        } else {
            if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
            if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('keperluan')) $query->where('keperluan', $request->keperluan);

        $guests = $query->latest()->get(); // Ubah ke get() untuk DataTable client-side
        return view('guests.index', compact('guests'));
    }

    public function exportPdf(Request $request)
    {
        $query = Guest::query();

        // Filter sesuai dengan kondisi index
        if (!$request->filled('from') && !$request->filled('to')) {
            $query->whereDate('created_at', now()->toDateString());
        } else {
            if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
            if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('keperluan')) $query->where('keperluan', $request->keperluan);

        $guests = $query->latest()->get();
        $pdf = Pdf::loadView('guests.pdf', compact('guests'));
        return $pdf->download('buku-tamu-' . now()->format('YmdHis') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = Guest::query();

        // Filter sesuai dengan kondisi index
        if (!$request->filled('from') && !$request->filled('to')) {
            $query->whereDate('created_at', now()->toDateString());
        } else {
            if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
            if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('keperluan')) $query->where('keperluan', $request->keperluan);

        $guests = $query->latest()->get();

        // Create Excel file
        $fileName = 'buku-tamu-' . now()->format('YmdHis') . '.xlsx';

        return Excel::download(
            new GuestsExport($guests),
            $fileName
        );
    }
}
