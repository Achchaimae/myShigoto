<?php

// // namespace App\Http\Controllers;

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Apply;
use App\Models\PostApply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreApplyRequest;
use App\Http\Resources\V1\ApplyResource;
use App\Http\Resources\V1\ConversationsResource;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;

class MyConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::find($request->id);
        // dd($user);


        if ($user->role == 'apprenant')
            return ConversationsResource::collection(Conversation::where('client_id', $user->id)->get()) ;

        return ConversationsResource::collection(Conversation::where('owner_id', $user->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConversationRequest $request)
    {
        return Conversation::create([
            'client_id' => $request->client_id,
            'owner_id' => $request->owner_id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
