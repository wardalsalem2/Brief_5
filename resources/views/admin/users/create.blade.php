@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($user) ? 'Edit User' : 'Add New User' }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ isset($user) ? $user->email : old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="user" {{ (isset($user) && $user->role == 'user') ? 'selected' : '' }}>Renter</option>
                        <option value="owner" {{ (isset($user) && $user->role == 'owner') ? 'selected' : '' }}>Lessor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" {{ !isset($user) ? 'required' : '' }}>
                    <small class="text-muted">Leave blank to keep the current password.</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($user) ? 'Update User' : 'Add User' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection