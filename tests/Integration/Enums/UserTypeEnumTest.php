<?php

declare(strict_types=1);

namespace Tests\Integration\Enums;

use App\Enums\UserTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTypeEnumTest extends TestCase
{
    #[Test]
    public function testItHasCorrectCases()
    {
        $fn = function (UserTypeEnum $type): string {
            return $type->value;
        };

        $this->assertSame('regular', $fn(UserTypeEnum::REGULAR));
        $this->assertSame('admin', $fn(UserTypeEnum::ADMIN));
        $this->assertSame('api', $fn(UserTypeEnum::API));
    }

    #[Test]
    public function testItReturnsCorrectValues()
    {
        $expected = ['regular', 'admin', 'api'];
        $this->assertSame($expected, UserTypeEnum::values());
    }

    #[Test]
    public function testItReturnsCorrectNames()
    {
        $expected = ['REGULAR', 'ADMIN', 'API'];
        $this->assertSame($expected, UserTypeEnum::names());
    }

    #[Test]
    public function testIsRegularReturnsTrueOnlyForRegularCase()
    {
        $this->assertTrue(UserTypeEnum::REGULAR->isRegular());
        $this->assertFalse(UserTypeEnum::ADMIN->isRegular());
        $this->assertFalse(UserTypeEnum::API->isRegular());
    }

    #[Test]
    public function testIsAdminReturnsTrueOnlyForAdminCase()
    {
        $this->assertFalse(UserTypeEnum::REGULAR->isAdmin());
        $this->assertTrue(UserTypeEnum::ADMIN->isAdmin());
        $this->assertFalse(UserTypeEnum::API->isAdmin());
    }

    #[Test]
    public function testIsApiReturnsTrueOnlyForApiCase()
    {
        $this->assertFalse(UserTypeEnum::REGULAR->isApi());
        $this->assertFalse(UserTypeEnum::ADMIN->isApi());
        $this->assertTrue(UserTypeEnum::API->isApi());
    }

    #[Test]
    public function testItCanBeCreatedFromValidValueUsingTryFrom()
    {
        $this->assertSame(UserTypeEnum::REGULAR, UserTypeEnum::tryFrom('regular'));
        $this->assertSame(UserTypeEnum::ADMIN, UserTypeEnum::tryFrom('admin'));
        $this->assertSame(UserTypeEnum::API, UserTypeEnum::tryFrom('api'));
        $this->assertNull(UserTypeEnum::tryFrom('invalid'));
    }

    #[Test]
    public function testItCanBeCreatedFromValidValueUsingFrom()
    {
        $this->assertSame(UserTypeEnum::REGULAR, UserTypeEnum::from('regular'));
        $this->assertSame(UserTypeEnum::ADMIN, UserTypeEnum::from('admin'));
        $this->assertSame(UserTypeEnum::API, UserTypeEnum::from('api'));
    }

    #[Test]
    public function testItThrowsExceptionForInvalidValueInFrom()
    {
        $this->expectException(\ValueError::class);
        UserTypeEnum::from('invalid');
    }

    #[Test]
    public function testItReturnsAllCases()
    {
        $cases = UserTypeEnum::cases();
        $this->assertCount(3, $cases);
        $this->assertContainsOnlyInstancesOf(UserTypeEnum::class, $cases);
    }

    #[Test]
    public function testItCanCheckEquality()
    {
        $regular = UserTypeEnum::REGULAR;
        $admin = UserTypeEnum::ADMIN;

        $this->assertTrue($regular->equals(UserTypeEnum::REGULAR));
        $this->assertFalse($regular->equals($admin));
    }
}
