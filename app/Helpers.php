<?php

declare(strict_types=1);

use App\Models\UserUser as User;
use App\Services\GravatarService;
use Illuminate\Support\Carbon;
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
    if (user_is_online($user)) {
        return trans('user.last_activity.curr');
    }

    return trans('user.last_activity.prev', [
        'time' => Carbon::parse($user->activity_at)->diffForHumans()
    ]);
}

function user_is_online(User $user): bool
{
    return Cache::store('redis')->getStore()->get('user:' . $user->id . ':online') ?? false;
}

function gravatar(?string $email = null, int $size = 192): string
{
    return GravatarService::url($email ?? 'sso@example.com', $size);
}

function app_host(bool $include_subdomain = false): string
{
    $app_url = config('app.url');

    if (! Str::isUrl($app_url)) {
        throw new InvalidArgumentException('application url is not valid');
    }

    $parsed_url = parse_url($app_url);
    $full_domain = $parsed_url['host'];

    if (! $include_subdomain) {
        return $full_domain;
    }

    $parts = explode('.', $full_domain);
    $parts_root = array_slice($parts, -2);

    return implode('.', $parts_root);
}
