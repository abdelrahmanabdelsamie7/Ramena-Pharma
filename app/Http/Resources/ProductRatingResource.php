<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductRatingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'name' => $this->name,
            'email' => $this->email,
            'stars' => $this->stars,
            'review' => $this->review,
            'ip_address' => $this->ip_address,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}