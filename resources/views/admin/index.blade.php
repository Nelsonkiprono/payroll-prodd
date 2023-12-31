@extends('layouts.main_hr')
@section('xara_cbs')
    @include('partials.breadcrumbs')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <a href="{{ url('users/create') }}" class="btn btn-sm btn-outline-primary">
                                            Add User
                                        </a>
                                    </div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $count = 1; ?>
                                        <tbody>
                                            @forelse($users as$user)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $role)
                                                                {{ $role }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            <i class="fa fa-cogs"></i>Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-item text-info">
                                                                <a href="{{ route('users.show', $user->id) }}">
                                                                    <i class="fa fa-eye"></i>
                                                                    View User
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-item text-success" data-toggle="modal"
                                                                data-target="#editUser{{ $user->id }}">
                                                                <i class="fa fa-edit"></i>
                                                                Edit
                                                            </li>
                                                            <li class="dropdown-item text-info" data-toggle="modal"
                                                                data-target="#editUserPassword{{ $user->id }}">
                                                                <i class="fa fa-edit"></i>
                                                                Update Password
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="editUser{{ $user->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ url('users/update',$user->id)}}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">Name</label>
                                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">Email</label>
                                                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-form-label" for="roles">Role</label>
                                                                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control select2','multiple')) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Not Now</button>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="editUserPassword{{$user->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">Password</label>
                                                                        <input type="password" name="password" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">Confirm Password</label>
                                                                        <input type="password" name="confirm_password" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">
                                                                        Not Now
                                                                    </button>
                                                                    <button class="btn btn-sm btn-success" type="submit">
                                                                        Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="mt-2 float-right">
                                        {!! $users->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
