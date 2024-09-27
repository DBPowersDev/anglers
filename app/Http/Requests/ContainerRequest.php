<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;


class ContainerRequest extends FormRequest
{
    public function validationData()
    {
        // dd($this->get('file_base64'));
        $all = parent::validationData();

        if ($this->get('file_base64')) {
            // base64をデコード。プレフィックスに「data:image/jpeg;base64,」のような文字列がついている場合は除去して処理する
            $data = explode(',', $this->get('file_base64'));
            if (isset($data[1])) {
                $fileData = base64_decode($data[1]);
            } else {
                $fileData = base64_decode($data[0]);
            }

            // tmp領域に画像ファイルとして保存してUploadedFileとして扱う
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);
            $tmpFile = new File($tmpFilePath);
            $filename = $tmpFile->getFilename();
            if ($this->get('file_name_base64')) {
                // ファイル名の指定があればセット
                $filename = $this->get('file_name_base64');
            }
            $file = new UploadedFile(
                $tmpFile->getPathname(),
                $filename,
                $tmpFile->getMimeType(),
                0,
                true
            );
            $all['file'] = $file;
        }
        return $all;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:png,jpeg,jpg', // ファイルのバリデーションを png, jpeg, jpg に制限
            'file_base64' => 'required_without:file|string', // ファイルデータをbase64で文字列としても受け入れる。バリデーションルールはfileが適用される。
            // 'file_name_base64' => 'required_with:file_base64|string|max:150', // 必要に応じて
        ];
    }
}
