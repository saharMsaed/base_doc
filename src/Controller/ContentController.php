<?php

namespace App\Controller;

use App\Entity\Content;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    /**
     * @Route("/content/{id}", name="content")
     */
    public function index(Content $content): Response
    {
        return $this->render('content/index.html.twig', [
            'content' => $content,
        ]);
    }
}
