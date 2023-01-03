<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    #[Route('/categorie', name: 'categorie')]
    public function index(): Response
    {  
        $categories = $this->entityManager->getRepository(Categorie::class)->findAll();
        //dd($categories);
            return $this->render('categorie/index.html.twig',[
               'categories' =>$categories,
            ]);
            
         }

         #[Route('/categorie/categorie-add', name: 'categorie_add')]
         public function add(Request $request): Response
         {   $categorie = new Categorie();
     
             $form = $this->createForm(CategorieType::class,$categorie);
     
             $form->handleRequest($request);
     
             if($form->isSubmitted() && $form->isValid()){
                
                 $this->entityManager->persist($categorie);
                 $this->entityManager->flush();
               
                     return $this->redirectToRoute('categorie');
                 }
                
                
             
     
             return $this->render('categorie/categorie_form.html.twig',[
                 'form' => $form->createView()
             ]);
         }
     
         #[Route('/categorie/categorie-edit/{id}', name: 'categorie_edit')]
         public function edit(Request $request,$id): Response
         {   $categorie = $this->entityManager->getRepository(Categorie::class)->findOneById($id);
             if(!$categorie ){
                 return $this->redirectToRoute('categorie');
             }
     
             $form = $this->createForm(CategorieType::class,$categorie);
     
             $form->handleRequest($request);
     
             if($form->isSubmitted() && $form->isValid()){
                 $this->entityManager->flush();
                 return $this->redirectToRoute('categorie');
                
             }
     
             return $this->render('categorie/categorie_edit.html.twig',[
                 'form' => $form->createView()
             ]);
         }
     
         #[Route('/categorie/categorie-delete/{id}', name: 'categorie_delete')]
         public function delete($id): Response
         {   $categorie = $this->entityManager->getRepository(Categorie::class)->findOneById($id);
             if($categorie ){
                 $this->entityManager->remove($categorie);
                 $this->entityManager->flush();
             }
                
                  return $this->redirectToRoute('categorie');
                
         }
     
             
     

        
    
}
