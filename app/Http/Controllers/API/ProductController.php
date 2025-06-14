<?php
namespace App\Http\Controllers\API;
use App\Models\Product;
use App\Traits\{ResponseJsonTrait,UploadFileTrait};
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    use ResponseJsonTrait, UploadFileTrait;
    public function index()
    {
        $products = Product::all();
        return $this->sendSuccess('All Products Retrieved Successfully!',  $products);
    }
    public function show(string $id)
    {
        $product = Product::with('product_faqs')->findOrFail($id);
        return $this->sendSuccess('Product Retrieved Successfully!', $product);
    }
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadfile($request->file('image'), 'products');
        }
        if ($request->hasFile('video_ar')) {
            $data['video_ar'] = $this->uploadfile($request->file('video_ar'), 'products/videos/ar');
        }
        if ($request->hasFile('video_en')) {
            $data['video_en'] = $this->uploadfile($request->file('video_en'), 'products/videos/en');
        }
        $product = Product::create($data);
        return $this->sendSuccess('Product Added Successfully', $product, 201);
    }
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deletefile($product->image);
            $data['image'] = $this->uploadfile($request->file('image'), 'products');
        }

        if ($request->hasFile('video_ar')) {
            $this->deletefile($product->video_ar);
            $data['video_ar'] = $this->uploadfile($request->file('video_ar'), 'products/videos/ar');
        }

        if ($request->hasFile('video_en')) {
            $this->deletefile($product->video_en);
            $data['video_en'] = $this->uploadfile($request->file('video_en'), 'products/videos/en');
        }

        $product->update($data);
        return $this->sendSuccess('Product Data Updated Successfully', $product, 200);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deletefile($product->image);
        $this->deletefile($product->video_ar);
        $this->deletefile($product->video_en);
        $product->delete();
        return $this->sendSuccess('Product Deleted Successfully');
    }
}
