<?php

declare(strict_types=1);

namespace EonX\EasyStandard\Tests\Sniffs\Classes\AvoidPublicPropertiesSniff;

use EonX\EasyStandard\Sniffs\Classes\AvoidPublicPropertiesSniff;
use Iterator;
use Symplify\EasyCodingStandardTester\Testing\AbstractCheckerTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class AvoidPublicPropertiesSniffTest extends AbstractCheckerTestCase
{
    /**
     * @return array<int, SmartFileInfo|int>
     */
    public function providerTestSniff(): Iterator
    {
        yield [new SmartFileInfo(__DIR__ . '/Fixture/AvoidPublicPropertiesSniffTest.php.inc'), 1];
    }

    /**
     * @dataProvider providerTestSniff()
     */
    public function testSniff(SmartFileInfo $smartFileInfo, int $expectedErrorCount): void
    {
        $this->doTestFileInfoWithErrorCountOf($smartFileInfo, $expectedErrorCount);
    }

    protected function getCheckerClass(): string
    {
        return AvoidPublicPropertiesSniff::class;
    }
}
