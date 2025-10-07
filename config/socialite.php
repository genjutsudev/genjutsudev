<?php

declare(strict_types=1);

return [

    'providers' => array_filter(array_map('trim', explode(',', env('SOCIALITE_PROVIDERS', '')))),

];
