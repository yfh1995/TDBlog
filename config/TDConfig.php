<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/25
 * Time: 18:38
 */

return [

    'password'  =>  'qmP%9AG(!83+cp@ds',

    //登陆验证合法时长（自passport发凭证 lawfulTime×10 秒内登陆有效）
    'lawfulTime'=>  3,
    //序列码长度（推荐10-20，不能超过46）
    'seqLen'    =>  10,
    //盐值映射表
    'saltMap'   =>  [
    'g'=>['m','v','l','b','f','8','2','^','i','x'],
    '9'=>['e','v','4',')','^','q','x','o','b','m'],
    'f'=>['p','3','b','c','7','w','u','$','t','q'],
    '1'=>['2','@','b','d','j','h','%','i','^','p'],
    '!'=>['s','0','6','4','h','^','(','p','&','u'],
    'u'=>['7','h','%','q','4','8','j','w','6','#'],
    'r'=>[')','s','6','!','n','i','m','(','#','*'],
    'c'=>['7','^','*','0','!','m','i','h','2','w'],
    'p'=>['%','^','$','e','m','!','w','*','6','k'],
    'b'=>['h','g','l','!','9','e','p','3','v','s'],
    'v'=>['7','*','p','9','b','i','@','o','l','n'],
    'k'=>['w','x','n','f','u','^','8','p','o','0'],
    '$'=>['1','!','b','#','y','w','z','^','4','e'],
    '*'=>['&','$','p','8','2','q','y','5','0','4'],
    'd'=>['v','2','6','h','j','c','#','t','^','k'],
    '8'=>['y','5','4','d','0',')','e','m','n','('],
    '&'=>['k','o','j','!',')','e','v','6','4','7'],
    '@'=>[')','i','4','3','g','f','5','a','%','p'],
    '3'=>['b','k','s','j','1','^','4','!','@','0'],
    '^'=>['#','y','h','t','e','@','6','5','a','%'],
    's'=>['9','5','%','z','k','l','0','d','4','i'],
    'z'=>['2','h','c','i','q','r','u','x','s','f'],
    'q'=>['&','%','v','9','d','3','4','w',')','t'],
    'm'=>['$','1','@','e','2','q','#','^','*','f'],
    'l'=>['v','(','1','k','5','r','&','8','x','t'],
    'a'=>['g','d','2','3','&','@','p','*','s','f'],
    'n'=>['*','%','g','r','z','5','y','c','p','t'],
    'e'=>['#','2','3','7','p','$','u','9','!','i'],
    '('=>['e','&','r','q','1','7','l','!','8','x'],
    '#'=>['2','a','z','1','d','k','v','6','9','&'],
    '7'=>['4','j','$','!','e','o','0','z','1','a'],
    'i'=>['q','s','l','@','$','3','d','2','!','6'],
    'y'=>['5','e','v','o','2','b','f','&','u','s'],
    'j'=>['z','^','v','a','5','!','$','4','&','w'],
    '5'=>['d','7','x','z','3','r','b','y','j','9'],
    '2'=>['3','^','t','b','%','5','6','f','g','y'],
    '6'=>['^','l','h','@','k','g','#','8','j','w'],
    '4'=>['o','5','l','x','@','j','0','3','e','v'],
    '0'=>['7','f','1','c','4','r','2','a','h','*'],
    ')'=>['t','u','p','e','4','d','r','g','x','%'],
    't'=>['e','@','u','b','h','3','q','*','#','6'],
    'o'=>['7','r','l','@','!','1','m','8','6','k'],
    'w'=>['i','c','%','y','@','b','t','3','a','$'],
    'h'=>['$','n','4','f','^','v','0','@','9','w'],
    'x'=>['j','l','p','z','4','6','f','*','o','d'],
    '%'=>['n','a','x','j','9','w','(','f','^','p']
],
];