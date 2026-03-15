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
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function conversations(Request $request): JsonResponse
    {
        $conversations = Conversation::where('user_one_id', '=', $request->user()->id)
            ->orWhere('user_two_id', '=', $request->user()->id)
            ->with(['userOne', 'userTwo', 'messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->latest()
            ->get();

        return $this->success($conversations);
    }

    /**
     * Get messages for a specific conversation.
     *
     * @param Conversation $conversation
     * @param Request $request
     * @return JsonResponse
     */
    public function messages(Conversation $conversation, Request $request): JsonResponse
    {
        if ($conversation->user_one_id !== $request->user()->id && $conversation->user_two_id !== $request->user()->id) {
            return $this->forbidden();
        }

        $messages = $conversation->messages()->with('sender')->oldest()->get();

        return $this->success($messages);
    }

    /**
     * Send a new message.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);

        $conversation = Conversation::findOrFail($validated['conversation_id']);

        if ($conversation->user_one_id !== $request->user()->id && $conversation->user_two_id !== $request->user()->id) {
            return $this->forbidden();
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'message' => $validated['message'],
        ]);

        return $this->success($message, 'Message sent successfully', 201);
    }
}
