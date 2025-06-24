<?php

declare(strict_types=1);

namespace App\Values;

use Illuminate\Support\Carbon;

readonly final class UserActivityAtValue
{
    private function __construct(public string $datetime)
    {
    }

    public static function make(string $datetime): self
    {
        return new self($datetime);
    }

    public function forHumans(bool $is_online): string
    {
        if ($is_online) {
            return trans('user.last_activity.curr');
        }

        return trans('user.last_activity.prev', ['time' => $this->diffForHumans()]);
    }

    public function diffForHumans(): string
    {
        return Carbon::parse($this->datetime)->diffForHumans();
    }
}
