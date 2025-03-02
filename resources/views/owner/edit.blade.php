<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Chalet - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #f7941d;
            --secondary-color: #336699;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .welcome-header {
            text-align: center;
            margin: 20px 0;
        }

        .welcome-header h1 {
            font-size: 32px;
            color: var(--dark-color);
        }

        .welcome-header span {
            color: var(--primary-color);
            font-weight: bold;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .form-title {
            color: var(--secondary-color);
            font-size: 24px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .form-section {
            background-color: var(--light-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--dark-color);
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(247, 148, 29, 0.25);
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background-color: #e6850c;
            transform: translateY(-2px);
        }

        .back-btn {
            background-color: var(--dark-color);
            color: white;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background-color: #1a2530;
        }

        .image-upload-container {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            border-radius: 6px;
            background-color: #f9f9f9;
            transition: all 0.3s;
        }

        .image-upload-container:hover {
            border-color: var(--primary-color);
        }

        .preview-image {
            max-width: 100%;
            height: auto;
            margin-top: 15px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-5">
        <div class="welcome-header">
            <h1>Edit Chalet - <span>CHALETS</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Edit Chalet</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('Owner.update', $chalet->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- بقية الفورم -->

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Chalet Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $chalet->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_per_day">Price per Day ($):</label>
                                <input type="number" name="price_per_day" id="price_per_day" class="form-control" value="{{ $chalet->price_per_day }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $chalet->address }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Discount (%):</label>
                                <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" max="100" value="{{ $chalet->discount }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $chalet->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="available" {{ $chalet->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="not available" {{ $chalet->status == 'not available' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Area (m²):</label>
                                <input type="number" name="area" id="area" class="form-control" value="{{ $chalet->area }}" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="form-section">
                    <h3 class="section-title">Chalet Features</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bedrooms">Bedrooms:</label>
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ $chalet->bedrooms }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bathrooms">Bathrooms:</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ $chalet->bathrooms }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="air_conditioners">Air Conditioners:</label>
                                <input type="number" name="air_conditioners" id="air_conditioners" class="form-control" value="{{ $chalet->air_conditioners }}" min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parking_spaces">Parking Spaces:</label>
                                <input type="number" name="parking_spaces" id="parking_spaces" class="form-control" value="{{ $chalet->parking_spaces }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amenities">Amenities:</label>
                                <textarea name="amenities" id="amenities" class="form-control" rows="3">{{ $chalet->amenities }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                            <div class="form-group">
                                <label for="view">view</label>
                                <input type="text" name="view" id="view" class="form-control" value="{{ $chalet->view }}" required>
                            </div>
                        </div>

                <!-- Image Upload Section -->
                <div class="form-section">
                    <h3 class="section-title">Chalet Image</h3>
                    <div class="image-upload-container">
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if($chalet->image)
                            <img src="{{ asset('storage/' . $chalet->image) }}" alt="Chalet Image" class="preview-image mt-3">
                        @endif
                    </div>
                </div>



                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="submit-btn">Save Changes</button>
                    <a href="{{ route('Owner.index') }}" class="back-btn ml-3">Back to List</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
