<?php

namespace App\Models;
use App\Models\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Slider extends Model {
    use HasFactory, HasImage;
    protected $table = 'sliders';
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