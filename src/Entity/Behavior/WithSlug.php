<?php


namespace App\Entity\Behavior;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

interface WithSlug
{
    public function slugify(Slugify $slugger);
}