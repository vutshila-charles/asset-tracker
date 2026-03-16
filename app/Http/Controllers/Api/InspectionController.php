<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectionRequest;
use App\Models\Asset;

class InspectionController extends Controller
{
    
    public function store(StoreInspectionRequest $request, Asset $asset)
    {
        $inspection = $asset->inspections()->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Inspection created',
            'data' => $inspection
        ], 201);
    }
}