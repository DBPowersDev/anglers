<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\ViewException;
use Illuminate\Support\Facades\Http;

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

        // クッキーの管理のために CookieJar を作成
        $cookieJar = \GuzzleHttp\Cookie\CookieJar::fromArray([], '');

        // Http ファサードを使用
        $response = Http::withOptions([
            'follow_redirects' => true, // リダイレクトを追従
            'cookies' => $cookieJar, // CookieJar を指定
        ])->get($path);

        if ($response->failed()) {
            return response()->json(['error' => $response->body()], 500);
        }

        // Content-Type を設定してレスポンスを返す
        $content_type = $this->mimes[$ext];
        return response($response->body(), 200)->header('Content-Type', $content_type);
    }
}
