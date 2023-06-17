<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("employees.index", [
            "employees" => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("employees.form", [
            "employee" => [],
            "roles" => Role::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'department_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            DB::beginTransaction();
            $result = $this->uploads($request->file, 'employees/');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'user_type_id' => 2, // 2 is for Employee
            ]);
            foreach ($request->roles as $key => $value) {
                $user->syncRoles($value);
            }
            Employee::create(
                array_merge(
                    $request->except(["file", "id", "previous_logo", "roles", "username", "password", "password_confirmation", "user_id"]),
                    [
                        "user_id" => $user->id,
                        "image" => (!empty($result) ? $result["fileName"] : ""),
                    ]
                )
            );
            DB::commit();
            return response()->json(["status" => 200, "messsage" => "Employee created successfully"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["status" => 500, "messsage" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view("employees.form", [
            "employee" => $employee,
            "roles" => Role::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            DB::beginTransaction();
            $result = $this->uploads($request->file, 'employees/', $request->previous_logo);
            User::where("id", $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user = User::findOrFail($request->user_id);
            foreach ($request->roles as $key => $value) {
                $user->syncRoles($value);
            }
            $employee->update(
                array_merge(
                    $request->except(["file", "id", "previous_logo", "roles", "username", "password", "password_confirmation", "user_id"]),
                    [
                        "user_id" => $request->user_id,
                        "image" => (!empty($result) ? $result["fileName"] : $request->previous_logo),
                    ]
                )
            );
            DB::commit();
            return response()->json(["status" => 200, "messsage" => "Employee updated successfully"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["status" => 500, "messsage" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
