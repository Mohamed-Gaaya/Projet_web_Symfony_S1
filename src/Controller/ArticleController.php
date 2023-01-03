<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gedmo\Sluggable\Util\Urlizer;
class ArticleController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/article', name: 'article')]
    public function index(): Response
    { $articles = $this->entityManager->getRepository(Article::class)->findAll();
      
       
        return $this->render('article/index.html.twig',[
            'articles' =>$articles,
           
        ]);
    }

    #[Route('/article/article-add', name: 'article_add')]
    public function add(Request $request): Response
    {   $article = new Article();

        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $uploadedFile = $form['image']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = '-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
            $article->setUploadImage($newFilename);}
            $this->entityManager->persist($article);
            $this->entityManager->flush();
          
                return $this->redirectToRoute('article');
            }
           
           
        

        return $this->render('article/article_form.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/article/article-edit/{id}', name: 'article_edit')]
    public function edit(Request $request,$id): Response    
    {   $article = $this->entityManager->getRepository(Article::class)->findOneById($id);
        if(!$article ){
            return $this->redirectToRoute('article');
        }

        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $uploadedFile = $form['image']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = '-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
            $article->setUploadImage($newFilename);}
            $this->entityManager->flush();
            return $this->redirectToRoute('article');
           
        }

        return $this->render('article/article_edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/article/article-delete/{id}', name: 'article_delete')]
    public function delete($id): Response
    {   $article = $this->entityManager->getRepository(Categorie::class)->findOneById($id);
        if($article ){
            $this->entityManager->remove($article);
            $this->entityManager->flush();
        }
           
             return $this->redirectToRoute('article');
           
    }

        


   

}
