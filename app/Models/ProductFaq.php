<?php
namespace App\Models;
use App\traits\{UsesUuid,HasSlug};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    use HasFactory, UsesUuid, HasSlug;
    protected $table = 'product_faqs';
    protected $fillable = ['question', 'answer', 'product_id'];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}