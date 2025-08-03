<?php

declare(strict_types=1);

namespace Tests\Integration\Traits;

use App\Enums\UserCreatedViaEnum;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EnumTraitTest extends TestCase
{
    #[Test]
    public function testCollect(): void
    {
        $collection = UserCreatedViaEnum::collect();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertContainsOnlyInstancesOf(UserCreatedViaEnum::class, $collection);
    }

    #[Test]
    public function testCollectOptions(): void
    {
        $collection = UserCreatedViaEnum::collectOptions();

        $this->assertInstanceOf(Collection::class, $collection);
    }

    #[Test]
    public function testEquals(): void
    {
        $enum1 = UserCreatedViaEnum::API;
        $enum2 = UserCreatedViaEnum::API;
        $enum3 = UserCreatedViaEnum::WEB;

        $this->assertTrue($enum1->equals($enum2));
        $this->assertFalse($enum1->equals($enum3));
    }

    #[Test]
    public function testIsValid(): void
    {
        $this->assertTrue(UserCreatedViaEnum::isValid('api'));
        $this->assertTrue(UserCreatedViaEnum::isValid('cli'));
        $this->assertFalse(UserCreatedViaEnum::isValid('invalid'));
        $this->assertFalse(UserCreatedViaEnum::isValid(null));
    }

    #[Test]
    public function testAllMethodsWithFullEnum(): void
    {
        $enumClass = UserCreatedViaEnum::class;

        $this->assertTrue(method_exists($enumClass, 'values'));
        $this->assertTrue(method_exists($enumClass, 'names'));
        $this->assertTrue(method_exists($enumClass, 'options'));
        $this->assertTrue(method_exists($enumClass, 'collect'));
        $this->assertTrue(method_exists($enumClass, 'collectOptions'));
        $this->assertTrue(method_exists($enumClass, 'equals'));
        $this->assertTrue(method_exists($enumClass, 'isValid'));
        $this->assertTrue(method_exists($enumClass, 'toArray'));
    }
}
