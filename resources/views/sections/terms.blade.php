@section('title', $title = 'Пользовательское соглашение')

<x-layouts::main>
    <div class="container">
        <x-ui.page-title :h1="$title" :desc="__('Последнее обновление: 19.06.2025')" />
        <p>Интернет - ресурс (сайт) {{ request()->host() }} (в дальнейшем - Ресурс) является интернет-сайтом, позволяющим пользователям обмениваться друг с другом информацией об аниме в свободной форме.</p>
        <div class="mb-5">
            <x-ui.subheadline :label="__('1. О пользовательском соглашении')">
                <p>Используя/посещая Ресурс (включая весь контент, размещенный на ресурсе), вы соглашаетесь с Настоящим ПОЛЬЗОВАТЕЛЬСКИМ СОГЛАШЕНИЕМ, размещенным по адресу {{ route('terms') }}. Если вы не согласны с любым из пунктов данного пользовательского соглашения, пожалуста, покиньте ресурс. ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ может быть изменено Администрацией без какого-либо уведомления пользователей. Новая версия ПС вступает в силу по истечении 3 (трех) дней с момента ее размещения, если иное не предусмотрено новой редакцией ПОЛЬЗОВАТЕЛЬСКОГО СОГЛАШЕНИЯ.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('2. Условия ограничения ответственности')">
                <p>Пользователь прямо соглашается c тем, что использует Ресурс на свой собственный риск.</p>
                <p>Пользователь знает, и согласен с тем, что Ресурс имеет дело с материалами и данными, созданными третьими лицами и размещенными ими в сети Интернет на своих компьютерах и (или) серверах. Содержание и безопасность этих материалов не могут быть проконтролированы Администрацией Ресурса, поэтому последняя не несет ответственности:</p>
                <ul>
                    <li>за содержание материалов, полученных Пользователем в результате использования данных с Ресурса, их возможное несоответствие действующему законодательству или оскорбительный характер;</li>
                    <li>за последствия применения, использования или неиспользования полученной информации;</li>
                    <li>за возможное несоответствие результатов, полученных при использовании Ресурса, ожиданиям Пользователя;</li>
                    <li>за какие-либо повреждения оборудования или программного обеспечения Пользователя, возникшие в результате использовании Ресурса;</li>
                    <li>за отсутствие возможности использования Ресурса по каким-либо причинам;</li>
                    <li>за последствия, которые может повлечь распространение нелегального либо нелицензионного программного обеспечения и аудио-/видеопродукции, а также иных материалов либо данных, затрагивающих права третьих лиц.</li>
                </ul>
                <p>Ни при каких обстоятельствах Ресурс не несет перед Пользователем, либо третьими лицами ответственности за ущерб, убытки или расходы, возникшие в связи с настоящим Ресурсом, его использованием или невозможностью использования, включая упущенную либо недополученную прибыль.</p>
                <p>Пользователь обязуется не передавать другим лицами свои персональные данные полученные при регистрации (логин и пароль) для входа/идентификации на ресурс и несет полную ответственность за утерю, пропажу, исчезновение или передачу иными способами персональных данных, а также за последствия связанные с данным деянием. Администрация Ресурса не несёт ответственности за действия третьих лиц, воспользовавшихся персональными данными Пользователя.</p>
                <p>Администрация Ресурса не несет никаких обязательств по обеспечению конфиденциальности в отношении информации, предоставляемой его Пользователям, хотя принимает все возможные меры к этому, если не имеется договоренности об обратном или соответствующих требований действующего законодательства.</p>
                <p>В обязанности Ресурса НЕ ВХОДИТ контроль легальности или нелегальности передаваемой информации, определение прав собственности или законности передачи, приема или использования этой информации.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('3. Ограничения на использование ресурса пользователем.')">
                <p>При использовании данного Ресурса, ПОЛЬЗОВАТЕЛЬ не имеет права, и соглашается с этим:</p>
                <ul>
                    <li>размещать файлы или программы, предназначенные для нарушения, уничтожения либо ограничения функциональности любого компьютерного или телекоммуникационного оборудования или программ, для осуществления несанкционированного доступа, а также серийные номера к коммерческим программным продуктам и программы для их генерации, логины, пароли и прочие средства для получения несанкционированного доступа к платным ресурсам в Интернете, а также размещать ссылки на вышеуказанную информацию;</li>
                    <li>размещать файлы затрагивающие какой-либо патент, торговую марку, коммерческую тайну, копирайт или прочие права собственности и/или авторские и смежные с ним права третьих лиц;</li>
                    <li>отправлять на адреса электронной почты, указанные на сайте, несанкционированные почтовые сообщения рекламного типа (junk mail, spam);</li>
                    <li>копировать и использовать в коммерческих целях любую информацию, получаемую посредством данного ресурса, нарушающую права других Пользователей или могущую нанести им прямой материальный или моральный ущерб;</li>
                    <li>размещать ссылки на ресурсы Сети, содержание которых противоречит действующему законодательству РФ;</li>
                    <li>выдавать себя за другого человека или за представителя организации и/или сообщества без достаточных на то прав, в том числе за сотрудников Aдминистрации, за владельца Ресурса.</li>
                </ul>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('4. Гарантии работоспособности')">
                <p>Доступ к Ресурсу предоставляются по принципу «как есть» («as is») без гарантий любого рода, как прямых, так и косвенных.</p>
                <p>В частности Администрация Ресурса не гарантирует работоспособность как сайта и его отдельных разделов, так и работоспособность и достоверность ссылок, размещенных на нем его Пользователями.</p>
                <p>Ресурс не несет ответственности за любые прямые или непрямые убытки, произошедшие из-за: использования либо невозможности использования службы; несанкционированного доступа к Вашим коммуникациям.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('5. Права администрации ресурса.')">
                <p>Администрация Ресурса вправе отклонить в доступе к Ресурсу любому Пользователю, или группе Пользователей без объяснения причин своих действий и предварительного уведомления.</p>
                <p>Администрация Ресурса вправе изменять либо удалять ссылки на информацию, графические, звуковые и прочие данные, размещенные Пользователями на Ресурсе, без предварительного уведомления и объяснения причин своих действий.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('6. Ответственность сторон.')">
                <p>Пользователь соглашается с тем, что все возможные споры по поводу СОГЛАШЕНИЯ ОБ ИСПОЛЬЗОВАНИИ будут разрешаться по нормам российского права.</p>
                <p>Пользователь соглашается с тем, что нормы и законы о защите прав потребителей не могут быть применимы к использованию им Ресурса, поскольку он не оказывает возмездных услуг.</p>
                <p>Ресурс не устанавливает с пользователями агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений личного найма, а также каких-то иных отношений, прямо не описанных в СОГЛАШЕНИИ ОБ ИСПОЛЬЗОВАНИИ.</p>
                <p>Бездействие со стороны Ресурса в случае нарушения Пользователем, либо группой Пользователей ПОЛЬЗОВАТЕЛЬСКОГО СОГЛАШЕНИЯ не означает того, что Ресурс содействует Пользователю, либо группе Пользователей в таковых действиях.</p>
                <p>Бездействие со стороны Ресурса в случае нарушения Пользователем либо группой Пользователей ПОЛЬЗОВАТЕЛЬСКОГО СОГЛАШЕНИЯ не лишает Ресурс права предпринять соответствующие действия в защиту своих интересов позднее.</p>
            </x-ui.subheadline>
        </div>
        <div class="mb-5">
            <x-ui.subheadline :label="__('7. Согласие с пользовательским соглашением.')">
                <p>Если вы не согласны сo всеми вышеуказанными условиями, вы не имеете права посещать ресурс как в целом, так и любую его часть, кроме страницы с пользовательским соглашением, получать и/или использовать содержимое настоящего ресурса любыми другими способами как в целом так и в любой его части!</p>
                <p>Если вы не согласны с пользовательским соглашением, вы должны немедленно покинуть ресурс.</p>
            </x-ui.subheadline>
        </div>
    </div>
</x-layouts::main>
