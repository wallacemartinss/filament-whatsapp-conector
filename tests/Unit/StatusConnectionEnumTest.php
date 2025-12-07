<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Tests\Unit;

use WallaceMartinss\FilamentEvolution\Enums\StatusConnectionEnum;
use WallaceMartinss\FilamentEvolution\Tests\TestCase;

class StatusConnectionEnumTest extends TestCase
{
    public function test_enum_has_correct_values(): void
    {
        $this->assertSame('open', StatusConnectionEnum::OPEN->value);
        $this->assertSame('connecting', StatusConnectionEnum::CONNECTING->value);
        $this->assertSame('close', StatusConnectionEnum::CLOSE->value);
        $this->assertSame('refused', StatusConnectionEnum::REFUSED->value);
    }

    public function test_enum_has_labels(): void
    {
        $this->assertNotEmpty(StatusConnectionEnum::OPEN->getLabel());
        $this->assertNotEmpty(StatusConnectionEnum::CONNECTING->getLabel());
        $this->assertNotEmpty(StatusConnectionEnum::CLOSE->getLabel());
        $this->assertNotEmpty(StatusConnectionEnum::REFUSED->getLabel());
    }

    public function test_enum_has_colors(): void
    {
        $this->assertSame('success', StatusConnectionEnum::OPEN->getColor());
        $this->assertSame('warning', StatusConnectionEnum::CONNECTING->getColor());
        $this->assertSame('danger', StatusConnectionEnum::CLOSE->getColor());
        $this->assertSame('danger', StatusConnectionEnum::REFUSED->getColor());
    }

    public function test_enum_has_icons(): void
    {
        $this->assertNotEmpty(StatusConnectionEnum::OPEN->getIcon());
        $this->assertNotEmpty(StatusConnectionEnum::CONNECTING->getIcon());
        $this->assertNotEmpty(StatusConnectionEnum::CLOSE->getIcon());
        $this->assertNotEmpty(StatusConnectionEnum::REFUSED->getIcon());
    }
}
