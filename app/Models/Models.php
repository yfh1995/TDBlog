<?php

namespace App\Models;

use App\CommonTools;
use Illuminate\Database\Eloquent\Model;

/**
 * 所有模型操作不会判断数据正确性
 * Class Models
 * @package App\Models
 */
class Models extends Model{

    protected $tools;

    public function __contruction(){
        $this->tools = new CommonTools();
    }
}
