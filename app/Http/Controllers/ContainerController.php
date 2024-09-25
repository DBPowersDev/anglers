<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\ViewException;

class ContainerController extends Controller
{
    protected $mimes = array(
        'pdf'  => 'application/pdf',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
    );

    public function getImage(Request $request)
    {
        $path = Crypt::decryptString($request->route('path'));
        $info = pathinfo($path);
        $ext = explode('?', strtolower(@$info['extension']));
        $ext = $ext[0];

        if (Config('my.verify_ssl') === false) {

            $options = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                )
            );

            $img = file_get_contents($path, false, stream_context_create($options));
        } else {

            $img = file_get_contents($path, false);
        }

        $content_type = $this->mimes[$ext];
        header('Content-Type: ' . $content_type);
        echo $img;
    }
}
