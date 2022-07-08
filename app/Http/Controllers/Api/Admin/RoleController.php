<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequestStore;
use App\Http\Requests\Admin\RoleRequestUpdate;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return RoleResource::collection(
            Role::withPermissions()
                ->orderBy('name')
                ->paginate(15)
        );
    }

    public function store(RoleRequestStore $request)
    {
        $role = Role::create($request->validated());

        $role->syncPermissions($request->permissions);

        return new RoleResource($role);
    }

    public function update(RoleRequestUpdate $request, Role $role)
    {
        $role->update($request->only(['readable_name', 'permissions']));

        $role->syncPermissions($request->permissions);

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true
        ], 204);
    }
}
