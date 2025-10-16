<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGuestRequest;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    public function form()
    {
        if (!Auth::check()) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => 'guest@bukutamu.local'],
                ['name' => 'Guest User', 'password' => bcrypt('guestpass'), 'role' => 'user']
            );
            Auth::login($user);
        }

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

        if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
        if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);
        if ($request->filled('keperluan')) $query->where('keperluan', $request->keperluan);

        $guests = $query->latest()->paginate(20);
        return view('guests.index', compact('guests'));
    }

    public function exportPdf(Request $request)
    {
        $query = Guest::query();
        if ($request->filled('keperluan')) $query->where('keperluan', $request->keperluan);
        if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
        if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);

        $guests = $query->get();
        $pdf = Pdf::loadView('guests.pdf', compact('guests'));
        return $pdf->download('buku-tamu-' . now()->format('YmdHis') . '.pdf');
    }
}
