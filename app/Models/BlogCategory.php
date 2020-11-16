<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @method create(array|string|null $data)
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    protected  $fillable = ['parent_id','title','slug','description'];
}
