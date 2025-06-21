<?php
namespace App\Models;
use App\Models\{ProductFaq, Pharmacy,ProductRating};
use App\traits\{HasSlug, UsesUuid};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, UsesUuid, HasSlug;
    protected $table = 'products';
    protected $fillable = ['title', 'slug', 'description', 'image', 'price', 'video_ar', 'video_en'];
    public function getSlugSource()
    {
        return 'title';
    }
    public function product_faqs()
    {
        return $this->hasMany(ProductFaq::class, 'product_id');
    }
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'pharmacy_product', 'product_id', 'pharmacy_id')->withPivot('id');
    }
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
    public function averageRating()
    {
        return $this->ratings()->avg('stars');
    }
}
