<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class FileController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->app = app();
    }

    public function getFileManager(Request $request, $userId = null)
    {
        return $this->_viewAdmin('files.file-manager', $this->_getViewVars($userId));
    }

    protected function _getViewVars($userId = null)
    {
        $csrf = true;

        $url = $this->adminCpAccess . '/files/connector';
        if ($userId) {
            $url .= '/' . $userId;
        }

        $url = asset($url);

        return compact('csrf', 'url');
    }

    public function anyConnector($userId = null)
    {
        $roots = $this->app->config->get('elfinder.roots', []);

        if (empty($roots)) {
            $dirs = (array) $this->app['config']->get('elfinder.dir', []);

            if (!is_dir($dirs[0])) {
                mkdir($dirs[0], 0777, true);
            }

            if ($userId != null && $userId > 0) {
                if (!is_dir($dirs[0] . DIRECTORY_SEPARATOR . md5($userId))) {
                    mkdir($dirs[0] . DIRECTORY_SEPARATOR . md5($userId), 0777, true);
                }
            }

            foreach ($dirs as $dir) {
                $path = $dir;
                $url = $dir;
                if ($userId != null && $userId > 0) {
                    $path = $dir . DIRECTORY_SEPARATOR . md5($userId);
                    $url = $dir . '/' . md5($userId);
                }
                $roots[] = [
                    'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                    'path' => public_path($path), // path to files (REQUIRED)
                    'tmpPath' => public_path($path),
                    'URL' => url($url), // URL to files (REQUIRED)
                    'accessControl' => $this->app->config->get('elfinder.access'), // filter callback (OPTIONAL),
                    'autoload' => true,
                    'uploadDeny' => array('all'), // All Mimetypes not allowed to upload
                    'uploadAllow' => array('image', 'text/plain'), // Mimetype `image` and `text/plain` allowed to upload
                    'uploadOrder' => array('deny', 'allow'), // allowed Mimetype `image` and `text/plain` only
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
