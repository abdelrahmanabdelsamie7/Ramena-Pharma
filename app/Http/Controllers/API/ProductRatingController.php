<?php
namespace App\Http\Controllers\API;
use App\Models\ProductRating;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\ProductRatingResource;

class ProductRatingController extends Controller
{
    use ResponseJsonTrait;
    protected function __construct()
    {
        $this->middleware('auth:admins')->except(['index', 'show', 'destroy']);
    }
    public function index()
    {
        $product_ratings = ProductRating::all();
        return $this->sendSuccess(
            'All Ratings Retrieved Successfully!',
            ProductRatingResource::collection($product_ratings)
        );
    }
    public function show($id)
    {
        $rating = ProductRating::wit('product')->findOrFail($id);
        return $this->sendSuccess(
            'Rating Of Product Retrieved Successfully!',
            new ProductRatingResource($rating)
        );
    }
    public function store(RatingRequest $request)
    {
        $exists = ProductRating::where('product_id', $request->product_id)
            ->where('email', $request->email)
            ->where('ip_address', $request->ip())
            ->exists();
        if ($exists) {
            return $this->sendError('You have already rated this product', 409);
        }
        $rating = ProductRating::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'stars' => $request->stars,
            'review' => $request->review,
            'ip_address' => $request->ip(),
        ]);
        return $this->sendSuccess('Rating submitted successfully', new ProductRatingResource($rating));
    }
    public function destroy($id)
    {
        $rating = ProductRating::findOrFail($id);
        $rating->delete();
        return $this->sendSuccess('Rating deleted successfully.');
    }
}
