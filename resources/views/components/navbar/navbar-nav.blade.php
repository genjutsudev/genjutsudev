<ul class="navbar-nav text-uppercase px-3 px-md-0 w-100">
    @each('components.navbar.navbar-nav-item', [
        [
            'href' => '/',
            'title' => 'Главная',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>'
        ],
        [
            'href' => route('animes'),
            'title' => 'Аниме',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-database"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0" /><path d="M4 6v6a8 3 0 0 0 16 0v-6" /><path d="M4 12v6a8 3 0 0 0 16 0v-6" /></svg>'
        ],
        // ['href' => '/animes/random', 'title' => 'Случайное', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-shuffle-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 4l3 3l-3 3" /><path d="M18 20l3 -3l-3 -3" /><path d="M3 7h3a5 5 0 0 1 5 5a5 5 0 0 0 5 5h5" /><path d="M3 17h3a5 5 0 0 0 5 -5a5 5 0 0 1 5 -5h5" /></svg>'],
        // ['href' => '/animes/top100', 'title' => 'Топ-100', 'svg' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>']
    ], 'navItem')
    @each('components.navbar.navbar-nav-item-dropdown', [
        [
            'href' => '#',
            'title' => 'Сообщество',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-messages"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" /><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" /></svg>',
            'dropdown' => [
//                ['href' => '/forum', 'title' => 'Форум'],
//                ['href' => '/clubs', 'title' => 'Клубы'],
//                ['href' => '/collections', 'title' => 'Коллекции'],
//                ['href' => '/reviews', 'title' => 'Рецензии'],
//                ['href' => '/articles', 'title' => 'Статьи'],
//                ['href' => '/comments', 'title' => 'Комментарии'],
                ['href' => route('users'), 'title' => 'Пользователи'],
//                ['href' => '#'],
//                ['href' => 'https://t.me/genjut_su', 'title' => 'Канал', 'svg' => '<svg class="me-2 text-azure icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>']
            ]
        ],
        [
            'href' => '#',
            'title' => 'Помощь',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-tabler icons-tabler-outline icon-tabler-help-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>',
            'dropdown' => [
                // ['href' => '/', 'title' => 'FAQ'],
                ['href' => route('rules'), 'title' => 'Правила сайта'],
                // ['href' => '/', 'title' => 'О сайте'],
                ['href' => '#'],
                ['href' => 'https://t.me/genjutsudev', 'title' => 'Канал', 'svg' => '<svg class="me-2 text-azure icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>'],
                ['href' => 'https://t.me/genjutsudev_chat', 'title' => 'Группа (Чат)', 'svg' => '<svg class="me-2 text-azure icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>'],
            ]
        ],
        [
            'href' => '#',
            'title' => 'О сайте',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>',
            'dropdown' => [
                ['href' => route('development'), 'title' => 'Разработка сайта'],
            ],
        ], // @todo отдельная посадочная страница
    ], 'navItem')
</ul>
