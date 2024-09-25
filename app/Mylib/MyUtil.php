<?php

namespace App\Mylib;

use Illuminate\Support\Facades\Crypt;

class MyUtil
{
    public function getContainerUrl($fm_url)
    {
        if ($fm_url) {
            $path = Crypt::encryptString($fm_url);
            return url('container/' . $path);
        } else {
            return null;
        }
    }
}
