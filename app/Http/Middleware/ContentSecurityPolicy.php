<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->isServerError()) {
            return $response; // デバッグ画面表示の為
        }

        // app.blade.phpで生成したノンスを取得
        $nonce = $request->session()->get('csp_nonce', ''); // セッションから取得

        // heredocをダブルクオートで囲む
        if (env('APP_ENV') === 'local') {

            $viteServerHost = env('VITE_SERVER_HOST');

            // 開発環境では style-src に 'unsafe-inline' を許可
            $csp = <<<END
            default-src 'self';
            connect-src 'self' ws://{$viteServerHost}:*;
            script-src 'self' 'nonce-{$nonce}' {$viteServerHost}:*;
            style-src 'self' 'unsafe-inline';
            img-src 'self' data: blob:;
            END;
        } else {

            // 本番環境では style-src に 'unsafe-inline' を使用しない
            $csp = <<<END
            default-src 'self';
            connect-src 'self';
            script-src 'self' 'nonce-{$nonce}';
            style-src 'self';
            img-src 'self' data: blob:;
            END;
        }

        // スペースを整理して1行に
        $csp = preg_replace('~(\s)+~u', ' ', trim($csp));

        // CSPヘッダーを設定
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
