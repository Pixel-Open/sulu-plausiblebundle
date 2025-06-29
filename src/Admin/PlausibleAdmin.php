<?php

declare(strict_types=1);

namespace Pixel\PlausibleBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Admin\Navigation\NavigationItem;
use Sulu\Bundle\AdminBundle\Admin\Navigation\NavigationItemCollection;
use Sulu\Bundle\AdminBundle\Admin\View\ViewBuilderFactoryInterface;
use Sulu\Bundle\AdminBundle\Admin\View\ViewCollection;
use Sulu\Component\Security\Authorization\PermissionTypes;
use Sulu\Component\Security\Authorization\SecurityCheckerInterface;

class PlausibleAdmin extends Admin
{
    private const PLAUSIBLE_STATS_VIEW = 'app.plausible_stats';

    private const SECURITY_CONTEXT = "plausible_stats";

    public function __construct(
        ViewBuilderFactoryInterface $viewBuilderFactory,
        SecurityCheckerInterface $securityChecker,
        string $domain,
        string $baseUrl,
        string $authKey
    ) {
        $this->viewBuilderFactory = $viewBuilderFactory;
        $this->securityChecker = $securityChecker;
        $this->domain = $domain;
        $this->baseUrl = $baseUrl;
        $this->authKey = $authKey;
    }

    private ViewBuilderFactoryInterface $viewBuilderFactory;
    private SecurityCheckerInterface $securityChecker;
    private string $domain;
    private string $baseUrl;
    private string $authKey;

    public function configureNavigationItems(NavigationItemCollection $navigationItemCollection): void
    {
        if (!$this->securityChecker->hasPermission(self::SECURITY_CONTEXT, PermissionTypes::VIEW)) {
            return;
        }

        $navigationItem = new NavigationItem('plausible.statistics');
        $navigationItem->setPosition(50);
        $navigationItem->setView(self::PLAUSIBLE_STATS_VIEW);
        $navigationItem->setIcon('fa-chart-line');

        $navigationItemCollection->add($navigationItem);
    }

    public function configureViews(ViewCollection $viewCollection): void
    {
        if (!$this->securityChecker->hasPermission(self::SECURITY_CONTEXT, PermissionTypes::VIEW)) {
            return;
        }

        $viewCollection->add(
            $this->viewBuilderFactory
                ->createViewBuilder(self::PLAUSIBLE_STATS_VIEW, '/plausible', self::PLAUSIBLE_STATS_VIEW)
                ->setOption('domain', $this->domain)
                ->setOption('baseUrl', $this->baseUrl)
                ->setOption('authKey', $this->authKey)
        );
    }

    public function getSecurityContexts(): array
    {
        return [
            self::SULU_ADMIN_SECURITY_SYSTEM => [
                'Plausible' => [
                    self::SECURITY_CONTEXT => [
                        PermissionTypes::VIEW
                    ],
                ],
            ],
        ];
    }
}