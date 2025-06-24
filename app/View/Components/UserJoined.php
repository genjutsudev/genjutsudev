<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\User\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class UserJoined extends Component
{
    private const TIME_UNITS_MAP = ['y' => 'year', 'm' => 'month', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second'];
    private const MAX_TIME_UNITS = 2;

    /**
     * Create a new component instance.
     */
    public function __construct(private readonly User $user)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $createdAt = Carbon::parse($this->user->created_at);
        $timeDiff = $createdAt->diff($currentAt = Carbon::now());

        $formattedParts = $this->buildFormattedTimeParts($timeDiff);
        $formattedTime = $this->limitTimeParts($formattedParts);

        $label = trans('user.joined.label', ['date' => $createdAt->format('Y')]);
        $title = trans('user.joined.title') . ' ' . $timeDiff->format(implode(', ', $formattedTime));

        return view('components.user-joined', compact(['label', 'title']));
    }

    private function buildFormattedTimeParts(\DateInterval $diff): array
    {
        return Collection::make(self::TIME_UNITS_MAP)
            ->filter(fn ($slug, $key) => $diff->$key !== 0)
            ->map(fn ($slug, $key) => '%' . $key . ' ' . trans_choice("user.joined.time_unit.$slug", $diff->$key))
            ->values()
            ->all();
    }

    private function limitTimeParts(array $parts): array
    {
        return count($parts) > self::MAX_TIME_UNITS ? array_slice($parts, 0, self::MAX_TIME_UNITS) : $parts;
    }
}
