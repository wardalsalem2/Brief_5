@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Manage Chalets</h1>

    <div class="card shadow mb-4">
    <div class="container my-3">
    <form method="GET" action="{{ route('admin.chalets.index') }}" class="row g-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
        </div>
        
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="not available" {{ request('status') == 'not available' ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>

        <div class="col-md-3">
            <input type="text" name="location" class="form-control" placeholder="Location..." value="{{ request('location') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
        </div>
    </form>
</div>

    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chalets</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price Per Day</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chalets as $chalet)
                            <tr>
                                <td>{{ $chalet->id }}</td>
                                <td>{{ $chalet->name }}</td>
                                <td>{{ $chalet->location }}</td>
                                <td>{{ $chalet->price_per_day }} EGP</td>
                                <td>{{ ucfirst($chalet->type) }}</td>
                                <td>
                                    <span class="badge {{ $chalet->status == 'available' ? 'badge-success' : 'badge-danger' }}">
                                        {{ ucfirst($chalet->status) }}
                                    </span>
                                </td>
                                <td>{{ $chalet->owner->name }}</td>
                                <td>
                                    <a href="{{ route('admin.chalets.edit', $chalet->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.chalets.toggleStatus', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{ $chalet->status == 'available' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.chalets.destroy', $chalet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $chalets->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection