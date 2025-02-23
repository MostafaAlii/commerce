<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasImage;
class Category extends Model {
    use HasFactory, HasImage;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id'
    ];
    public function status() {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function scopeActive($query) {
        return $query->whereStatus(true) ;
    }

    public function parent() {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function appearedChildren() {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', true);
    }

    public static function tree( $level = 1 ) {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
