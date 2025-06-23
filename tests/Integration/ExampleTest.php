<?php

namespace Tests\Integration;

use App\Enums\UserTypeEnum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testItThrowsExceptionForInvalidValueInFrom()
    {
        $this->expectException(\ValueError::class);
        UserTypeEnum::from('invalid');
    }
}
