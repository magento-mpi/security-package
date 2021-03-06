<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\NotifierTemplate\Model\VariablesDecorator;

use Magento\Backend\Model\Auth\Session;
use Magento\NotifierTemplateApi\Model\VariablesDecorator\DecorateVariablesInterface;

class AdminVariables implements DecorateVariablesInterface
{
    /**
     * Variable name for admin user
     */
    private const VARIABLE_ADMIN_USER = '_adminUser';

    /**
     * @var Session
     */
    private $session;

    /**
     * CoreDecorator constructor.
     * @param Session $session
     */
    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $data): array
    {
        $data[self::VARIABLE_ADMIN_USER] = $this->session->getUser();
        return $data;
    }
}
