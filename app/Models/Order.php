<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends ParentModel
{
    use HasFactory;

    protected $table ='orders';
    protected $fillable = [
        'user_id',
        'atm_type',
        'atm_model',
        'amount',
        'category',
        'arrival_date',
        'warehouse',
        'status',
        'order_for',
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
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function stocks():HasMany
    {
        return $this->hasMany(Stock::class, 'order_id', 'id');
    }
}
