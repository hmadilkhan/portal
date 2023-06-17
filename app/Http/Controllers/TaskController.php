<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\SubDepartment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("tasks.index",[
            "tasks" => Task::with("project","employee","department","subdepartment")->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
        
            DB::beginTransaction();
            $task->update(["status" => "Completed"]);
            $department_id = $task->department_id + 1;
            $subdepartment = SubDepartment::where("department_id",$department_id)->first();
            $emp = Employee::getUser($department_id,["Employee"])->first();
            Task::create([
                "project_id" => $task->project_id,
                "employee_id" => $emp->id,
                "department_id" => $department_id,
                "sub_department_id" => $subdepartment->id,
            ]);
            $project = Project::findOrFail($task->project_id);
            $project->update([
                "department_id" => $department_id,
                "sub_department_id" => $subdepartment->id
            ]);
            DB::commit();
            return redirect()->route("tasks.index");
        } catch (\Throwable $th) {
            DB::rollBack();
           return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
