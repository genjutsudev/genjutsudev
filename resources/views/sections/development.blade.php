@section('title', $title = 'Разработка сайта')

<x-layouts::main>
    <div class="page-header m-0 mb-3">
        <div class="container">
            <h1 class="text-uppercase">{{ $title }}</h1>
        </div>
    </div>
    <div class="position-relative">
        <div class="agile-board-wrapper">
            <iframe src="https://agileseason.com/#/shared/board/f18933beb3b353868b25de5182b9f18d?fullScreen=true"
                    class="agile-board-iframe"
                    allowfullscreen></iframe>
        </div>
    </div>
    <style>
        .agile-board-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .agile-board-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</x-layouts::main>

