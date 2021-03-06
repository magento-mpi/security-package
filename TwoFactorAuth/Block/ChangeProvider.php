<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\TwoFactorAuth\Block;

use Magento\Backend\Block\Template;
use Magento\Backend\Model\Auth\Session;
use Magento\User\Model\User;
use Magento\TwoFactorAuth\Api\TfaInterface;
use Magento\TwoFactorAuth\Api\ProviderInterface;

/**
 * Change provider block
 */
class ChangeProvider extends Template
{
    /**
     * @var TfaInterface
     */
    private $tfa;

    /**
     * @var Session
     */
    private $session;

    /**
     * ChangeProvider constructor.
     * @param Template\Context $context
     * @param Session $session
     * @param TfaInterface $tfa
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $session,
        TfaInterface $tfa,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->tfa = $tfa;
        $this->session = $session;

        if (!isset($data['provider'])) {
            throw new \InvalidArgumentException('A provider must be specified');
        }
    }

    /**
     * @inheritdoc
     */
    public function getJsLayout()
    {
        $providers = [];
        foreach ($this->getProvidersList() as $provider) {
            $providers[] = [
                'code' => $provider->getCode(),
                'name' => $provider->getName(),
                'auth' => $this->getUrl($provider->getAuthAction()),
                'icon' => $this->getViewFileUrl($provider->getIcon()),
            ];
        }

        $this->jsLayout['components']['tfa-change-provider']['switchIcon'] =
            $this->getViewFileUrl('Magento_TwoFactorAuth::images/change_provider.png');
        $this->jsLayout['components']['tfa-change-provider']['providers'] = $providers;

        return parent::getJsLayout();
    }

    /**
     * Get user
     * @return User|null
     */
    private function getUser(): ?User
    {
        return $this->session->getUser();
    }

    /**
     * Get a list of available providers
     * @return ProviderInterface[]
     */
    private function getProvidersList(): array
    {
        $res = [];

        $providers = $this->tfa->getUserProviders((int) $this->getUser()->getId());
        foreach ($providers as $provider) {
            if ($provider->getCode() !== $this->getData('provider')) {
                $res[] = $provider;
            }
        }

        return $res;
    }
}
