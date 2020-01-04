<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QRGallery extends Model
{
    protected $table = 'qrcode_gallery';


    protected $fillable = ['title','image'];
}
