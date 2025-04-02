<?php

// app/Http/Controllers/Admin/BookingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Chalet;
use App\Models\User;
use Illuminate\Http\Request;
class BookingController extends Controller
{
    // Display a list of all bookings
    public function index(Request $request)
    {
        $users = User::all(); // جلب جميع المستخدمين
        $chalets = Chalet::all(); // جلب جميع الشاليهات
    
        $bookings = Booking::query()
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('chalet', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->when($request->has('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->with(['user', 'chalet'])
            ->latest()
            ->paginate(10);
    
        return view('admin.bookings.index', compact('bookings', 'users', 'chalets'));
    }
    

    // Show the form for editing a booking
    public function edit(Booking $booking)
    {
        
        return view('admin.bookings.edit', compact('booking'));
    }

    // Update the booking status
   
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,canceled',
        ]);
    
        $booking->update(['status' => $request->input('status')]);
        if (in_array($request->input('status'), ['confirmed', 'canceled'])) {
            $this->sendBookingStatusNotification($booking);
        }
        return redirect()->route('admin.bookings.index')->with('success', 'Booking status updated successfully!');
    }
    
    // Delete a booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    // Helper method to send notifications
    protected function sendBookingStatusNotification(Booking $booking)
    {
        $user = $booking->user;
        $status = $booking->status;
    
        // إرسال إشعار إلى المستخدم
        $user->notify(new BookingStatusUpdated($status));
    }
    
}