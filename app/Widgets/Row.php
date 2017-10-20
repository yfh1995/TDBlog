<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/20
 * Time: 15:44
 */

namespace App\Widgets;


class Row {

    //字段正序排列
    const SORT_RULE_ACS = 0;
    //字段逆序排列
    const SORT_RULE_DECS = 1;
    //字段原生排列
    const SORT_RULE_ORIGINAL = 2;

    //字段显示方式-text
    const FIELD_SHOW_TYPE_TEXT = 0;
    //字段显示方式-label
    const FIELD_SHOW_TYPE_LABEL = 1;

    public $fieldName;              //字段名
    public $showName;           //显示名
    public $isSort;             //是否排序
    public $sortRule;           //排序规则
    public $fieldShowType;      //字段显示类型

    public function __construct($fieldName, $showName){
        $this->fieldName = $fieldName;
        $this->showName = $showName;
        $this->isSort = Grid::CLOSE;
        $this->sortRule = $this::SORT_RULE_ORIGINAL;
        $this->fieldShowType = $this::FIELD_SHOW_TYPE_TEXT;
    }

    /**
     * 启用字段排序
     * @param int $sortRule     首选排序方式
     * @return $this
     */
    public function sort($sortRule = Row::SORT_RULE_ORIGINAL){
        $this->isSort = Grid::OPEN;
        $this->sortRule = $sortRule;
        return $this;
    }

    /**
     * 设置字段显示方式
     * @param int $fieldShowType    首选文本显示
     * @return $this
     */
    public function fieldShowType($fieldShowType = Row::FIELD_SHOW_TYPE_TEXT){
        $this->fieldShowType = $fieldShowType;
        return $this;
    }

    public function render(){
        return [
            'fieldName'     =>  $this->fieldName,
            'showName'      =>  $this->showName,
            'isSort'        =>  $this->isSort,
            'sortRule'      =>  $this->sortRule,
            'fieldShowType' =>  $this->fieldShowType,
        ];
    }
}