<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chalet Details - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .form-section p {
            margin-bottom: 8px;
            font-size: 16px;
            color: #666;
        }
        .preview-image {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }
    </style>
</head>
<body>

@include('component.header')

<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-dark">Chalet Details - <span class="text-primary">CHALETS</span></h1>
    </div>

    <div class="form-container mx-auto" style="max-width: 800px;">
        <h2 class="form-title text-center">Chalet Information</h2>

        <!-- Basic Information Section -->
        <div class="form-section">
            <h3 class="section-title">Basic Information</h3>
            <p><strong>Name:</strong> {{ $chalet->name }}</p>
            <p><strong>Price per Day:</strong> ${{ $chalet->price_per_day }}</p>
            <p><strong>Address:</strong> {{ $chalet->address }}</p>
            <p><strong>Discount:</strong> {{ $chalet->discount }}%</p>
            <p><strong>Description:</strong> {{ $chalet->description }}</p>
            <p><strong>Status:</strong> {{ ucfirst($chalet->status) }}</p>
            <p><strong>Area:</strong> {{ $chalet->area }} m²</p>
            <p><strong>View:</strong> {{ $chalet->view }}</p>
        </div>

        <!-- Features Section -->
        <div class="form-section">
            <h3 class="section-title">Chalet Features</h3>
            <p><strong>Bedrooms:</strong> {{ $chalet->bedrooms }}</p>
            <p><strong>Bathrooms:</strong> {{ $chalet->bathrooms }}</p>
            <p><strong>Air Conditioners:</strong> {{ $chalet->air_conditioners }}</p>
            <p><strong>Parking Spaces:</strong> {{ $chalet->parking_spaces }}</p>
        </div>

        <!-- Image Section -->
        <!-- <div class="form-section text-center">
            <h3 class="section-title">Chalet Image</h3>
            @if($chalet->image)
                <img src="{{ asset('storage/' . $chalet->image) }}" alt="Chalet Image" class="preview-image mt-3">
            @else
                <p>No image available</p>
            @endif
        </div> -->

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('Owner.index') }}" class="btn btn-dark px-4 py-2">Back to List</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
