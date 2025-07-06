<?php

declare(strict_types=1);

use App\Models\User\User;
use App\Values\UserActivityAtValue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

function user_age_title(User $user): string
{
    $age = $user->birthday->age;
    return $age . ' ' . trans_choice('user.birthday.year', $age);
}

function user_gender_title(User $user): string
{
    return __('user.gender.' . $user->gender);
}

function user_last_activity(User $user): string
{
    $activityAt = UserActivityAtValue::make($user->getActivityAt());
    return $activityAt->forHumans(user_is_online($user));
}

function user_is_online(User $user): bool
{
    return Cache::store('redis')->getStore()->get('user:' . $user->id . ':online') ?? false;
}

function gravatar(string $email, int $size = 192): string
{
    return sprintf("https://www.gravatar.com/avatar/%s?s=$size&d=robohash&r=g", md5(Str::lower($email)));
}
