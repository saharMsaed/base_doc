<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\SearchType;
use App\Classes\SearchClass;
use App\Entity\ContentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    private $em;

    public function __construct (EntityManagerInterface $em){
        $this->em= $em;
    } 
    
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        $contentTypes= $this->em->getRepository(ContentType::class)->findAll();

        $search= new SearchClass();
        $form= $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $search !== null){
            $contents= $this->em->getRepository(Content::class)->advancedResearch($search);
        } else $contents= $this->em->getRepository(Content::class)->findAll();

        
        return $this->render('home/index.html.twig', [
            'contents' => $contents,
            'contentTypes' => $contentTypes,
            'form' =>$form->createView()
        ]);
    }
}
