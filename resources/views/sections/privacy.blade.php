@section('title', $title = 'Политика конфиденциальности')

<x-layouts::main>
    <div class="container">
        <x-ui.page-title :h1="$title" :desc="__('Последнее обновление: 19.06.2025')" />
        {{-- <p>Незнание правил не освобождает Вас от ответственности за их нарушение, убедительно рекомендуем с ними ознакомиться.</p> --}}
        <p>Если Вы не согласны с каким-либо пунктом нашей политики конфиденциальности, пожалуйста, покиньте сайт.</p>
        <p>Политика конфиденциальности объясняет:</p>
        <ul>
            <li>какие данные мы собираем и зачем;</li>
            <li>как мы используем собранные данные.</li>
        </ul>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Какую информацию мы собираем')">
                <p>{{ env('APP_NAME') }} собирает информацию, которая помогает улучшать наши сервисы, начиная с настроек уведомлений и заканчивая более сложными функциями. Например, мы можем находить для вас полезные объявления, новости, аниме.</p>
                <p>Личная информация:</p>
                <ul>
                    <li>адрес электронной почты (Email);</li>
                    <li>пароль.</li>
                </ul>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Локальное хранилище')">
                <p>Мы собираем и храним данные (в том числе и персональные) на ваших пользовательских устройствах с помощью таких средств, как веб-хранилище браузера (включая HTML5) и кеш данных, используемых приложениями.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Файлы cookie и аналогичные технологии')">
                <p>Чтобы получать и записывать данные о том, как используются сервисы {{ env('APP_NAME') }}, мы применяем самые разные технологии, например можем добавлять на ваше устройство файлы cookie или аналогичные технологии. Таким же способом мы получаем статистику по сервисам, предназначенным для наших партнеров: обычно это решения для работы с рекламой.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Как мы используем собранные данные')">
                <p>Благодаря полученным данным мы можем предоставлять, поддерживать, защищать, развивать существующие сервисы и создавать новые, а также обеспечивать безопасность {{ env('APP_NAME') }} и наших пользователей. Помимо прочего, эти данные нужны для того, чтобы более точно персонализировать контент, в том числе повышать релевантность результатов поиска.</p>
                <p>При необходимости использовать ваши данные для целей, не упомянутых в настоящей политике конфиденциальности, мы всегда запрашиваем предварительное согласие на это.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Как найти и изменить свои персональные данные')">
                <p>У Вас всегда есть доступ к своим персональным данным в личном аккаунте. Там же их можно изменить либо удалить. В случае отсутствия функционала удаления, Вы можете обратиться в поддержку с ходатайством об удалении персональных данных. Мы не можем гарантировать их полное удаление, но постараемся сделать все возможное для урегулирования ситуации.</p>
                <p>Мы можем отклонять многократно повторяющиеся заявки, а также запросы, требующие обширных технических работ (например, создать новую систему или значительно изменить существующую), подвергающие риску конфиденциальность других пользователей, а также содержащие бесполезные предложения (например, обработать информацию на резервных копиях).</p>
                <p>Все просьбы получить и исправить информацию мы выполняем бесплатно при условии, что они не сопряжены с чрезмерными техническими сложностями. Наши службы функционируют таким образом, чтобы минимизировать риск случайного или преднамеренного повреждения данных. Поэтому после того, как пользователь удалит свою информацию из служб {{ env('APP_NAME') }}, она некоторое время будет храниться на наших активных серверах. При этом могут существовать и ее резервные копии.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Информация, которую ' . env('APP_NAME') . ' предоставляет третьим лицам')">
                <p>Мы не раскрываем личную информацию пользователей компаниям, организациям и частным лицам, не связанным с {{ env('APP_NAME') }}.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Защита информации')">
                <p>Мы делаем все возможное для того, чтобы обезопасить {{ env('APP_NAME') }} и наших пользователей от несанкционированных попыток доступа, изменения, раскрытия или уничтожения хранящихся у нас данных. В частности, мы делаем следующее:</p>
                <ul>
                    <li>активно используем SSL-шифрование в наших службах;</li>
                    <li>постоянно совершенствуем способы сбора, хранения и обработки данных, включая физические меры безопасности, для противодействия несанкционированному доступу к нашим системам;</li>
                    <li>ограничиваем нашим сотрудникам, подрядчикам и агентам доступ к персональным данным, а также накладываем на них строгие договорные обязательства, за нарушение которых предусмотрены серьезная ответственность и штрафные санкции.</li>
                </ul>
                <p>Также просим обратить внимание, что мы не несем ответственности за вред, который может быть приченен Вам либо 3-им лицам при использовании информации, хранящайся на наших серверах.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('Изменения')">
                <p>Время от времени наша политика конфиденциальности может изменяться. Однако мы никогда не будем ограничивать права пользователей без их явно выраженного согласия. Все обновления политики конфиденциальности отражаются на этой странице, а о самых значительных мы сообщаем особо (в случае с некоторыми службами – по электронной почте).</p>
            </x-ui.subheadline>
        </div>
    </div>
</x-layouts::main>
