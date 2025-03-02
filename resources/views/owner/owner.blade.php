<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Properties - CHALETS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #f7941d;
            --secondary-color: #336699;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .welcome-header {
            text-align: center;
            margin: 30px 0;
        }
        
        .welcome-header h1 {
            font-size: 32px;
            color: var(--dark-color);
        }
        
        .welcome-header span {
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .chalet-card {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
            position: relative;
        }
        
        .chalet-card:hover {
            transform: translateY(-5px);
        }
        
        .chalet-image {
            height: 220px;
            width: 100%;
            object-fit: cover;
            position: relative;
        }
        
        .price-tag {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .status-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            color: white;
        }
        
        .status-available {
            background-color: var(--success-color);
        }
        
        .status-not-available {
            background-color: var(--danger-color);
        }
        
        .chalet-details {
            padding: 15px;
        }
        
        .chalet-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .chalet-description {
            color: #777;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .btn-view {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }
        
        .btn-action {
            padding: 8px 15px;
            font-weight: 500;
            border-radius: 5px;
        }
        
        .badge-info {
            background-color: var(--secondary-color);
            color: white;
            padding: 3px 8px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 5px;
        }
        
        .booking-item {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 8px;
            border-left: 3px solid var(--secondary-color);
        }
        
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .booking-name {
            font-weight: bold;
            color: var(--dark-color);
        }
        
        .booking-dates {
            display: block;
            margin-top: 3px;
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .booking-email {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .bookings-container {
            max-height: 250px;
            overflow-y: auto;
            margin-top: 15px;
            padding-right: 5px;
        }
        
        .bookings-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-color);
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        
        .no-bookings {
            text-align: center;
            color: #6c757d;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="welcome-header">
            <h1>Welcome to Your <span>CHALETS</span></h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($chalets as $chalet)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="chalet-card">
                    <div class="position-relative">
                        @if ($chalet->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $chalet->images->first()->image) }}" alt="{{ $chalet->name }}" class="chalet-image">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="chalet-image">
                        @endif
                        <div class="price-tag">${{ $chalet->price_per_day }}/day</div>
                        
                        <!-- Status Tag -->
                        <div class="status-tag {{ $chalet->status == 'available' ? 'status-available' : 'status-not-available' }}">
                            {{ ucfirst($chalet->status) }}
                        </div>
                    </div>
                    <div class="chalet-details">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="chalet-title">{{ $chalet->name }}</h5>
                        </div>
                        <p class="chalet-description">
                            <strong>Location:</strong> {{ $chalet->address }}
                        </p>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('Owner.edit', $chalet->id) }}" class="btn btn-view btn-action">EDIT</a>
                            <form action="{{ route('Owner.destroy', $chalet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action btn">DELETE</button>
                            </form>
                        </div>

                        <!-- Improved Bookings Display -->
                        <div class="bookings-container">
                            <h6 class="bookings-title">Bookings Information</h6>
                            @if ($chalet->bookings->count() > 0)
                                @foreach ($chalet->bookings as $booking)
                                    <div class="booking-item">
                                        <div class="booking-header">
                                            <span class="booking-name">{{ $booking->user->name }}</span>
                                        </div>
                                        <span class="booking-email">{{ $booking->user->email }}</span>
                                        <span class="booking-dates">
                                            <i class="bi bi-calendar"></i> 
                                            {{ $booking->start_date }} → {{ $booking->end_date }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-bookings">
                                    No bookings yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('Owner.create') }}" class="btn btn-primary">Add New Property</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>