<?php

namespace App\Repository;

use App\Services\PermissionService;

class PermissionRepository
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index($request)
    {
        return view("auth.permissions.index", [
            "permission" =>  $this->permissionService->getPermissionById($request->id),
            "permissions" => $this->permissionService->getPermissionList(),
        ]);
    }

    public function store($request)
    {
        $permission = $this->permissionService->addPermission($request);
        if ($permission) {
            return redirect()->route("permission");
        }
    }

    public function permissionUpdate($request)
    {
        $permission = $this->permissionService->getPermissionById($request->id);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route("permission");
    }

    public function deletePermission($request)
    {
        $permission = $this->permissionService->getPermissionById($request->id);
        if ($permission) {
            $permission->delete();
            return response()->json(["status" => 200]);
        } else {
            return response()->json(["status" => 500]);
        }
    }

    public function viewRolePermission($request)
    {
        if ($request->id) {
            # code...
            $role = $this->permissionService->getRoleById($request->id);
        }

        return view("auth.permissions.role_permission", [
            "roles" => $this->permissionService->getAllRole(),
            "permissions" => $this->permissionService->getPermissionList(),
            "lists" => $this->permissionService->getRolesList(),
            "rolename" => ($request->id != "" ? $role : []),
            "rolepermissions" => ($request->id != "" ? $role->permissions->pluck("name")->toArray() : []),
        ]);
    }

    public function storeOrUpdateRolePermissions($request, $mode)
    {
        // return $request->permission;
        $id = ($mode == "insert" ? $request->role : $request->id);
        $role = $this->permissionService->getRoleById($id);
        // return $role;
        $role->syncPermissions($request->permission);
        return redirect()->route("role.permission");
    }

    public function deleteRolePermission($request)
    {
        try {
            $role = $this->permissionService->getRoleById($request->id);
            $role->syncPermissions([]);
            return response()->json(["status" => 200]);
        } catch (\Throwable $th) {
            return response()->json(["status" => 500]);
        }
    }

    public function viewUserPermission($request)
    {
        if ($request->id) {
            $user = $this->permissionService->getUserById($request->id);
        }

        return view("auth.permissions.user_permission", [
            "users" => $this->permissionService->getAllUsers(),
            "permissions" => $this->permissionService->getPermissionList(),
            "lists" => $this->permissionService->getUserPermissionList(),
            "username" => ($request->id != "" ? $user : []),
            "userpermissions" => ($request->id != "" ? $user->permissions->pluck("name")->toArray() : []),
        ]);
    }

    public function storeOrUpdateUserPermissions($request, $mode)
    {
        $id = ($mode == "insert" ? $request->user : $request->id);
        $user = $this->permissionService->getUserById($id);
        $user->syncPermissions($request->permission);
        return redirect()->route("user.permission");
    }

    public function deleteUserPermission($request)
    {
        try {
            $user = $this->permissionService->getUserById($request->id);
            $user->syncPermissions([]);
            return response()->json(["status" => 200]);
        } catch (\Throwable $th) {
            return response()->json(["status" => 500]);
        }
    }


}
