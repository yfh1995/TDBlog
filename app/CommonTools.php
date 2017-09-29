<?php

namespace App;


use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CommonTools{

    /**
     * 获取数组最深维度数
     * @param $array
     * @return int
     */
    public static function arrayDepth($array) {
        if(!is_array($array)) return 0;
        $max_depth = 1;
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = CommonTools::arrayDepth($value) + 1;
                if ($depth > $max_depth) $max_depth = $depth;
            }
        }
        return $max_depth;
    }

    /**
     * 对象转数组
     * @param $object
     * @return mixed
     */
    public static function objectToArray($object){
        return json_decode(json_encode($object),true);
    }

    /**
     * 获取两个数组的交集数组
     * @param array $a
     * @param array $b
     * @return array
     */
    public static function getIntersectionInTwoArray($a = [], $b = []){
        return array_uintersect($a,$b,"arrayCompare");
    }

    /**
     * array_uintersect比较标准
     * @param $a
     * @param $b
     * @return int
     */
    private static function arrayCompare($a,$b){
        if($a == $b) return 0;
        return $a > $b ? 1:-1;
    }

    /**
     * 获取多语言句子
     * @param $word
     * @return string
     */
    public static function multilingual($word){
        return Lang::has($word) ? Lang::get($word) : '未查询到此翻译';
    }
}