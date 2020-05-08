<?php

declare(strict_types=1);

namespace EonX\EasyStandard\Tests\Rector\AddSeeAnnotationRector;

use EonX\EasyStandard\Rector\AddSeeAnnotationRector;
use Iterator;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;

/**
 * @covers \EonX\EasyStandard\Rector\AddSeeAnnotationRector
 *
 * @internal
 */
final class AddSeeAnnotationRectorTest extends AbstractRectorTestCase
{
    /**
     * Provides test examples.
     *
     * @return Iterator<array>
     */
    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    /**
     * Tests Rector rule.
     *
     * @dataProvider provideData()
     */
    public function testRule(string $file): void
    {
        $this->doTestFile($file);
    }

    /**
     * Returns Rector with configuration.
     *
     * @return mixed[]
     */
    protected function getRectorsWithConfiguration(): array
    {
        return [
            AddSeeAnnotationRector::class => [],
        ];
    }
}
