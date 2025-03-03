<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Chalet - CHALETS</title>
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
@include('component.header')
    <div class="container mt-4 mb-5">
        <div class="welcome-header">
            <h1>Welcome to Our <span>CHALETS</span></h1>
        </div>

        <div class="form-container">
            <h2 class="form-title">Add New Chalet</h2>

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

            <form action="{{ route('Owner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Chalet Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_per_day">Price per Day ($):</label>
                                <input type="number" name="price_per_day" id="price_per_day" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Discount (%):</label>
                                <input type="number" name="discount" id="discount" class="form-control" step="0.01" min="0" max="100" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="available">Available</option>
                                    <option value="not available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Area (m²):</label>
                                <input type="number" name="area" id="area" class="form-control" min="0">
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
                                <input type="number" name="bedrooms" id="bedrooms" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bathrooms">Bathrooms:</label>
                                <input type="number" name="bathrooms" id="bathrooms" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="air_conditioners">Air Conditioners:</label>
                                <input type="number" name="air_conditioners" id="air_conditioners" class="form-control" min="0" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parking_spaces">Parking Spaces:</label>
                                <input type="number" name="parking_spaces" id="parking_spaces" class="form-control" min="0" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wifi">WiFi:</label>
                                <select name="wifi" id="wifi" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pool">Swimming Pool:</label>
                                <select name="pool" id="pool" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="barbecue">Barbecue Area:</label>
                                <select name="barbecue" id="barbecue" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kitchen">Kitchen:</label>
                                <select name="kitchen" id="kitchen" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kids_play_area">Kids Play Area:</label>
                                <select name="kids_play_area" id="kids_play_area" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pets_allowed">Pets Allowed:</label>
                                <select name="pets_allowed" id="pets_allowed" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="view">View:</label>
                                <select name="view" id="view" class="form-control">
                                    <option value="sea">Sea</option>
                                    <option value="mountain">Mountain</option>
                                    <option value="city">City</option>
                                    <option value="none">None</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images Section -->
                <div class="form-section">
                    <h3 class="section-title">Chalet Images</h3>
                    
                    <div class="form-group">
                        <div class="image-upload-container">
                            <label for="images">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#aaa" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                    </svg>
                                </div>
                                <p>Drag images here or click to upload</p>
                                <p class="text-muted">Add multiple photos to showcase your chalet</p>
                            </label>
                            <input type="file" name="images[]" id="images" class="form-control-file d-none" multiple required>
                        </div>
                        <div id="image-preview" class="mt-3 row"></div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('Owner.index') }}" class="back-btn">Back to List</a>
                    <button type="submit" class="submit-btn">Add Chalet</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview images before upload
        document.getElementById('images').addEventListener('change', function(event) {
            var preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            for (var i = 0; i < event.target.files.length; i++) {
                var file = event.target.files[i];
                if (!file.type.match('image.*')) continue;
                
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        var col = document.createElement('div');
                        col.className = 'col-md-3 mb-3';
                        
                        var img = document.createElement('img');
                        img.className = 'preview-image img-fluid';
                        img.src = e.target.result;
                        img.title = theFile.name;
                        
                        col.appendChild(img);
                        preview.appendChild(col);
                    };
                })(file);
                
                reader.readAsDataURL(file);
            }
        });

        // Make the entire upload container clickable
        document.querySelector('.image-upload-container').addEventListener('click', function() {
            document.getElementById('images').click();
        });
    </script>
</body>
</html>