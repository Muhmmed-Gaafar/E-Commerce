<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Blog extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'image',
    ];
    protected $table='blogs';
    public array $translatedAttributes = ['title', 'description'];
    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

    public function translate($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}


