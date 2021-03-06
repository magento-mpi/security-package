<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\NotifierEvent\Model;

use Magento\NotifierEventApi\Model\CaptureEventInterface;
use Magento\NotifierEventApi\Model\FireRuleInterface\Proxy as FireRuleInterface;
use Magento\NotifierEventApi\Model\GetRulesIdsByEventInterface\Proxy as GetRulesIdsByEventInterface;
use Magento\NotifierEventApi\Model\IsEventExcludedInterface\Proxy as IsEventExcludedInterface;

class CaptureEvent implements CaptureEventInterface
{
    /**
     * @var GetRulesIdsByEventInterface
     */
    private $getRulesIdsByEvent;

    /**
     * @var FireRuleInterface
     */
    private $fireRule;

    /**
     * @var IsEventExcludedInterface
     */
    private $isEventExcluded;

    /**
     * @param GetRulesIdsByEventInterface\Proxy $getRulesIdsByEvent
     * @param FireRuleInterface\Proxy $fireRule
     * @param IsEventExcludedInterface\Proxy $isEventExcluded
     */
    public function __construct(
        GetRulesIdsByEventInterface\Proxy $getRulesIdsByEvent,
        FireRuleInterface\Proxy $fireRule,
        IsEventExcludedInterface\Proxy $isEventExcluded
    ) {
        $this->getRulesIdsByEvent = $getRulesIdsByEvent;
        $this->fireRule = $fireRule;
        $this->isEventExcluded = $isEventExcluded;
    }

    /**
     * @inheritdoc
     */
    public function execute(string $eventName, array $data = []): bool
    {
        if ($this->isEventExcluded->execute($eventName, $data)) {
            return false;
        }

        $ruleIds = $this->getRulesIdsByEvent->execute($eventName);
        foreach ($ruleIds as $ruleId) {
            $this->fireRule->execute((int) $ruleId, $eventName, $data);
        }

        return true;
    }
}
