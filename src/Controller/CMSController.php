<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CMSController extends AbstractController
{
    private $viewParameters = [];

    public function page(Request $request) {
        $page = $this->getPageObject($request);

        if (empty($page)) {
            $page = $this->getNotFoundPage();

            if (empty($page)) {
                throw new NotFoundHttpException('page not found and error page not found!');
            }

            return $this->redirect($page->getPath());
        }

        if ($page->getGenerator() !== null) {
            $entityClass = 'App\Entity\\' . ucwords($page->getGenerator());

            $entityObject = $this->getDoctrine()->getRepository($entityClass)->findOneBy(['slug' => $request->get('slug')]);

            $this->viewParameters['entity_object'] = $entityObject;
        }

        return $this->render('cms/pages/' . $page->getTemplate() . '.html.twig', [
            'page' => $page
        ]);
    }

    /**
     * Renders a view.
     */
    protected function render(string $view, array $parameters = [], Response $response = null): Response {
        return parent::render($view, $this->viewParameters + $parameters, $response);
    }

    /**
     * @param Request $request
     * @return Page|null
     */
    private function getNotFoundPage(): ?Page {
        return $this->getDoctrine()->getRepository(Page::class)->findOneBy(['name' => 'error404']);
    }

    /**
     * @param Request $request
     * @return Page|null
     */
    private function getPageObject(Request $request): ?Page {
        $routeName = $request->attributes->get('_route');

        return $this->getDoctrine()->getRepository(Page::class)->findOneBy(['name' => $routeName]);
    }
}
