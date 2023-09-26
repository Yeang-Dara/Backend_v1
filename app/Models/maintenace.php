<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class maintenace extends ParentModel
{
    use HasFactory;
    protected $table ='maintenaces';
    protected $fillable = [
        'atm_id',
        'maintenace_name',
        'maintenace_date',
      
    ];
    public static function rulesToCreate(): array 
    {
        return['replace_date' =>'date_format:Y-m-d'];
    }
    public static function rulesToCreateMessages()
    {
        return [];
    }
    public static function rulesToUpdate($id = null): array
    {
        return [];
    }
    public static function rulesToUpdateMessages(): array
    {
        return [];
    }
    public function maintenaces():BelongsTo
    {
        return $this->belongsTo(Usings::class, 'atm_id', 'id');
    }
}
