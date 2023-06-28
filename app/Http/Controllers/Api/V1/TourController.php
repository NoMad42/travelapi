<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourListRequest;
use App\Http\Resources\Api\V1\TourRecource;
use App\Models\Travel;

class TourController extends Controller
{
    public function index(Travel $travel, TourListRequest $request)
    {
        return TourRecource::collection(
            $travel->tours()
                ->when(
                    $request->priceFrom,
                    fn ($query) => $query->where(
                        'price',
                        '>=',
                        $request->priceFrom * 100
                    )
                )
                ->when(
                    $request->priceTo,
                    fn ($query) => $query->where(
                        'price',
                        '<=',
                        $request->priceTo * 100
                    )
                )
                ->when(
                    $request->dateFrom,
                    fn ($query) => $query->where(
                        'starting_date',
                        '>=',
                        $request->dateFrom
                    )
                )
                ->when(
                    $request->dateTo,
                    fn ($query) => $query->where(
                        'starting_date',
                        '<=',
                        $request->dateTo
                    )
                )
                ->when(
                    $request->sortBy && $request->sortOrder,
                    fn ($query) => $query->orderBy(
                        $request->sortBy,
                        $request->sortOrder
                    )
                )
                ->orderBy('starting_date')
                ->paginate()
        );
    }
}
