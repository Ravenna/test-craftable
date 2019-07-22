<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Building extends Model implements HasMediaCollections, HasMediaConversions 
{
    
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    
    protected $fillable = [
        "name",
        "description",
        "address",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/buildings/'.$this->getKey());
    }


    public function registerMediaCollections()
    {
        $this->addMediaCollection('gallery')
            ->maxNumberofFiles(10);

        $this->addMediaCollection('featured')
            ->maxNumberofFiles(1);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('detail_hd')
            ->width(1920)
            ->height(1080)
            ->performOnCollections('gallery');

        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(400)
            ->performOnCollections('featured');
    }

    
}
