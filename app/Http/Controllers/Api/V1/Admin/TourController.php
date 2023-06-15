<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\Api\V1\TourRecource;
use App\Models\Travel;

class TourController extends Controller
{
    public function store(Travel $travel, TourRequest $request)
    {
        return new TourRecource($travel->tours()->create(($request->validated())));
    }
}
