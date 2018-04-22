<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;

// Eloquent Model to manage all basic config of the application
class Config extends BaseModel
{

    // after the class declaration add this code snippet:
    use HasManyMetaDataTrait;
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configs';
}
