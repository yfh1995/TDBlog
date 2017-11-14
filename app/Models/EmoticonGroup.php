<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/29
 * Time: 15:21
 */

namespace App\Models;


use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmoticonGroup extends Model {

    public $table = TablesName::ADMIN_EMOTICON_GROUP;

    public function add($data){

        //创建表情包组
        $this->name = $data['name'];
        $this->owner_id = $data['owner_id'];
        $rs = $this->save();

        if($rs) return $this->id;
        else return false;

    }

    public function edit($data){

        //编辑表情包组
        $group = EmoticonGroup::find($data['id']);
        $group->name = $data['name'];
        $rs = $group->save();

        if($rs) return $group->id;
        else return false;

    }

    /**
     * 排序（请在调用时启用事务，以保证数据一致性）
     * @param $data
     * @return bool
     */
    public function sort($data){
        if(!$data) return true;

        $js = 0;
        $sql = 'update admin_emoticons_group set sort ';
        foreach ($data as $v){
            $sql .= ' when '.$v.' then '.(++$js);
        }
        $sql .= ' end';

        $rs = DB::update($sql);
        if($rs != count($data)) return false;
        else return true;
    }

}