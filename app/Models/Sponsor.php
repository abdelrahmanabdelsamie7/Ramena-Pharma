<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsors';
    protected $fillable = ['title', 'slug', 'description', 'logo', 'website_url'];
    public function getSlugSource()
    {
        return 'title';
    }
}