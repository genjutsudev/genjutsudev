<?php

declare(strict_types=1);

namespace Tests\Integration\Enums;

use App\Enums\UserTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_cases()
    {
        $fn = function (UserTypeEnum $type): string {
            return $type->value;
        };

        $this->assertSame('regular', $fn(UserTypeEnum::REGULAR));
        $this->assertSame('admin', $fn(UserTypeEnum::ADMIN));
        $this->assertSame('api', $fn(UserTypeEnum::API));
    }

    #[Test]
    public function it_returns_correct_values()
    {
        $expected = ['regular', 'admin', 'api'];
        $this->assertSame($expected, UserTypeEnum::values());
    }

    #[Test]
    public function it_returns_correct_names()
    {
        $expected = ['REGULAR', 'ADMIN', 'API'];
        $this->assertSame($expected, UserTypeEnum::names());
    }

    #[Test]
    public function isRegular_returns_true_only_for_regular_case()
    {
        $this->assertTrue(UserTypeEnum::REGULAR->isRegular());
        $this->assertFalse(UserTypeEnum::ADMIN->isRegular());
        $this->assertFalse(UserTypeEnum::API->isRegular());
    }

    #[Test]
    public function isAdmin_returns_true_only_for_admin_case()
    {
        $this->assertFalse(UserTypeEnum::REGULAR->isAdmin());
        $this->assertTrue(UserTypeEnum::ADMIN->isAdmin());
        $this->assertFalse(UserTypeEnum::API->isAdmin());
    }

    #[Test]
    public function isApi_returns_true_only_for_api_case()
    {
        $this->assertFalse(UserTypeEnum::REGULAR->isApi());
        $this->assertFalse(UserTypeEnum::ADMIN->isApi());
        $this->assertTrue(UserTypeEnum::API->isApi());
    }

    #[Test]
    public function it_can_be_created_from_valid_value_using_tryFrom()
    {
        $this->assertSame(UserTypeEnum::REGULAR, UserTypeEnum::tryFrom('regular'));
        $this->assertSame(UserTypeEnum::ADMIN, UserTypeEnum::tryFrom('admin'));
        $this->assertSame(UserTypeEnum::API, UserTypeEnum::tryFrom('api'));
        $this->assertNull(UserTypeEnum::tryFrom('invalid'));
    }

    #[Test]
    public function it_can_be_created_from_valid_value_using_from()
    {
        $this->assertSame(UserTypeEnum::REGULAR, UserTypeEnum::from('regular'));
        $this->assertSame(UserTypeEnum::ADMIN, UserTypeEnum::from('admin'));
        $this->assertSame(UserTypeEnum::API, UserTypeEnum::from('api'));
    }

    #[Test]
    public function it_throws_exception_for_invalid_value_in_from()
    {
        $this->expectException(\ValueError::class);
        UserTypeEnum::from('invalid');
    }

    #[Test]
    public function it_returns_all_cases()
    {
        $cases = UserTypeEnum::cases();
        $this->assertCount(3, $cases);
        $this->assertContainsOnlyInstancesOf(UserTypeEnum::class, $cases);
    }

    #[Test]
    public function it_can_check_equality()
    {
        $regular = UserTypeEnum::REGULAR;
        $admin = UserTypeEnum::ADMIN;

        $this->assertTrue($regular->equals(UserTypeEnum::REGULAR));
        $this->assertFalse($regular->equals($admin));
    }
}
