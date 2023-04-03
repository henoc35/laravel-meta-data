<?php

namespace CityHunter\LaravelMetaData\Concerns;

use CityHunter\LaravelMetaData\Models\UserMeta;

trait HasUserMeta
{
    public function userMeta()
    {
        $this->hasMany(UserMeta::class, "user_id");
    }
}
