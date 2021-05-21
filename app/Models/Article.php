<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;
    use HasFactory;

    protected  $fillable = [ 'title','slug' , 'body'];

//    public function getRouteKeyName(){
//        //کار کند route-model-binding به هر فیلدی که ما می خواهیم تا  id تغییر از
//        return 'slug';
//    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}


