<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i =1; $i <= 10; $i++){
            $article = new Article();
            $article->setTitle("Le titre des artciles n°$i")
                ->setContent("<p>Contenu de l'article n°$i </p>")
                ->setImage("")
                ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
