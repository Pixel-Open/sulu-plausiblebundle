<?php

declare(strict_types=1);

namespace Pixel\PlausibleBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Admin\Navigation\NavigationItem;
use Sulu\Bundle\AdminBundle\Admin\Navigation\NavigationItemCollection;
use Sulu\Bundle\AdminBundle\Admin\View\ViewBuilderFactoryInterface;
use Sulu\Bundle\AdminBundle\Admin\View\ViewCollection;

final class PlausibleAdmin extends Admin
{
    private const PLAUSIBLE_STATS_VIEW = 'app.plausible_stats';

    public function __construct(
        private readonly ViewBuilderFactoryInterface $viewBuilderFactory,
        private readonly string $domain,
        private readonly string $baseUrl,
        private readonly string $authKey
    ) {
    }

    public function configureNavigationItems(NavigationItemCollection $navigationItemCollection): void
    {
        $navigationItem = new NavigationItem('plausible.statistics');
        $navigationItem->setPosition(50);
        $navigationItem->setView(self::PLAUSIBLE_STATS_VIEW);
        $navigationItem->setIcon('fa-chart-line');

        $navigationItemCollection->add($navigationItem);
    }

    public function configureViews(ViewCollection $viewCollection): void
    {
        $viewCollection->add(
            $this->viewBuilderFactory
                ->createViewBuilder(self::PLAUSIBLE_STATS_VIEW, '/plausible', self::PLAUSIBLE_STATS_VIEW)
                ->setOption('domain', $this->domain)
                ->setOption('baseUrl', $this->baseUrl)
                ->setOption('authKey', $this->authKey)
        );
    }
}