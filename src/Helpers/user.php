<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('get_user_meta')) {
    /**
     * @param $user_id
     * @param string|null $key
     * @param bool $unique
     * @return string|array|null
     */
    function get_user_meta($user_id, ?string $key = null, bool $unique = false): string|array|null
    {
        $meta = \CityHunter\LaravelMetaData\User\UserMeta::getInstance();
        return $meta->getUserMeta($user_id, $key, $unique);
    }
}

if (!function_exists('add_user_meta')) {
    /**
     * @param $user_id
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    function add_user_meta($user_id, string $key, mixed $value): bool
    {
        $meta = \CityHunter\LaravelMetaData\User\UserMeta::getInstance();
        return $meta->addUserMeta($user_id, $key, $value);
    }
}

if (!function_exists('update_user_meta')) {
    /**
     * @param $user_id
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    function update_user_meta($user_id, string $key, mixed $value): bool
    {
        $meta = \CityHunter\LaravelMetaData\User\UserMeta::getInstance();
        return $meta->updateUserMeta($user_id, $key, $value);
    }
}

if (!function_exists('delete_user_meta')) {
    /**
     * @param $user_id
     * @param string|null $key
     * @return bool
     */
    function delete_user_meta($user_id, ?string $key = null): bool
    {
        $meta = \CityHunter\LaravelMetaData\User\UserMeta::getInstance();
        return $meta->deleteUserMeta($user_id, $key);
    }
}
