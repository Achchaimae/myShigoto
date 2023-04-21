<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Messages;
use App\Models\Apply;
use App\Models\PostApply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreApplyRequest;
use App\Http\Resources\V1\ApplyResource;
use App\Http\Resources\V1\ConversationsResource;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;


use App\Http\Requests\StoremessagesRequest;
use App\Http\Requests\UpdatemessagesRequest;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremessagesRequest $request)
    {
        $request->validated($request->all());
        return Messages::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemessagesRequest $request, messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(messages $messages)
    {
        //
    }
}
