<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/12
 * Time: 17:02
 */

namespace App\Widgets;


use Illuminate\Support\Facades\DB;

class Grid {

    //统一开关定义
    const CLOSE = 0;
    const OPEN = 1;

    // 操作列列名
    const OPERATION = 'widgets.operation';

    // url排序参数，字段间分割字符
    const SORT_FIELD_DIVISION_CHAR = '|';
    // url排序参数，字段名与排序规则分割字符
    const SORT_RULE_DIVISION_CHAR = ':';


    // 操作列列名
    public $operation;
    // 操作列编辑开关
    public $editBtn;
    // 操作列删除开关
    public $deleteBtn;
    // 表头批量删除开关
    public $batchDeleteBtn;
    // 表头新增开关
    public $addBtn;
    // 表头刷新开关
    public $refreshBtn;

    // 搜索地址
    public $searchUrl;
    // 刷新地址
    public $refreshUrl;
    // 删除地址
    public $deleteUrl;
    // 新增地址
    public $addUrl;
    // 编辑地址
    public $editUrl;

    // 搜索表名
    public $table;
    // 排序规则
    public $order;
    // 搜索参数
    public $params;
    // 输入框提示
    public $placeholder;
    // 表头数组
    public $title;
    // 需要显示的字段数组
    public $field;
    // 分页尺寸
    public $pageSize;
    // 默认分页尺寸
    public $defaultPageSize = [10,20,30,50,100];


    /**
     * 初始化默认参数
     * Grid constructor.
     */
    public function __construct($table){

        $this->operation = self::OPERATION;
        $this->editBtn = self::OPEN;
        $this->deleteBtn = self::OPEN;
        $this->batchDeleteBtn = self::OPEN;
        $this->addBtn = self::OPEN;
        $this->refreshBtn = self::OPEN;

        $this->searchUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $this->refreshUrl = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        $this->deleteUrl = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]).'/delete';
        $this->addUrl = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]).'/add';
        $this->editUrl = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]).'/edit';

        $this->table = $table;
        $this->params = [];
        $this->placeholder = 'Id';
        $this->title = [];
        $this->field = [];
        $this->pageSize = $this->defaultPageSize;
    }

    public function initParams($params = []){
        return $this->params = $params;
    }

    public function initPlaceholder($placeholder = ''){
        if($placeholder == ''){
            $this->placeholder = 'Id';
        }else{
            $this->placeholder = $placeholder;
        }
    }

    /**
     * 初始化分页尺寸参数
     * @param array $pageSize
     */
    public function initPageSize($pageSize){
        if(empty($pageSize)){
            $this->pageSize = $this->defaultPageSize;
        }else{
            $this->pageSize = $pageSize;
        }
    }

    /**
     * 初始化列表显示字段信息
     * @param array $rows   \App\Widgets\Row 类数组，定义表列数据
     */
    public function initTitle($rows = []){
        foreach ($rows as $v){
            $this->field[] = $v->fieldName;
            $this->title[] = $v->render();
        }
    }

    /**
     * 将搜索参数嵌入表头
     * @param string $sort
     */
    public function updateTitleParams($sort = ''){
        $sorts = $this->analysisSortString($sort);
        foreach ($this->title as $k=>$v){
            if($v['isSort'] == $this::OPEN && isset($sorts[$v['showName']])){
                $this->title[$k] = $sort[$v['showName']];
            }
        }
    }

    /**
     * 将url中的排序参数转换成数组
     * @param string $str
     * @return array
     */
    public function analysisSortString($str = ''){
        $sorts = [];
        $mid = explode(self::SORT_FIELD_DIVISION_CHAR, $str);
        foreach ($mid as $k=>$v){
            $one = explode(self::SORT_RULE_DIVISION_CHAR, $v);
            if(count($one)!=2) continue;
            $sorts[$one[0]] = $one[1];
        }
        return $sorts;
    }

    /**
     * 将排序字段规则数组转换成url中的排序参数
     * @param array $sorts
     * @return string
     */
    public function formedSortString($sorts = []){
        foreach ($sorts as $k=>$sort){
            $sorts[$k] = implode(self::SORT_RULE_DIVISION_CHAR, $sort);
        }
        return implode(self::SORT_FIELD_DIVISION_CHAR, $sorts);
    }

    /**
     * 返回列表构造参数
     * @return array
     */
    public function render(){

        return [
            'operation'     =>  $this->operation,
            'editBtn'       =>  $this->editBtn,
            'deleteBtn'     =>  $this->deleteBtn,
            'batchDeleteBtn'=>  $this->batchDeleteBtn,
            'addBtn'        =>  $this->addBtn,
            'refreshBtn'    =>  $this->refreshBtn,

            'searchUrl'     =>  $this->searchUrl,
            'refreshUrl'    =>  $this->refreshUrl,
            'deleteUrl'     =>  $this->deleteUrl,
            'addUrl'        =>  $this->addUrl,
            'editUrl'       =>  $this->editUrl,

            'params'        =>  $this->params,
            'placeholder'   =>  $this->placeholder,
            'title'         =>  $this->title,
            'pageSize'      =>  $this->pageSize,
            'data'          =>  $this->data()
        ];
    }

    public function data(){
        $model = DB::table($this->table)
            ->select(DB::raw(implode(',',$this->field)));

        foreach ($this->order as $k=>$v)
            $model->orderBy($k,$v);

        return $model->paginate(isset($this->pageSize[0])?$this->pageSize[0]:$this->defaultPageSize[0]);
    }

}