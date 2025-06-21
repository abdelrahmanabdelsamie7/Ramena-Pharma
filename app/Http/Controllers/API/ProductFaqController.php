<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\ProductFaqRequest;
use App\Models\ProductFaq;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class ProductFaqController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function store(ProductFaqRequest $request)
    {
        $product_faq = ProductFaq::create($request->validated());
        return $this->sendSuccess('Product Faq Added Successfully', $product_faq, 201);
    }
    public function update(ProductFaqRequest $request, string $id)
    {
        $product_faq = ProductFaq::findOrFail($id);
        $product_faq->update($request->validated());
        return $this->sendSuccess('Product Faq Updated Successfully', $product_faq, 201);
    }
    public function destroy($id)
    {
        $product_faq = ProductFaq::findOrFail($id);
        $product_faq->delete();
        return $this->sendSuccess('Product Faq Deleted Successfully');
    }
}