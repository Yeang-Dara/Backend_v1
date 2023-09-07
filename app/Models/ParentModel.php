<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ParentModel extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'dob'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'deleted_at' => 'date:Y-m-d',
        'dob' => 'date:Y-m-d',
    ];

    /* Overriding functions*/
    public static function boot()
    {
        static::saved(function () {
            Cache::forget('models' . with(new static)->getTable() . 'all');
        });
        parent::boot();
    }

    public static function all($columns = ['*'])
    {
        return Cache::remember('models' . with(new static)->getTable() . 'all', 10, function () use ($columns) {
            return parent::all($columns);
        });
    }

    public static function create(array $attributes = [])
    {
        $attributes["created_at"] = Carbon::now();
//        $attributes["create_uid"] = 1;
        $model = static::query()->create($attributes);
        return $model;
    }
    public function getDetailTableColumns()
    {
        // Store table schema to cache for later use
        return Cache::rememberForever('schema.' . $this->getTable(), function () {
            $columns = DB::select('select
                co.column_name,
                co.udt_name as data_type,
                co.character_maximum_length,
                co.is_nullable
                from information_schema.columns as co
                where co.table_name = ?',
                [$this->getTable()]
            );
            $columns = collect($columns)->keyBy('column_name');
            $foreigns = DB::select('
                SELECT
                    tc.constraint_name,
                    kcu.column_name,
                    ccu.table_name AS foreign_table_name,
                    ccu.column_name AS foreign_column_name
                FROM
                    information_schema.table_constraints AS tc
                    JOIN information_schema.key_column_usage AS kcu
                      ON tc.constraint_name = kcu.constraint_name
                      AND tc.table_schema = kcu.table_schema
                    JOIN information_schema.constraint_column_usage AS ccu
                      ON ccu.constraint_name = tc.constraint_name
                      AND ccu.table_schema = tc.table_schema
                WHERE tc.constraint_type = \'FOREIGN KEY\' AND tc.table_name=?',
                [$this->getTable()]);
            $foreigns = collect($foreigns)->keyBy('column_name');

            $foreigns->each(function ($item, $key) use ($columns) {
                $columns->put($key, (object)array_merge((array)$columns->get($key), (array)$item));
            });
            return $columns;
        });
    }
}
