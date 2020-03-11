<?php

namespace App\Models;

use App\Loader\ConfigLoader;
use App\Loader\DatabaseLoader;

class Model
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}