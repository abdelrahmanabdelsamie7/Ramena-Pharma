<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'video_ar' => $this->video_ar,
            'video_en' => $this->video_en,
            'average_rating' => round($this->averageRating() ?? 0, 1),
            'ratings_count' => $this->ratings()->count(),
            'faqs' => ProductFaqResource::collection($this->whenLoaded('product_faqs')),
            'ratings' => ProductRatingResource::collection($this->whenLoaded('ratings')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}