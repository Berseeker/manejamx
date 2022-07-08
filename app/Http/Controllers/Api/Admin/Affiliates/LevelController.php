<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AffiliateLevelStore;
use App\Http\Requests\Admin\AffiliateLevelUpdate;
use App\Http\Resources\AffiliateLevelResource;
use App\Models\AffiliateLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class LevelController extends Controller
{
    public function index(): JsonResource
    {
        $levels = AffiliateLevel::query()->with(['file'])->orderBy('start_points')->paginateIf();

        return AffiliateLevelResource::collection($levels);
    }

    public function store(AffiliateLevelStore $request): AffiliateLevelResource
    {
        $level = AffiliateLevel::query()->create($request->only(['name', 'start_points', 'end_points']));

        $path = $request->file('file')->store('levels', 'public');

        $level->file()->create([
            'path'      => $path,
            'filename'  => $request->file('file')->getClientOriginalName(),
            'name'      => $request->file('file')->getClientOriginalName(),
        ]);

        return new AffiliateLevelResource($level);
    }

    public function update(AffiliateLevelUpdate $request, $levelId): AffiliateLevelResource
    {
        $level = AffiliateLevel::query()->find($levelId);

        $level->update($request->only(['name', 'start_points', 'end_points']));

        $path = $request->file('file')->store('levels', 'public');

        $level->file()->updateOrCreate([
            'fileable_id'   => $level->id,
            'fileable_type' => AffiliateLevel::class,
        ], [
            'path'      => $path,
            'filename'  => $request->file('file')->getClientOriginalName(),
            'name'      => $request->file('file')->getClientOriginalName(),
        ]);

        return new AffiliateLevelResource($level);
    }

    public function destroy($levelId): Response
    {
        AffiliateLevel::query()->where('id', $levelId)->delete();

        return response([], 204);
    }
}
