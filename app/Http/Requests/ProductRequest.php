<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $productId = $this->route('id') ?? $this->route('product');
        return [
            'title' => 'required|string|max:255|unique:products,title,' . $productId,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_ar' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:10240',
            'video_en' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:10240',
        ];
    }
}