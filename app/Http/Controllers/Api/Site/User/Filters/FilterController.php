<?php

namespace App\Http\Controllers\Api\Site\User\Filters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\Filter\FilterRequestStore;
use App\Http\Requests\Site\User\Filter\FilterRequestUpdate;
use App\Http\Resources\Site\User\FilterResource;
use App\Models\UserFilter;

class FilterController extends Controller
{
    public function index()
    {
        $filters = auth()->user()->filters;

        return FilterResource::collection($filters);
    }

    public function store(FilterRequestStore $request)
    {
        $user = auth()->user();

        $filter = $user->filters()->create([
            'email' => $request->email,
            'name' => $request->name,
            'filters' => json_encode($request->filters),
            'filter_names' => json_encode($request->filter_names)
        ]);

        return new FilterResource($filter);
    }

    public function update(FilterRequestUpdate $request, UserFilter $filter)
    {
        $filter->update([
            'name' => $request->name
        ]);

        return new FilterResource($filter);
    }

    public function destroy(UserFilter $filter)
    {
        $filter->delete();

        return response()->json([
            'success' => true
        ], 204);
    }
}
