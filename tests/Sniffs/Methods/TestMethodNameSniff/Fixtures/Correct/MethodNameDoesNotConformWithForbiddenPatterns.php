<?php

declare(strict_types=1);

namespace EonX\EasyStandard\Tests\Sniffs\Methods\TestMethodNameSniff\Fixtures\Correct;

final class MethodNameDoesNotConformWithForbiddenPatterns
{
    public function testShowSucceeds(): void
    {
        // No body needed here
    }
}
