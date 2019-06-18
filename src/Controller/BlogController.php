<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/blog/new", name="blog_create")
     */

    public function create(Request $request, ObjectManager $manager){
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add ('title')
            ->add ('content')
            ->add ('image')
            -> getForm();

        return $this->render ('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }



    /**
     * @Route("/blog/{id}", name="blog_show")
     */

    public function show(Article $article)
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);


        return $this->render('blog/show.html.twig',[
            'article' => $article
        ]);
    }





}



