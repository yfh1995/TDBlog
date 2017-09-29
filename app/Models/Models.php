<?php

namespace App\Models;

use App\CommonTools;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Models
 * @package App\Models
 */
class Models extends Model{

    protected $tools;

    public function __contruction(){
        $this->tools = new CommonTools();
    }
}
