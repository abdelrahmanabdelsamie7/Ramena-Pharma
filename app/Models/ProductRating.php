<?php
namespace App\Models;
use App\Models\Product;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRating extends Model
{
    use HasFactory, UsesUuid;
    protected $fillable = ['product_id', 'name', 'email', 'stars', 'review', 'ip_address'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
