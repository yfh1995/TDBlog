<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/25
 * Time: 15:41
 */

namespace App\Util;


class Tool {

    public static function apiOutput($code, $data){

        header('Content-type:text/json;charset=utf-8');

        $return['code'] = $code;
        $return['msg'] = Codes::$MSG[$code];
        $return['data'] = $data;
        echo json_encode($return);
    }

    /**
     * 生成盐值映射表
     */
    public static function generateMap(){
        $str = 'zxcvbnmasdfghjklqwertyuiop1234567890!@#$%^&*()';
        $str = str_shuffle($str);

        $array = [];
        $len = strlen($str);
        for($i=0;$i<$len;$i++){
            $array[$str[$i]] = [];
        }

        for($i=0;$i<$len;$i++){
            $cnt = 0;
            $ls = str_shuffle($str);
            for($j=0;$j<$len;$j++){
                if($ls[$j]!=$str[$i] && !in_array($str[$i],$array[$ls[$j]])){
                    $array[$str[$i]][] = '\''.$ls[$j].'\'';
                    if(++$cnt == 10) break;
                }
            }
        }

        $string = '[';
        foreach ($array as $k=>$one){
            $string .= '\''.$k.'\'=>['.implode(',',$one).'],';
        }
        $string = substr($string, 0, -1);
        $string .= ']';

        dd($string);
    }

}