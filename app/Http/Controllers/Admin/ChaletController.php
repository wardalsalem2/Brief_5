<?php 
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\Chalet; 
use Illuminate\Http\Request; 
use App\Models\User; 

class ChaletController extends Controller 
{
    public function index(Request $request) 
    {
        
        $query = Chalet::select('*')->with('owner');
        

        // البحث بالاسم 
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // التصفية بالحالة (متاح/غير متاح)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // التصفية بالسعر (أقل من أو يساوي)
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // التصفية بالموقع بناءً على قائمة المحافظات
        $validLocations = ['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Mafraq', 'Balqa', 'Madaba', 'Karak', 'Tafilah', 'Maan', 'Aqaba'];
        if ($request->filled('location') && in_array($request->location, $validLocations)) {
            $query->where('address', $request->location);
        }

        // جلب البيانات مع التصفية
        $chalets = $query->latest()->paginate(10);

        return view('admin.chalets.index', [
            'chalets' => $chalets,
            'status' => $request->status,  // تمرير القيمة هنا
        ]);
    }

    public function toggleStatus($id)
    {
        $chalet = Chalet::findOrFail($id);
        $chalet->status = $chalet->status == 'available' ? 'not available' : 'available';
        $chalet->save();
        return redirect()->back()->with('success', 'Chalet status updated successfully.');
    }

    public function destroy($id)
    {
        $chalet = Chalet::findOrFail($id);
        $chalet->delete();
        return redirect()->route('admin.chalets.index')->with('success', 'Chalet deleted successfully.');
    }

    public function create()
    {
        $owners = User::where('role', 'lessor')->get();
        
        return view('admin.chalets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',
            'price_per_day' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:available,not available',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'wifi' => 'boolean',
            'pool' => 'boolean',
            'air_conditioners' => 'integer|min:0',
            'parking_spaces' => 'integer|min:0',
            'area' => 'nullable|integer|min:0',
            'barbecue' => 'boolean',
            'view' => 'required|in:sea,mountain,city,none',
            'kitchen' => 'boolean',
            'kids_play_area' => 'boolean',
            'pets_allowed' => 'boolean',
        ]);

        Chalet::create($request->all());

        return redirect()->route('admin.chalets.index')->with('success', 'Chalet added successfully!');
    }

    public function show(Chalet $chalet)
    {
        return view('admin.chalets.show', compact('chalet', 'status'));
    }

    public function edit(Chalet $chalet)
    {
        $owners = User::where('role', 'lessor')->get();
        return view('admin.chalets.edit', compact('chalet', 'owners'));
    }

    public function update(Request $request, Chalet $chalet)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'status' => 'required|in:available,not available',
            // 'owner_id' => 'required|exists:users,id',
     
        ]);

        // $chalet->name = $request->name;
        // $chalet->address = $request->address;
        // $chalet->price_per_day = $request->price_per_day;
        // $chalet->status = $request->status;
        // // $chalet->owner_id = $request->owner_id;
        // $chalet->save(); // تأكد من أن الحفظ يتم
        
        return redirect()->route('admin.chalets.index')->with('success', 'Chalet updated successfully!');

    }
}