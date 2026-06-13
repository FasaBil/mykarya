<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'description', 'deadline', 'poster'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}