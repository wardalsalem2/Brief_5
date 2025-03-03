@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Edit Chalet: {{ $chalet->name }}</h1>

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Chalet Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.chalets.update', $chalet->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="font-weight-bold">Chalet Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $chalet->name }}" required>
                </div>

                <div class="form-group">
                    <label for="location" class="font-weight-bold">Location</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $chalet->location }}" required>
                </div>

                <div class="form-group">
                    <label for="price_per_day" class="font-weight-bold">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day" class="form-control" value="{{ $chalet->price_per_day }}" required>
                </div>

                <div class="form-group">
                    <label for="type" class="font-weight-bold">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="chalet" {{ $chalet->type == 'chalet' ? 'selected' : '' }}>Chalet</option>
                        <option value="villa" {{ $chalet->type == 'villa' ? 'selected' : '' }}>Villa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="font-weight-bold">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="available" {{ $chalet->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not available" {{ $chalet->status == 'not available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.chalets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </form>
        </div>
    </div>
@endsection