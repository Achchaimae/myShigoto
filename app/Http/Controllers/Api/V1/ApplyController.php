<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplyRequest;
use App\Http\Resources\V1\ApplyResource;

class ApplyController extends Controller
{
    public
    function index()
    {
        return ApplyResource::collection(Apply::all());
    }
    public function show(Apply $apply)
    {
        return new  ApplyResource($apply);
    }
    public function store(StoreApplyRequest $request)
    {
        Apply::create($request->validated());
        return response()->json([
            'message' => 'Apply sent successfully'
        ]);

    }
    public function update(StoreApplyRequest $request, Apply $apply)
    {
        $apply->update($request->validated());
        return response()->json([
            'message' => 'Apply updated successfully'
        ]);
    }
    public function destroy(Apply $apply)
    {
        $apply->delete();
        return response()->json([
            'message' => 'Apply deleted successfully'
        ]);
    }
    
}
