<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = "post";
    //protected $timestamp = true; false->disable auto fill-in created_at and updated_at field
    protected $fillable = ['title', 'slug', 'comment'];//insert table field that are fillable
}