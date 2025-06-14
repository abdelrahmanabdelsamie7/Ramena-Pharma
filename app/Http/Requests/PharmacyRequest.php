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
        $pharmacyId = $this->route('id') ?? $this->route('pharmacy');
        return [
            'title' => 'required|string|max:255|unique:pharmacies,title,' . $pharmacyId,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location_name' => 'required|string|max:500',
            'address' => 'required|string|max:500',
            'phone_number' => 'required|string|regex:/^01[0125][0-9]{8}$/',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }
}