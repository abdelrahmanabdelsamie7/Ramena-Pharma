<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PharmacyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:4048',
            'location_name' => 'required|string|max:500',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|regex:/^01[0125][0-9]{8}$/',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }
}