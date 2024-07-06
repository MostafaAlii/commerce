<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Image extends Model {
    use HasFactory;
    protected $table = 'images';
    const MAIN_TYPE = 'main';
    const GALLERY_TYPE = 'gallery';
    protected $fillable =['filename','imageable_id','imageable_type', 'type'];

    public function imageable() {
        return $this->morphTo();
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function ($image){
            if(static::whereFilename($image->filename)->exists()) {
                $modelName = strtolower(class_basename($image->imageable_type));
                $file = $modelName . DIRECTORY_SEPARATOR . $image->filename;
                Storage::disk('upload_image')->delete($file);
            }
        }); 
    }
}
