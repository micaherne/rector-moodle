<?php

namespace RectorMoodle\Rule\Transform\Rector;

use InvalidArgumentException;
use PhpParser\Node;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use RectorMoodle\Rule\Transform\ValueObject\ConstFetchToClassConstFetch;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class ConstFetchToClassConstFetchRector extends AbstractRector implements ConfigurableRectorInterface
{

    /**
     * @var ConstFetchToClassConstFetch[]
     */
    private array $constFetchToClassConsts = [];

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change const fetch to class const fetch', [
            new ConfiguredCodeSample('$x = CONSTANT', '$x = Class::CONSTANT', [
                new ConstFetchToClassConstFetch('CONSTANT', 'Class', 'CONSTANT')
            ]),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getNodeTypes(): array
    {
        return [Node\Expr\ConstFetch::class];
    }

    /**
     * @inheritDoc
     */
    public function refactor(Node $node)
    {
        foreach ($this->constFetchToClassConsts as $constFetchToClassConst) {
            if (!$this->isName($node, $constFetchToClassConst->getOldConstName())) {
                continue;
            }
            return $this->nodeFactory->createClassConstFetch(
                $constFetchToClassConst->getNewClassName(),
                $constFetchToClassConst->getNewConstName()
            );
        }
        return null;
    }

    public function configure(array $configuration): void
    {
        foreach ($configuration as $obj) {
            if (!$obj instanceof ConstFetchToClassConstFetch) {
                throw new InvalidArgumentException('Invalid configuration');
            }
        }
        $this->constFetchToClassConsts = $configuration;
    }
}
