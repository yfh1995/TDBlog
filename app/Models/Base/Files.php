<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/28
 * Time: 12:05
 */

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Model;

class Files extends Model{

    protected $table = 'base_files';

    public function add($data){
        $this->path = $data['path'];
        $this->name = $data['name'];
        $this->size = $data['size'];
        $this->format = $data['format'];
        $this->md5 = $data['md5'];
        return $this->save()?$this->id:false;
    }

    public function dele($data){
        return  $this->destroy($data);
    }
}