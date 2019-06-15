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
                ->setImage("https://images.gtsstatic.net/reno/imagereader.aspx?imageurl=http%3A%2F%2Fm.sothebysrealty.com%2F1103i215%2Ftts21f1s904p4da22y7jcv9s93i215&option=N&idclient=180&idlisting=180-l-3136-lxqp5n&w=1024&permitphotoenlargement=false")
                ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
