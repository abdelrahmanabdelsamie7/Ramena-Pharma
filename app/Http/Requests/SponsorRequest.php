<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class SponsorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $sponsorId = $this->route('id') ?? $this->route('sponsor');
        return [
            'title' => 'required|string|max:255|unique:sponsors,title,' . $sponsorId,
            'description' => 'nullable|string',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:4048',
            'website_url' => 'nullable|url',
        ];
    }
}
