<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\TwoFactorAuth\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Magento\TwoFactorAuth\Api\Data\UserConfigExtensionInterface;
use Magento\TwoFactorAuth\Api\Data\UserConfigInterface;

/**
 * @inheritDoc
 */
class UserConfig extends AbstractExtensibleObject implements UserConfigInterface
{
    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return (int) $this->_get(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId(int $value): void
    {
        $this->setData(self::ID, $value);
    }

    /**
     * @inheritDoc
     */
    public function getUserId(): int
    {
        return (int) $this->_get(self::USER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setUserId(int $value): void
    {
        $this->setData(self::USER_ID, $value);
    }

    /**
     * @inheritDoc
     */
    public function getEncodedProviders(): string
    {
        return (string) $this->_get(self::ENCODED_PROVIDERS);
    }

    /**
     * @inheritDoc
     */
    public function setEncodedProviders(string $value): void
    {
        $this->setData(self::ENCODED_PROVIDERS, $value);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultProvider(): string
    {
        return (string) $this->_get(self::DEFAULT_PROVIDER);
    }

    /**
     * @inheritDoc
     */
    public function setDefaultProvider(string $value): void
    {
        $this->setData(self::DEFAULT_PROVIDER, $value);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes(): ?UserConfigExtensionInterface
    {
        return $this->_get(self::EXTENSION_ATTRIBUTES_KEY);
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(UserConfigExtensionInterface $extensionAttributes): void
    {
        return $this->setData(self::EXTENSION_ATTRIBUTES_KEY, $extensionAttributes);
    }
}
