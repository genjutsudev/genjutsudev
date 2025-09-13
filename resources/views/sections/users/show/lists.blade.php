@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-show>
    <nav class="nav nav-segmented text-uppercase w-100 rounded-0 p-0">
        @foreach($lists = [
            'completed' => ['title' => 'Просмотрено', 'textClass' => 'text-green', 'activeClass' => 'bg-success-lt', 'icon' => '<i class="fa fa-check" aria-hidden="true"></i>'],
            'dropped' => ['title' => 'Брошено', 'textClass' => 'text-danger', 'activeClass' => 'bg-danger-lt', 'icon' => '<i class="fa fa-times" aria-hidden="true"></i>'],
            'on_hold' => ['title' => 'Отложено', 'textClass' => 'text-secondary', 'activeClass' => 'bg-secondary-lt', 'icon' => '<i class="fa fa-pause" aria-hidden="true"></i>'],
            'planned' => ['title' => 'Запланировано', 'textClass' => 'text-primary', 'activeClass' => 'bg-primary-lt', 'icon' => '<i class="fa fa-plus" aria-hidden="true"></i>'],
            'rewatching' => ['title' => 'Пересматриваю', 'textClass' => 'text-primary', 'activeClass' => 'bg-primary-lt', 'icon' => '<i class="fa fa-repeat" aria-hidden="true"></i>'],
            'watching' => ['title' => 'Смотрю', 'textClass' => 'text-primary', 'activeClass' => 'bg-primary-lt', 'icon' => '<i class="fa fa-play" aria-hidden="true"></i>'],
        ] as $slug => $list)
            <a
                href="{{ route('users.show.lists.anime', [$user->nid, $user->profilelink, 'list' => $slug]) }}"
                @class(['nav-link', 'rounded-0', "{$list['activeClass']}" => $slug === $listName = request()->get('list')])
            >
                <b @class(['d-flex', $list['textClass']])>
                    <div style="width: 26px;"><b>{!! $list['icon'] !!}</b></div>
                    <div>{{ $list['title'] }}</div>
                </b>
            </a>
        @endforeach
    </nav>
    <hr class="my-3">
    <div>content::{{ $listName }}</div>
</x-layouts::users-show>
