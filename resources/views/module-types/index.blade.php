@extends("layouts.master")
@section('title', 'Module Types')
@section('content')
<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Create New Module</h4>
    </div>
    <div class="card-body">
        <!-- ADD NEW PRODUCT PART START -->
        <form method="POST" action="{{ !empty($type) ? route('module-types.update',$type->id) :  route('module-types.store') }}">
            @csrf
            @if(!empty($type))
                @method("PUT")
            @endif
            <input type="hidden" name="id" value="{{ !empty($type) ? $type->id : '' }}" />
            <div class="row g-3  mb-3 align-items-center">
                <div class="col-sm-4 ">
                    <!-- <div class="form-group"> -->
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Complete Name" value="{{ !empty($type) ? $type->name : old('name') }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!-- </div> -->
                </div>
                <div class="col-sm-4">
                    <!-- <div class="form-group"> -->
                    <label>Value</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="value" name="value" placeholder="Enter Value in Watt" value="{{ !empty($type) ? $type->value : old('value') }}">
                    @error('value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <!-- </div> -->
                </div>
                <div class="col-4 mt-3">
                    <label></label>
                    <div class="form-group float-left mt-3">
                        <button type="button" class="btn btn-danger float-right ml-2 text-white"><i class="icofont-ban"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary float-right " value="save"><i class="icofont-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <!-- ADD NEW PRODUCT PART END -->
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        <h4 class="card-title">Module Type List</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $key => $type)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->value }}</td>
                    <td class="text-center">
                        <a style="cursor: pointer;" data-toggle="tooltip" title="Edit" href="{{ route('module-types.edit',$type->id)}}">
                            <i class="icofont-pencil text-warning"></i></a>
                        <a style="cursor: pointer;" data-toggle="tooltip" title="Delete" class="ml-2" onclick="deleteUser('{{ $type->id }}')">
                            <i class="icofont-trash text-danger"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection