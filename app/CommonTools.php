<?php

namespace App;


use App\Models\Base\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CommonTools{

    /**
     * 获取数组最深维度数
     * @param $array
     * @return int
     */
    public static function array_depth($array) {
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

    /**
     * 多文件上传，返回false或base_files表id数组
     * @param Request $request
     * @return array|bool
     */
    public static function uploadFiles(Request $request){
        if(!$request->has('files')) return [];

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
                if($same_file) $file_ids[] = $same_file->id;
                else{
                    // 上传文件
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
}