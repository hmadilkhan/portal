<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return view("auth.roles.index", [
            "role" => ($request->id != "" ? Role::findOrFail($request->id) : []),
            "roles" => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        if ($role) {
            return redirect()->route("role");
        }
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request->id);
        if ($role) {
            $role->name = $request->name;
            $role->save();
            return redirect()->route("role");
        }
    }

    public function delete(Request $request)
    {
        $role = Role::findOrFail($request->id);
        if ($role) {
            $role->delete();
            return response()->json(["status" => 200]);
        } else {
            return response()->json(["status" => 500]);
        }
    }
}
