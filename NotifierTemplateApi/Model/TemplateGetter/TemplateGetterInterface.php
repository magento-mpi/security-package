<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\NotifierTemplateApi\Model\TemplateGetter;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Template getter (Service Provider Interface - SPI)
 *
 * @api
 */
interface TemplateGetterInterface
{
    /**
     * Get template content
     * @param string $channelCode
     * @param string $templateId
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function getTemplate(string $channelCode, string $templateId): ?string;

    /**
     * Get a list of available templates
     * @return array
     */
    public function getList(): array;
}
