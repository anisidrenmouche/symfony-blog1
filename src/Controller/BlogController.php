<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\Validator\Constraints\DateTime;

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
     * @Route("/blog/apropos", name="blog_apropos")
     */
    public function create()
    {
        return $this->render('blog/apropos.html.twig');
    }





    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */

    public function form(Article $article = null, Request $request, ObjectManager $manager){
        if(!$article){
            $article = new Article();
        }

        $article->setTitle("")
            ->setContent("");

        /** $form = $this->createFormBuilder($article)
            ->add ('title')
            ->add ('content')
            ->add ('image')
             ->add ('save', SubmitType:: class, [
                'label' => 'Enregister'

            ->getForm();])*/

        $form = $this->createForm(ArticleType::class, $article);

        $article->setCreatedAt(new \DateTime());
        $form->handleRequest($request);

            if($form->isSubmitted()&& $form->isValid()){
                if(!$article->getId())
                    $article->setCreatedAt(new \DateTime());


                $manager->persist($article);
                $manager->flush();
                return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
            }


        return $this->render ('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !==null,
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



