<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'thumbnail'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function preview_images(): HasMany
    {
        return $this->hasMany(PreviewImage::class);
    }
}
