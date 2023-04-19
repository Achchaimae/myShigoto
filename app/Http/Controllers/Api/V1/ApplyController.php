<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Apply;
use App\Models\PostApply;
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
    //show apply by that have a pending status
    public function showPending()
    {
        $apply = Apply::where('status', 'pending')->get();
        return response()->json([
            'message' => 'Apply pending successfully',
            'data' => $apply
        ]);
    }
    public function store(StoreApplyRequest $request)
    {


        $apply = Apply::create($request->validated());

        PostApply::create([
            'post_id' => $request->post_id,
            'apply_id' => $apply->id,
            ]);
        return response()->json([
            'message' => 'Apply sent successfully dnaud'
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

   //accepte apply 
    public function accepte($id)
    {
        $apply = Apply::find($id);
        $apply->status = 'accepted';
        $apply->save();
        return response()->json([
            'message' => 'Apply accepted successfully'
        ]);
    }
    //reject apply
    public function reject($id)
    {
        $apply = Apply::find($id);
        $apply->status = 'rejected';
        $apply->save();
        return response()->json([
            'message' => 'Apply rejected successfully'
        ]);
    }




    
}
