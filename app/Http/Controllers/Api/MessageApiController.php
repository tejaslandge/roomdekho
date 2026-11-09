<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageApiController extends BaseController
{
    /**
     * List user's conversations.
     */
    public function conversations(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $conversations = Conversation::where(function ($query) use ($userId) {
            $query->where('owner_id', $userId)
                ->orWhere('tenant_id', $userId);
        })
            ->with([
                'room.property',
                'owner',
                'tenant',
                'messages' => fn ($q) => $q->latest()->limit(1),
            ])
            ->latest('updated_at')
            ->get();

        return $this->success($conversations);
    }

    /**
     * Get messages for a specific conversation.
     */
    public function messages(Conversation $conversation, Request $request): JsonResponse
    {
        if (! in_array($request->user()->id, [$conversation->owner_id, $conversation->tenant_id], true)) {
            return $this->forbidden();
        }

        $messages = $conversation->messages()->with('sender')->oldest()->get();

        return $this->success($messages);
    }

    /**
     * Send a new message.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:5000',
        ]);

        $conversation = Conversation::findOrFail($validated['conversation_id']);

        if (! in_array($request->user()->id, [$conversation->owner_id, $conversation->tenant_id], true)) {
            return $this->forbidden();
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'message' => $validated['message'],
        ]);

        $conversation->touch();

        return $this->success($message->load('sender'), 'Message sent successfully', 201);
    }
}
