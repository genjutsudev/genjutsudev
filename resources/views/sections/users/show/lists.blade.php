@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-show>
    <div class="row">
        <div class="col-3" style="width: 24%;">
            <div class="border-end h-100">
                <div class="list-group rounded-0">
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
                            @class([
                                'list-group-item',
                                'list-group-item-action',
                                'd-flex',
                                'justify-content-between',
                                'align-items-start',
                                'border-0',
                                'border-bottom',
                                'ps-3',
                                "{$list['activeClass']}" => $slug === $listName = request()->get('list')
                            ])
                        >
                            <div class="me-auto">
                                <b @class(['d-flex', $list['textClass']])>
                                    <div style="width: 26px;">{!! $list['icon'] !!}</div>
                                    <div>{{ $list['title'] }}</div>
                                </b>
                            </div>
                            <span class="badge text-bg-primary rounded-pill">99+</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
            <div class="p-3">
                <div>content::{{ $listName }}</div>
            </div>
        </div>
    </div>
</x-layouts::users-show>
