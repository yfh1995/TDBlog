<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/25
 * Time: 15:41
 */

namespace App\Util;


use Illuminate\Support\Facades\Lang;

class Tool {

    public static function apiOutput($code, $data){

        header('Content-type:text/json;charset=utf-8');

        $return['code'] = $code;
        $return['msg'] = Codes::$MSG[$code];
        $return['data'] = $data;
        echo json_encode($return);
    }

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
                $depth = Tool::arrayDepth($value) + 1;
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

    /**
     * 将数组转换成树形化结构
     * @param array $array          需要树形化的数组
     * @param string $sonKey        子节点需要与父节点关联的字段名
     * @param string $fatherKey     父节点需要与子节点关联的字段名
     * @param string $sonArrayKey   自定义的子树在父节点中的字段名
     * @param integer $start        起始父节点字段值
     * @return array
     */
    public static function convertToTreeStructure($array,$sonKey,$fatherKey,$sonArrayKey,$start){
        if(!is_array($array)) return [];

        $result = [];
        foreach ($array as $v){
            if($v[$sonKey] == $start) {
                if(!empty($sons = Tool::convertToTreeStructure($array,$sonKey,$fatherKey,$sonArrayKey,$v[$fatherKey]))){
                    $v[$sonArrayKey] = $sons;
                }
                $result[] = $v;
            }
        }
        return $result;
    }

    public static function checkSequenceAndVoucher($sequence, $voucher, $email){

        //获取验证合法时长
        $lawfulTime = config('TDBlog.lawfulTime');
        //获取序列码长度
        $seqLen = config('TDConfig.seqLen');
        //获取盐值映射表
        $saltMap = config('TDConfig.saltMap');

        //计算真实盐值
        $str = '';
        for($i=0;$i<$seqLen;$i++){
            $str .= $saltMap[$sequence[$i]][abs(ord($sequence[$i])-ord($sequence[($i+1)%$seqLen]))%$seqLen];
        }

        //在合法尝试次数内，验证凭证
        for($i=0;$i<$lawfulTime;$i++){
            $tryOne = $str . ((int)(time()/10)*10) . $email . config('TDConfig.password');
            if($voucher === bcrypt($tryOne)){
                return true;
            }
        }

        return false;
    }

    /**
     * 生成盐值映射表
     */
    private static function getSaltMap(){
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

    /**
     * 获取登录凭证
     * @return array
     */
    public static function getSequenceAndVoucher(){

        //获取序列码长度
        $seqLen = config('TDConfig.seqLen');
        //获取盐值映射表
        $saltMap = config('TDConfig.saltMap');

        //生成序列码
        $keys = array_keys($saltMap);
        $sequenceIndex = array_rand($keys,$seqLen);

        //获取盐值
        $str = '';
        $sequence = '';
        for($i=0;$i<$seqLen;$i++){
            $sequence .= $keys[$sequenceIndex[$i]];
            $str .= $saltMap[$keys[$sequenceIndex[$i]]][abs(ord($keys[$sequenceIndex[$i]])-ord($keys[$sequenceIndex[($i+1)%$seqLen]]))%$seqLen];
        }

        //获取加密文本（盐值+整10时间戳+站点密码）
        $str .= (int)(time()/10)*10 . config('TDConfig.password');

        //bcrypt加密
        $voucher = bcrypt($str);
        return [
            'sequence'  =>  $sequence,
            'voucher'      =>  $voucher
        ];
    }

}