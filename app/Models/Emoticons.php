<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 13:54
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Emoticons extends Models {

    public $table = 'admin_emoticons';

    public function add($data){

        //添加表情信息
        $this->group_id = $data['group_id'];
        $this->name = $data['name'];
        $this->file_id = $data['file_id'];
        $this->icon = $data['icon'];
        $this->uri = $data['uri'];
        $res_ae = $this->save();

        if($res_ae) return $this->id;
        else return false;
    }

    public function edit($data){

        //编辑表情信息
        $emoticon = $this::find($data['id']);
        $emoticon->group_id = $data['group_id'];
        $emoticon->name = $data['name'];
        $emoticon->file_id = $data['file_id'];
        $emoticon->icon = $data['icon'];
        $emoticon->uri = $data['uri'];
        $res_ae = $this->save();

        if($res_ae) return $this->id;
        else return false;
    }

    /**
     * 删除表情
     * @param $data
     * @return bool
     */
    public function dele($data){
        DB::beginTransaction();

        //获取文件id数组
        $ids = Emoticons::whereIn('id',$data)->pluck('file_id');
        //自减文件拥有者数量
        $rs = Files::whereIn('id',$ids)->decrement('owner_num');
        if($rs != count($ids)){
            DB::rollback();
            return false;
        }

        //删除表情数据
        $rs = $this->destroy($data);
        if($rs != count($data)){
            DB::rollback();
            return false;
        }

        //删除owner_num小于等于0的数据及文件
        $rs = Files::deleteInvalidFileData($ids);
        if(!$rs){
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }

}