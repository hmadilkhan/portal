<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Project;
use App\Models\SubDepartment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Project::with("department","subdepartment","assignedPerson","assignedPerson.employee")->get();
        return view("projects.index", [
            "customers" => Customer::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("projects.form", [
            "project" => [],
            "customers" => Customer::all(),
            "employees" => Employee::getUser(1,["Manager","Employee"])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required',
            'budget' => 'required',
            'customer_id' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $subdepartment = SubDepartment::where("department_id",1)->first();
            $project = Project::create(array_merge($request->except(["assigntask"]), 
            [
                "department_id" => 1,
                "sub_department_id" => $subdepartment->id,
            ]));
            Task::create([
                "project_id" => $project->id,
                "employee_id" => $request->assigntask,
                "department_id" => 1,
                "sub_department_id" => $subdepartment->id,
            ]);
            DB::commit();
            return response()->json(["status" => 200, "messsage" => "Project created successfully"]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["status" => 500, "messsage" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view("projects.form", [
            "project" => $project,
            "customers" => Customer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $project->update($request->toArray());
            return response()->json(["status" => 200, "messsage" => "Project updated successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["status" => 500, "messsage" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function getProjectList()
    {
        return view("projects.project-list",[
            "projects" => Project::with("department","subdepartment","assignedPerson","assignedPerson.employee")->get(),
        ]);
    }
}
