<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'pharmacies';
    protected $fillable = ['title', 'logo', 'location_name', 'address', 'phone_number', 'latitude', 'longitude'];
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'pharmacy_product', 'pharmacy_id', 'product_id')->withPivot('id');
    // }
}
