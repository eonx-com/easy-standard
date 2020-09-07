<?php

declare(strict_types=1);

namespace EonX\EasyStandard\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\Contract\PhpDocNode\AttributeAwareNodeInterface;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class UselessSingleAnnotationRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const ANNOTATIONS = 'annotations';

    /**
     * @var string[]
     */
    private $annotations = [];

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    public function refactor(Node $node): ?Node
    {
        /** @var \PhpParser\Node\Stmt\ClassMethod $classMethod */
        $classMethod = $node;

        /** @var \Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo $phpDocInfo */
        $phpDocInfo = $classMethod->getAttribute(AttributeKey::PHP_DOC_INFO);

        /** @var AttributeAwareNodeInterface[] $children */
        $children = $phpDocInfo->getPhpDocNode()->children;

        if (\count($children) === 1 &&
            \in_array($children[0]->getAttribute('original_content'), $this->annotations, true)) {
            $phpDocInfo->getPhpDocNode()->children = [];
        }

        return $classMethod;
    }

    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition(
            'Removes PHPDoc completely if it contains only useless single annotation.',
            [
                new CodeSample(
                    <<<'PHP'
/**
 * {@inheritDoc}
*/
public function someMethod(): array
{
}
PHP
                    ,
                    <<<'PHP'
public function someMethod(): array
{
}
PHP
                ),
            ]
        );
    }

    public function configure(array $configuration): void
    {
        $this->annotations = $configuration[self::ANNOTATIONS] ?? [];
    }
}
