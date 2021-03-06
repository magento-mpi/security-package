<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\ReCaptcha\Model;

/**
 * Return true if recaptcha is required in the context - SPI
 */
interface IsCheckRequiredInterface
{
    /**
     * Return true if check is required
     * @return bool
     */
    public function execute(): bool;
}
