<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,UsesUuid,SoftDeletes;
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'admin_reply',
        'status',
    ];
    protected $casts = [
        'status' => 'string',
        'deleted_at' => 'datetime',
    ];
}
