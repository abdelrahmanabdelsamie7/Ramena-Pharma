<?php
namespace App\Http\Controllers\API;
use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class PharmacyProductController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'destroy']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'product_id' => 'required|exists:products,id',
        ]);
        $pharmacy = Pharmacy::findOrFail($request->pharmacy_id);
        if (!$pharmacy->products()->where('product_id', $request->product_id)->exists()) {
            $pharmacy->products()->attach($request->product_id);
            return $this->sendSuccess(
                'Product added to pharmacy successfully.',
                ['pharmacy' => $pharmacy->load('products')]
            );
        }
        return $this->sendError('Product already exists in this pharmacy', 400);
    }
    public function destroy(string $pharmacyId, string $productId)
    {
        $pharmacy = Pharmacy::findOrFail($pharmacyId);
        if ($pharmacy->products()->where('product_id', $productId)->exists()) {
            $pharmacy->products()->detach($productId);
            return $this->sendSuccess(
                'Product removed from pharmacy successfully.',
                []
            );
        }
        return $this->sendError('Product does not exist in this pharmacy', 404);
    }
}
