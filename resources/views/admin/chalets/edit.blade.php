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

                {{-- <div class="form-group">
                    <label for="owner_id" class="font-weight-bold">Owner</label>
                    <select name="owner_id" id="owner_id" class="form-control" required>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ $chalet->owner && $chalet->owner->id == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                

                <div class="form-group">
                    <label for="address" class="font-weight-bold">Location</label>
                    <select name="address" id="address" class="form-control" required>
                        @foreach(["Amman", "Zarqa", "Irbid", "Ajloun", "Jerash", "Mafraq", "Balqa", "Madaba", "Karak", "Tafilah", "Maan", "Aqaba"] as $location)
                            <option value="{{ $location }}" {{ $chalet->address == $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="price_per_day" class="font-weight-bold">Price Per Day</label>
                    <input type="number" name="price_per_day" id="price_per_day" class="form-control" value="{{ $chalet->price_per_day }}" required>
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
