<?php

declare(strict_types=1);

namespace Tests\Integration\Enums;

use App\Enums\User\UserCreatedViaEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserCreatedViaEnumTest extends TestCase
{
    private const array CASES = [
        'API' => 'api',
        'CLI' => 'cli',
        'WEB' => 'web',
        'MOBILE' => 'mobile',
        'IMPORT' => 'import',
        'SCRIPT' => 'script',
        'INVITE' => 'invite',
        'OAUTH' => 'oauth',
        'SSO' => 'sso',
        'ADMIN' => 'admin',
    ];

    #[Test]
    public function testItValues(): void
    {
        $this->assertSame(array_values(self::CASES), UserCreatedViaEnum::values());
    }

    #[Test]
    public function testItNames(): void
    {
        $this->assertSame(array_keys(self::CASES), UserCreatedViaEnum::names());
    }

    #[Test]
    public function testIsMethods(): void
    {
        foreach (self::CASES as $name => $value) {
            $enum = UserCreatedViaEnum::from($value);
            $method = 'is' . lcfirst($name);

            // Проверяем что метод возвращает true для своего случая
            $this->assertTrue($enum->$method());

            // Проверяем что для всех других методов возвращается false
            foreach (array_diff(array_keys(self::CASES), [$name]) as $otherName) {
                $otherMethod = 'is' . lcfirst($otherName);
                $this->assertFalse($enum->$otherMethod());
            }
        }
    }

    #[Test]
    public function testFromAndTryFrom(): void
    {
        foreach (self::CASES as $value) {
            $this->assertSame($value, UserCreatedViaEnum::from($value)->value);
            $this->assertSame($value, UserCreatedViaEnum::tryFrom($value)->value);
        }

        $this->assertNull(UserCreatedViaEnum::tryFrom('invalid_value'));
        $this->expectException(\ValueError::class);
        UserCreatedViaEnum::from('invalid_value');
    }

    #[Test]
    public function testToArrayAndCases(): void
    {
        $this->assertSame(self::CASES, UserCreatedViaEnum::toArray());
        $this->assertCount(count(self::CASES), UserCreatedViaEnum::cases());
    }

    #[Test]
    public function testToArray(): void
    {
        $this->assertSame(self::CASES, UserCreatedViaEnum::toArray());
    }

    #[Test]
    public function testEqualsMethod(): void
    {
        $first = UserCreatedViaEnum::API;
        $second = UserCreatedViaEnum::API;
        $third = UserCreatedViaEnum::WEB;

        $this->assertTrue($first->equals($second));
        $this->assertFalse($first->equals($third));
    }
}
