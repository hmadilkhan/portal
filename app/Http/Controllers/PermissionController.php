<?php

namespace App\Http\Controllers;

use App\Repository\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        return $this->permissionRepository->index($request);
    }

    public function store(Request $request)
    {
        return $this->permissionRepository->store($request);
    }

    public function update(Request $request)
    {
        return $this->permissionRepository->permissionUpdate($request);
    }


    public function delete(Request $request)
    {
        return $this->permissionRepository->deletePermission($request);
    }

    public function rolePermission(Request $request)
    {
        return $this->permissionRepository->viewRolePermission($request);
    }

    public function storeRolePermission(Request $request)
    {
        return $this->permissionRepository->storeOrUpdateRolePermissions($request,"insert");
    }

    public function updateRolePermission(Request $request)
    {
        return $this->permissionRepository->storeOrUpdateRolePermissions($request,"update");
    }

    public function deleteRolePermission(Request $request)
    {
        return $this->permissionRepository->deleteRolePermission($request);
    }

    public function userPermission(Request $request)
    {
        return $this->permissionRepository->viewUserPermission($request);
    }

    public function storeUserPermission(Request $request)
    {
        return $this->permissionRepository->storeOrUpdateUserPermissions($request,"insert");
    }

    public function updateUserPermission(Request $request)
    {
        return $this->permissionRepository->storeOrUpdateUserPermissions($request,"update");
    }

    public function deleteUserPermission(Request $request)
    {
        return $this->permissionRepository->deleteUserPermission($request,"update");
    }
}
