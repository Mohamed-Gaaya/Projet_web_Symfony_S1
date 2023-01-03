<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'home')]
    public function index(): Response
    {   $articles = $this->entityManager->getRepository(Article::class)->findAll();
           return $this->render('home/index.html.twig',[
        'articles' =>$articles,
        
    ]);
    }

    #[Route('/product/{libelle}', name: 'product')]
    public function show($libelle): Response
    {   
        $article = $this->entityManager->getRepository(Article::class)->findOneByLibelle($libelle);
        if(!$article){
            return $this->redirectToRoute('home');
        }
        return $this->render('home/show.html.twig',[
            'article' =>$article 
        ]);
    }
}
