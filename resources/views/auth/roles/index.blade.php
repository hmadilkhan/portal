@extends('layouts.master')
@section('title', 'Roles')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title w-100">
                Roles Section
            </h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ !empty($role) ? route('update.role') : route('save.role') }}">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($role) ? $role->id : '' }}" />
                <div class="row mt-2 ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                placeholder="Enter Role Name" value="{{ !empty($role) ? $role->name : old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <label></label>
                        <div class="form-group ">
                            <button type="submit" name="buttonstatus" class="btn btn-success  " value="save"><i
                                    class="fas fa-credit-card"></i> Save
                            </button>
                            <button type="button" class="btn btn-danger  ml-2"><i class="fas fa-ban"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Roles List</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-center">
                                <a style="cursor: pointer;" data-toggle="tooltip" title="Edit" href="{{ url('role') . '/' . $role->id }}">
                                    <i class="fas fa-edit text-warning"></i></a>
                                <a style="cursor: pointer;" data-toggle="tooltip" title="Delete" class="ml-2"
                                    onclick="deleteRole('{{ $role->id }}')">
                                    <i class="fas fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function deleteRole(roleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('delete.role') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: roleId,
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Role has been deleted.',
                                    'success'
                                )
                                location.reload();
                            }
                        },
                        error: function(error) {
                            Swal.fire(
                                'Error!',
                                'Some error occurred :)',
                                'error'
                            )
                        }
                    });
                }
                if (result.dismiss) {
                    Swal.fire(
                        'Cancelled!',
                        'Role is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
