<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;
    protected $table ='stocks';
    protected $fillable = [
        'order_id',
        'serail_number',
        'status',
        'forSellorRest',
    ];
    public static function rulesToCreate(): array 
    {
        return[
            // 'order_date' =>'date_format:d-m-Y',
        ];
    }
    public static function rulesToCreateMessages(){
        return [

        ];
    }
    public static function rulesToUpdate($id = null): array
    {
        return ['orrival_date' =>'date_format:d-m-Y',];
    }
    public static function rulesToUpdateMessages(): array
    {
        return [];
    }
    public function stocks(): BelongsTo
    {
        return $this->belongsTo(orders::class, 'order_id', 'id');
    }
}
