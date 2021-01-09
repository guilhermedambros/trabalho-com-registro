<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('perfil_acessar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource(Role::with(['permissions'])->get());
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('perfil_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoleResource($role->load(['permissions']));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('perfil_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
