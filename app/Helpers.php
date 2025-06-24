<?php

declare(strict_types=1);

use App\Models\User\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

function user_last_activity(User $user): string
{
    $activityAt = \App\Values\UserActivityAtValue::make($user->activity_at);
    return $activityAt->forHumans(user_is_online($user->id));
}

function user_is_online(string $id): bool
{
    return Cache::store('redis')->getStore()->get('user:' . $id . ':online') ?? false;
}

function gravatar(string $email, int $size = 192): string
{
    return sprintf("https://www.gravatar.com/avatar/%s?s=$size&d=robohash", md5(Str::lower($email)));
}
