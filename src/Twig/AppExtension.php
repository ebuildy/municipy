<?php


namespace App\Twig;


use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('data_find', [$this, 'dataFind']),
        ];
    }

    public function dataFind(string $entity) {
        $clazz = 'App\Entity\\' . ucwords($entity);

        return $this->entityManager->getRepository($clazz)->findAll();
    }
}