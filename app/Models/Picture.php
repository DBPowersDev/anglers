<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GearboxSolutions\EloquentFileMaker\Database\Eloquent\FMModel;

class Picture extends FMModel
{
    protected $fieldMapping = [
        '主キー' => 'id',
        '作成情報タイムスタンプ' => 'created_at',
        '作成者' => 'created_by',
        '修正情報タイムスタンプ' => 'updated_at',
        '修正者' => 'updated_by',
        '釣行キー' => 'fishing_id',
        '写真' => 'picture',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'created_at' => 'datetime',
            'created_by' => 'string',
            'updated_at' => 'datetime',
            'updated_by' => 'string',
            'fishing_id' => 'string',
        ];
    }
}
