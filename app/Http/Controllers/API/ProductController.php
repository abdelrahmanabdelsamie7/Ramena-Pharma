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
        $product->update($data);
        return $this->sendSuccess('Product Data Updated Successfully', $product, 200);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deletefile($product->image);
        $product->delete();
        return $this->sendSuccess('Product Deleted Successfully');
    }
}
