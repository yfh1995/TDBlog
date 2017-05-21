<?php

namespace App;


class CommonTools{

    /**
     * 获取数组最深维度数
     * @param $array
     * @return int
     */
    private static function array_depth($array) {
        if(!is_array($array)) return 0;
        $max_depth = 1;
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = CommonTools::array_depth($value) + 1;
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
    public static function object_to_array($object){
        return json_decode(json_encode($object),true);
    }
}