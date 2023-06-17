<form id="form" method="post" action="" enctype="multipart/form-data">
    @csrf
    @if(!empty($project))
    @method('PUT')
    @endif
    <input type="hidden" name="id" id="id" value="{{ !empty($project) ? $project->id : '' }}" />
    <input type="hidden" id="route" value="{{!empty($project) ? route('projects.update',$project->id) : route('projects.store')}}" />
    <div class="mb-3">
        <label for="project_name" class="form-label">Project Name</label>
        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Explain what the Project Name">
        <div id="project_name_message" class="text-danger message mt-2"></div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-sm">
            <label for="budget" class="form-label">Budget</label>
            <input type="number" class="form-control" id="budget" name="budget">
            <div id="budget_message" class="text-danger message mt-2"></div>
        </div>
        <div class="col-sm">
            <label for="customer_id" class="form-label">Select Customer</label>
            <select class="form-select select2 " id="customer_id" name="customer_id" aria-label="Default select Select Customer">
                <option selected value="">Select Customer</option>
                @foreach($customers as $customer)
                <option value="{{$customer->id}}">{{$customer->first_name}}</option>
                @endforeach
            </select>
            <div id="customer_id_message" class="text-danger message mt-2"></div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-sm-12">
            <label for="assigntask" class="form-label">Task Assign Person</label>
            <select id="assigntask" name="assigntask" class="form-select" multiple aria-label="Default select Assign Person">
                <option selected value="">Select Assign Person</option>
                @foreach($employees as $employee)
                <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="deadline-form">
        <div class="row g-3 mb-3">
            <div class="col">
                <label for="start_date" class="form-label">Project Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" id="datepickerded">
                <div id="start_date_message" class="text-danger message mt-2"></div>
            </div>
            <div class="col">
                <label for="end_date" class="form-label">Project End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" id="datepickerdedone">
                <div id="end_date_message" class="text-danger message mt-2"></div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description (optional)</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add any extra details about the request"></textarea>
        <div id="description_message" class="text-danger message mt-2"></div>
    </div>
    <button type="submit" class="btn btn-primary" style="display:none" id="btnFormSubmit">Create</button>
</form>