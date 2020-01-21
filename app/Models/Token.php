<?php

namespace App\Models;

use Laravel\Passport\Client as Model;

class Token extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'coredb';
}
