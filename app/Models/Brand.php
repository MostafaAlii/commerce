<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Brand extends Model {
    use HasFactory;
    protected $fillable = ['is_active','name'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function getActive(){
        return  $this->is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function status() {
        return $this->is_active ? 'مفعل'   : 'غير مفعل' ;
    }
}
