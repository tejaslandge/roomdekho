<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agreement;

class AgreementController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $agreements = match($role) {
            'admin' => Agreement::with(['booking.room.property', 'tenant', 'owner'])->latest()->paginate(10),
            'owner' => Agreement::where('owner_id', '=', auth()->id())->with(['booking.room.property', 'tenant'])->latest()->paginate(10),
            'tenant' => Agreement::where('tenant_id', '=', auth()->id())->with(['booking.room.property', 'owner'])->latest()->paginate(10),
        };

        return view($role . '.agreements.index', compact('agreements'));
    }

    public function show(Agreement $agreement)
    {
        // Authorization
        if (!in_array(auth()->id(), [$agreement->owner_id, $agreement->tenant_id]) && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $agreement->load(['booking.room.property', 'tenant', 'owner']);
        return view('common.agreements.show', compact('agreement'));
    }

    public function terminate(Agreement $agreement)
    {
        // Authorization
        if (!in_array(auth()->id(), [$agreement->owner_id, $agreement->tenant_id]) && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $agreement->update(['status' => 'terminated']);
        
        // Make room available again
        $agreement->booking->room->update(['available' => true]);

        return back()->with('success', 'Agreement terminated successfully. The room is now available.');
    }
}
