@extends("layouts.master")
@section('title', 'Tasks List')
@section('content')
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card border-0 mb-4 no-bg">
                    <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                        <h3 class=" fw-bold flex-fill mb-0 mt-sm-0">Task</h3>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Task List</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Project Name</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Sub Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $key => $task)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $task->project->project_name }}</td>
                            <td>{{ $task->employee->name }}</td>
                            <td>{{ $task->department->name }}</td>
                            <td>{{ $task->subdepartment->name }}</td>
                            <td>
                                <span class="small  {{($task->status == 'In-Progress' ? 'light-danger-bg' : 'light-success-bg')}}  p-1 rounded"><i class="icofont-ui-clock"></i> {{$task->status}}</span>
                            </td>
                            <td class="text-center">
                                <a style="cursor: pointer;" data-toggle="tooltip" title="Edit" href="{{route('tasks.edit',$task->id)}}">
                                    <i class="icofont-pencil text-warning fs-4"></i></a>
                                <a style="cursor: pointer;" data-toggle="tooltip" title="Delete" class="ml-2" onclick="deleteUser('{{ $task->id }}')">
                                    <i class="icofont-trash text-danger fs-4"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- ROW END -->
    </div>
</div>
@endsection