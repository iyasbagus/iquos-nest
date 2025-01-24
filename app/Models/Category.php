<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'slug', 'description', 'images'];
    public $timestamp = true;

    public function deleteImage(){
        if($this->cover && file_exists(public_path('admin/images/category' . $this->images))){
            return unlink(public_path('admin/images/category' . $this->images));
        }
    }
}
