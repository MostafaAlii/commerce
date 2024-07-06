<?php
namespace App\Models\Traits;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\{MorphMany,MorphOne};
trait HasImage {
    public static function bootHasImage() {
        static::deleting(function ($model) {
            $model->deleteImage();
        });
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable')->whereType(Image::MAIN_TYPE);
    }
    
    public function gallary(): MorphMany {
        return $this->morphMany(Image::class, 'imageable')->whereType(Image::GALLERY_TYPE);
    }

    public function storeImage($filename, $type = Image::MAIN_TYPE) {
        $image = $this->image()->create([
            'filename' => pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION),
            'type' => $type,
        ]);
        return $image;
    }

    public function updateImage($filename) {
        if ($this->image) 
            $this->image->delete();
        $this->storeImage($filename);
    }

    public function deleteImage() {
        if ($this->image) 
            $this->image->delete();
            
        if ($this->gallary) {
            $this->gallary->each(function (Image $image) {
                $image->delete();
            });
        }
    }

    public function ImagePath() {
        $image = $this->image;
        $imageType = strtolower(class_basename($this));
        if (!$image)
            return asset("dashboard/img/default/default_{$imageType}.jpg");
        return asset("dashboard/img/{$imageType}/" . $image->filename);
    }

    public function GallaryPath() {
        $images = $this->gallary;
        $imageType = strtolower(class_basename($this));
        return $this->getImagePaths($images, $imageType);
    }

    private function getImagePaths($images, $imageType) {
        if (!$images || $images->isEmpty()) 
            return [asset("dashboard/img/default/default_{$imageType}.jpg")];

        return $images->map(function ($image) use ($imageType) {
            return asset("dashboard/img/{$imageType}/" . $image->filename);
        })->toArray();
    }
}