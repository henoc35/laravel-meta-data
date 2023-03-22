<?php

namespace CityHunter\LaravelMetaData\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;




class UserMeta extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_key',
        'meta_value',
        'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Plan constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(Config::get('meta_data.tables.user_meta'));
    }
}
