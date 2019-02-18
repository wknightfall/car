<?php

namespace Addons\uploadImages;
use Common\Controller\Addon;

/**
 * 图片批量上传插件
 * @author tjr&jj
 */

    class uploadImagesAddon extends Addon{

        public $info = array(
            'name'=>'uploadImages',
            'title'=>'图片批量上传',
            'description'=>'图片的批量上传',
            'status'=>1,
            'author'=>'brighttj',
            'version'=>'0.2'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        //实现的uploadImages钩子方法
        public function UploadImages($param){

            $this->display('upload');
        }
    }