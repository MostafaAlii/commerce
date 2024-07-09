<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,BelongsToMany,HasMany,MorphMany,MorphOne,MorphToMany};
use App\Models\Traits\HasImage;
class Product extends Model {
    use HasFactory, HasImage;
    protected $guarded = [];

    public function status() {
        return $this->status ? 'فعال' : 'غير فعال';
    }

    public function featured() {
        return $this->featured ? 'نعم' : 'لا';
    }

    public function scopeFeatured($query) {
        return $query->whereFeatured(true);
    }

    public function scopeActive($query) {
        return $query->whereStatus(true);
    }

    public function scopeHasQuantity($query) {
        return $query->where('quantity', '>', 0);
    }

    public function scopeActiveCategory($query) {
        return $query->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
    }

    public function category(): belongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}