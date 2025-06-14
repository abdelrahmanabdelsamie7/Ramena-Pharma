<?php
namespace App\Models;
use App\traits\{HasSlug, UsesUuid};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory, UsesUuid, HasSlug;
    protected $table = 'sponsors';
    protected $fillable = ['title', 'slug', 'description', 'logo', 'website_url'];
    public function getSlugSource()
    {
        return 'title';
    }
}
