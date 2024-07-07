<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasImage;
class Banner extends Model {
    use HasFactory, HasImage;
    protected $table = 'banners';
    protected $fillable = [
        'name',
        'notes',
        'status',
    ];
    
    public function statusWithLabel() {
        switch ($this->status) {
            case 0: $result = '<label class="badge badge-warning">غير فعال</label>'; break;
            case 1: $result = '<label class="badge badge-success">مفعل</label>'; break;
        }
        return $result;
    }

    public function scopeActive($query) {
        return $query->whereStatus(true) ;
    }
}
