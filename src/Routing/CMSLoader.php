<?php

namespace App\Routing;

use App\Entity\Page;
use App\Utils\StringUtils;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;

class CMSLoader implements RouteLoaderInterface {
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadRoutes(): RouteCollection {
        $routes = new RouteCollection();

        $pages = $this->entityManager->getRepository(Page::class)->findAll();

        /** @var Page $page */
        foreach($pages as $page) {
            $defaults = [
                '_controller' => 'App\Controller\CMSController::page',
            ];

            $requirements = [
            ];

            $route = new Route($this->buildPath($page), $defaults, $requirements);

            $routes->add($page->getName(), $route);
        }

      return $routes;
    }

    private function buildPath(Page $page): string {
        $ret = $page->getPath();

        if ($page->getParent() !== null) {
            $ret = $this->buildPath($page->getParent()) . '/' . $ret;
        }

        return $ret;
    }

}
