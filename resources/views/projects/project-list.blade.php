<!-- <div class=" fade"> -->
<div class="row g-3 gy-5 py-3 row-deck">
    @foreach($projects as $project)
    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mt-5">
                    <div class="lesson_name">
                        <div class="project-block light-info-bg">
                            <i class="icofont-handshake-deal"></i>
                        </div>
                        <span class="large text-muted project_name fw-bold"> {{$project->department->name}} </span>
                        <h5 class="mb-0 fw-bold  fs-6  mb-2">{{$project->subdepartment->name}}</h5>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">

                        <!-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteproject"><i class="icofont-ui-delete text-danger"></i></button> -->
                    </div>
                </div>

                <div class="row g-2 pt-4">

                    <div class="col-12 d-flex align-items-center">
                        <div class="">
                            <h3 class="mb-0 fw-bold  fs-6  mb-2">{{$project->project_name}}</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="icofont-ui-calendar"></i>
                            <span class="ms-2">Project Start Date</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <!-- <i class="icofont-sand-clock"></i> -->
                            <span class="ms-2 text-success">{{date("d M Y",strtotime($project->start_date))}}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="icofont-ui-calendar"></i>
                            <span class="ms-2">Project End Date</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <!-- <i class="icofont-sand-clock"></i> -->
                            <span class="ms-2 text-danger">{{date("d M Y",strtotime($project->end_date))}}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="icofont-group-students "></i>
                            <span class="ms-2">Assigned To</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <!-- <i class="icofont-ui-text-chat"></i> -->
                            <span class="ms-2">{{$project->assignedPerson[0]->employee->name}}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="icofont-dollar "></i>
                            <span class="ms-2">Budget</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <!-- <i class="icofont-dollar"></i> -->
                            <span class="ms-2">${{number_format($project->budget,0)}}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="small fw-bold mb-0">Progress</h4>
                            <span class="small {{($project->assignedPerson[0]->status == 'In-Progress' ? 'light-warning-bg' : 'light-success-bg')}}  p-1 rounded"><i class="icofont-ui-clock"></i> {{$project->assignedPerson[0]->status}}</span>
                        </div>
                    </div>
                </div>
                
                <div class="dividers-block"></div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <p>{{$project->description}}</p>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- </div> -->