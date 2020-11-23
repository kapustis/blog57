<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string slug
 * @property string title
 * @property string description
 * @property int parent_id
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    protected  $fillable = ['parent_id','title','slug','description'];
}
