@section('title', 'animes')

<x-layouts::main>
    <div class="container">
        <div class="block">
            <x-ui.subheadline
                :label="__('Аниме :seasonName сезона')"
                :href="__('/animes/season/2021-spring')">
                <section id="ongoings"></section>
            </x-ui.subheadline>
        </div>
        <div class="row">
            <div class="block col-12 col-lg-6">
                <x-ui.subheadline
                    :label="__('Обновления аниме')"
                    :href="__('/animes/updated')">
                    <section id="list-updated"></section>
                </x-ui.subheadline>
            </div>
            <div class="block col-12 col-lg-6">
                <x-ui.subheadline
                    :label="__('Недавно вышедшие аниме')"
                    :href="__('/animes/complited')">
                    <section id="list-complited"></section>
                </x-ui.subheadline>
            </div>
        </div>
        <div class="row">
            <div class="col col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <x-ui.page-title
                            :h1="__('Новые аниме на сайте')"
                            :desc="__('На данной странице отображены аниме, отсортированные по дате добавления')"
                        />
                        <x-ui.subheadline :label="__('test - default')" />
                        <x-ui.subheadline :label="__('test - default (blue)')" class="blue" />
                        <x-ui.subheadline :label="__('test - default (azure)')" class="azure" />
                        <x-ui.subheadline :label="__('test - default (indigo)')" class="indigo" />
                        <x-ui.subheadline :label="__('test - default (purple)')" class="purple" />
                        <x-ui.subheadline :label="__('test - default (pink)')" class="pink" />
                        <x-ui.subheadline :label="__('test - default (red)')" class="red" />
                        <x-ui.subheadline :label="__('test - default (orange)')" class="orange" />
                        <x-ui.subheadline :label="__('test - default (yellow)')" class="yellow" />
                        <x-ui.subheadline :label="__('test - default (green)')" class="green" />
                        <x-ui.subheadline :label="__('test - default (teal)')" class="teal" />
                        <x-ui.subheadline :label="__('test - default (cyan)')" class="cyan" />
                        <x-ui.subheadline :label="__('test - default (dark)')" class="dark" />
                        <x-ui.subheadline :label="__('test - default - link')" :href="__('/')" />
                        <x-ui.subheadline :label="__('test - default - options')">
                            <x-slot:options>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                                    </ol>
                                </nav>
                            </x-slot:options>
                            slot
                        </x-ui.subheadline>
                    </div>
                </div>
            </div>
            <div class="col d-none d-xl-block">
                <x-ui.page-title
                    :h1="__('Расписание')"
                    :desc="__('Даты выхода эпизодов в Японии')"
                />
                <x-ui.page-title
                    :h1="__('Рекомендуем')"
                    :desc="__('Блок наших друзей и спонсоров')"
                />
            </div>
        </div>
    </div>
</x-layouts::main>
