<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        $userId = auth()->id();

        $conversations = Conversation::where($role . '_id', $userId)
            ->with(['room.property', 'owner', 'tenant', 'messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->latest('updated_at')
            ->get();

        return view($role . '.messages.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        // Authorization
        if (!in_array(auth()->id(), [$conversation->owner_id, $conversation->tenant_id])) {
            abort(403);
        }

        $conversation->load(['room.property', 'owner', 'tenant', 'messages.sender']);
        $role = auth()->user()->role;

        return view($role . '.messages.show', compact('conversation'));
    }

    public function store(Request $request, Conversation $conversation)
    {
        if (!in_array(auth()->id(), [$conversation->owner_id, $conversation->tenant_id])) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        // Update conversation timestamp for sorting
        $conversation->touch();

        return back()->with('success', 'Message sent!');
    }

    public function start(Room $room)
    {
        $tenantId = auth()->id();
        $ownerId = $room->property->owner_id;

        // Check if conversation already exists
        $conversation = Conversation::where('room_id', $room->id)
            ->where('tenant_id', $tenantId)
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'room_id' => $room->id,
                'owner_id' => $ownerId,
                'tenant_id' => $tenantId,
            ]);
        }

        return redirect()->route('tenant.messages.show', $conversation);
    }
}
