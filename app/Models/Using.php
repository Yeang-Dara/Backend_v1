<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Using extends ParentModel
{
    use HasFactory;
    protected $table='usings';
    protected $fillable= [
        'user_id',
        'atm_id',
        'alias_id',
        'install_date',
        'apk_version',
        'image_version',
        'mainboard_version',
        'android_version',
        'delivery_date',
        'take_over_date',
        'category_name',
        'serial_number',
        'model_name',
        'warranty_days',
        'comment',
        'type_name',
        'status',
        'bank_name',
        'site_id',
        'region_name',
        'site_name',
        'location',
        'city',
        'state_name',
        'accessibility',
        'address',
    ];
    public static function rulesToCreate():array
    {
        return [
            // 'install_date'=>'date_format:Y-m-d',
            // 'delivery_date'=>'date_format:Y-m-d',
            // 'take_over_date'=>'date_format:Y-m-d',
        ];
    }
    public static function rulesToCreateMessages(){
        return [];
    }
    public static function rulesToUpdate(){
        return [];
    }
    public static function rulesToUpdateMessages(){
        return [];
    }
    public function usings(): BelongsTo
    {
        return $this->belongsTo(Users::class,'user_id', 'id');
    }
}
