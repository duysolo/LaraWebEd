<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use Illuminate\Http\Request;

class FileController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->app = app();
        $this->package = 'elfinder';
    }

    public function getFileManager(Request $request, $user_id = null)
    {
        return $this->_viewAdmin('files.file-manager', $this->_getViewVars($user_id));
    }

    protected function _getViewVars($user_id = null)
    {
        $dir = 'packages/barryvdh/'.$this->package;
        $locale = $this->app->config->get('app.locale');
        if (!file_exists($this->app['path.public'] . "/$dir/js/i18n/elfinder.$locale.js")) {
            $locale = false;
        }
        $csrf = true;

        $url = $this->app->config->get('app.adminCpAccess').'/files/connector';
        if($user_id) $url .= '/'.$user_id;
        $url = asset($url);

        return compact('dir', 'locale', 'csrf', 'url');
    }

    public function anyConnector($user_id = null)
    {
        $roots = $this->app->config->get('elfinder.roots', []);

        if (empty($roots)) {
            $dirs = (array) $this->app['config']->get('elfinder.dir', []);

            if(!is_dir($dirs[0])){
                mkdir($dirs[0], 0777, true);
            }

            if($user_id != null && $user_id > 0)
            {
                if(!is_dir($dirs[0].DIRECTORY_SEPARATOR.md5($user_id))){
                    mkdir($dirs[0].DIRECTORY_SEPARATOR.md5($user_id), 0777, true);
                }
            }

            foreach ($dirs as $dir) {
                $path = $dir;
                $url = $dir;
                if($user_id != null && $user_id > 0)
                {
                    $path = $dir.DIRECTORY_SEPARATOR.md5($user_id);
                    $url = $dir.'/'.md5($user_id);
                }
                $roots[] = [
                    'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                    'path' => public_path($path), // path to files (REQUIRED)
                    'tmpPath' => public_path($path),
                    'URL' => url($url), // URL to files (REQUIRED)
                    'accessControl' => $this->app->config->get('elfinder.access'), // filter callback (OPTIONAL),
                    'autoload' => true,
                    'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
                    'uploadAllow'   => array('image', 'text/plain'),// Mimetype `image` and `text/plain` allowed to upload
                    'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
                ];
            }

            $disks = (array) $this->app['config']->get('elfinder.disks', []);
            foreach ($disks as $key => $root) {
                if (is_string($root)) {
                    $key = $root;
                    $root = [];
                }
                $disk = app('filesystem')->disk($key);
                if ($disk instanceof \FilesystemAdapter) {
                    $defaults = [
                        'driver' => 'Flysystem',
                        'filesystem' => $disk->getDriver(),
                        'alias' => $key,
                    ];
                    $roots[] = array_merge($defaults, $root);
                }
            }
        }

        $opts = ['roots' => $roots, 'debug' => true];

        $connector = new \Barryvdh\Elfinder\Connector(new \elFinder($opts));
        $connector->run();
        return $connector->getResponse();
    }
}