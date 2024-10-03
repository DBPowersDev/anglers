<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GearboxSolutions\EloquentFileMaker\Database\Eloquent\FMModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fishing extends FMModel
{
    use SoftDeletes;

    protected $fieldMapping = [
        '主キー' => 'id',
        '作成情報タイムスタンプ' => 'created_at',
        '作成者' => 'created_by',
        '修正情報タイムスタンプ' => 'updated_at',
        '修正者' => 'updated_by',
        '釣行日' => 'fishing_date',
        '釣りタイプ' => 'fishing_type',
        '場所'  => 'place',
        'コメント' => 'comment',
        '削除日時' => 'deleted_at',
        '公開' => 'publish',
        'fishings|PICTURES::写真' => 'picture',
        'fishings|USERS::name' => 'user_name',
        'fishings|USERS::photo' => 'user_photo',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'created_at' => 'datetime',
            'created_by' => 'string',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
            'updated_by' => 'string',
            'fishing_date' => 'date',
            'fishing_type' => 'string',
            'field' => 'string',
            'place' => 'string',
            'comment' => 'string',
            'publish' => 'int',
            'user_name' => 'string',
            'user_id' => 'int',
        ];
    }

    protected function picture(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => \MyUtil::getContainerUrl($value)
        );
    }

    protected function userPhoto(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => \MyUtil::getContainerUrl($value)
        );
    }

    protected function fishingDate(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? Carbon::parse($value)->format('Y-m-d') : null,
        );
    }
}
