-- resources/views/yourpage.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .submit-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
    }
    .image-upload-container {
        border: 2px dashed #007bff;
        background-color: #f9f9f9; 
        padding: 30px;
        text-align: center;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .image-upload-container:hover {
        background-color: #e9f7fe; 
    }

    .image-upload-container label {
        display: inline-block;
        color: #007bff;
        font-size: 18px;
        cursor: pointer;
        font-weight: bold;
    }

    .image-upload-container p {
        margin-top: 10px;
        color: #555;
    }

    .image-upload-container .bi-cloud-arrow-up {
        font-size: 40px;
        color: #007bff;
    }

    .image-upload-container p.text-muted {
        font-size: 14px;
    }

    .preview-image {
        width: 100%;
        height: auto;
        border-radius: 8px;
        border: 2px solid #ddd;
        transition: transform 0.3s ease;
    }

    .preview-image:hover {
        transform: scale(1.05); 
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">CHALETS</a>
        </div>
    </nav>

    <!-- Include Sidebar -->
    @include('owner.sidebar')  <!-- Include Sidebar here -->

    <!-- Main Content -->
    <div class="main-content" id="main-content">

    <div class="container mt-5 mb-5">
    

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

                <div class="d-flex justify-content-center mt-4">
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

</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            mainContent.style.marginLeft = '250px';
        } else {
            mainContent.style.marginLeft = '0';
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>