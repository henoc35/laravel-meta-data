<?php

namespace CityHunter\LaravelMetaData\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserMeta
{
    private static ?UserMeta $instance = null;

    /**
     * @param \CityHunter\LaravelMetaData\Models\UserMeta $userMeta
     */
    public function __construct(private \CityHunter\LaravelMetaData\Models\UserMeta $userMeta)
    {
    }

    public static function getInstance(): UserMeta
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(new \CityHunter\LaravelMetaData\Models\UserMeta());
        }
        return self::$instance;
    }

    public function getUserMetas(
        $user_id
    ): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null {

        $query = $this->userMeta->newQuery()->where([
            'user_id' => $user_id
        ]);

        return $query->get();
    }

    /**
     * @param $user_id
     * @param string|null $key
     * @param bool $unique
     * @param string $orderBy
     * @return Model|Collection|Builder|array|null
     */
    public function getUserMeta(
        $user_id,
        ?string $key,
        bool $unique = false,
        string $orderBy = 'created_at'
    ): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null {
        $request = [
            'user_id' => $user_id
        ];
        if (!is_null($key) && !empty(trim($key))) {
            $request['meta_key'] = $key;
        }
        $query = $this->userMeta->newQuery()->where($request);
        if ($unique) {
            $query->orderByDesc($orderBy);
            return $query->first();
        }
        return $query->get();
    }

    /**
     * @param $user_id
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function addUserMeta($user_id, string $key, mixed $value): bool
    {
        $query = $this->userMeta->newInstance([
            'user_id' => $user_id,
            'meta_key' => $key,
            'meta_value' => $value
        ]);

        return $query->save();
    }

    /**
     * @param $user_id
     * @param string $key
     * @param $value
     * @return bool
     */
    public function updateUserMeta($user_id, string $key, $value): bool
    {
        return $this->userMeta->newQuery()
            ->where([
                'user_id' => $user_id,
                'meta_key' => $key
            ])
            ->update([
                'meta_value' => $value
            ]);
    }

    /**
     * @param $user_id
     * @param string|null $key
     * @return bool
     */
    public function deleteUserMeta($user_id, ?string $key = null): bool
    {
        $request = [
            'user_id' => $user_id
        ];
        if (!is_null($key)) {
            $request['meta_key'] = $key;
        }
        return $this->userMeta->newQuery()->where($request)->delete();
    }
}
