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
     * @return string|array|null
     */
    public function getUserMeta(
        $user_id,
        ?string $key,
        bool $unique = false,
        string $orderBy = 'created_at'
    ): array|string|null {
        $request = [
            'user_id' => $user_id
        ];
        if (!is_null($key) && !empty(trim($key))) {
            $request['meta_key'] = $key;
        }
        $query = $this->userMeta->newQuery()->where($request);
        if ($unique) {
            $query->orderByDesc($orderBy);
            if (!is_null($result = $query->first())) {
                return $result->meta_value;
            }
            return null;
        }

        return $query->get()->pluck("meta_value")->all();
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
         $existingMeta = $this->userMeta->newQuery()
            ->where([
                'user_id' => $user_id,
                'meta_key' => $key
            ])->first();

        if (is_null($existingMeta)) {
            return $this->addUserMeta($user_id, $key, $value);
        }
        return $existingMeta->update([
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
