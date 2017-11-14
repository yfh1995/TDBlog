<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/28
 * Time: 12:05
 */

namespace App\Models;


use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Files extends Model{

    protected $table = TablesName::ADMIN_FILES;

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

    /**
     * 多文件上传，返回false或base_files表id数组
     * @param Request $request
     * @return array|bool
     */
    public static function uploadFiles(Request $request){
        if(!$request->has('files')) return false;

        $file_ids = [];
        $address = [];
        $params = $request->all();
        $files = $params['files'];
        $file_model = new Files;

        DB::beginTransaction();
        foreach($files as $file) {
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();

                //判断文件是否已存在
                $md5 = md5_file($realPath);
                $same_file = Files::where('md5',$md5)->first();

                if($same_file){
                    $file_ids[] = $same_file->id;
                    $rs = Files::where('id',$same_file->id)->increment('owner_num');
                    if(!$rs){
                        DB::rollback();
                        Storage::disk('uploads')->delete($address);
                        return false;
                    }
                }
                else{
                    $filename = md5(date('YmdHis').$originalName) . '.' . $ext;
                    $filePath = 'uploads/' . $filename;
                    // 使用我们新建的uploads本地存储空间（目录）
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                    if ($bool) {
                        $address[] = $filePath;
                    } else {
                        Storage::disk('uploads')->delete($address);
                        DB::rollback();
                        return false;
                    }

                    // 创建文件信息
                    $rs = $file_model->add([
                        'path'  =>  $filePath,
                        'name'  =>  $filename,
                        'size'  =>  filesize($filePath),
                        'format'=>  $ext,
                        'md5'   =>  $md5
                    ]);
                    if($rs === false){
                        Storage::disk('uploads')->delete($address);
                        DB::rollback();
                        return false;
                    }else $file_ids[] = $rs;
                }
            }
        }
        DB::commit();
        return $file_ids;
    }

    /**
     * 删除指定id数组中owner_num为0的数据及文件（请在调用时使用事务保证数据一致性）
     * @param $ids
     * @return bool
     */
    public static function deleteInvalidFileData($ids){
        $rs = Files::whereIn('id',$ids)->where('owner_num',0)->get();
        $deleIds = [];
        $address = [];
        foreach ($rs as $v){
            $deleIds[] = $v->id;
            $address[] = $v->path;
        }
        if(count($deleIds)){
            $rs = Files::destroy($deleIds);
            if($rs != count($deleIds)) return false;
            Storage::dsik('uploads')->delete($address);
        } return true;
    }
}