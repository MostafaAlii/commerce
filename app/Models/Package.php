<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasImage;
class Package extends Model {
    use HasFactory, HasImage;
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
    ];

    public function getActive() {
        return $this->status == false ? 'غير مفعل' : 'مفعل';
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'package_products');
    }

    public function scopeActive($query) {
        return $query->where('status', true);
    }
}
