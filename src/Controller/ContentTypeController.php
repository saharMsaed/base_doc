<?php

namespace App\Controller;

use App\Entity\ContentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentTypeController extends AbstractController
{
    /**
     * @Route("/content/type/{id}", name="content_type")
     */
    public function index(ContentType $contentType): Response
    {
        return $this->render('content_type/index.html.twig', [
            'contentType' => $contentType,
        ]);
    }
}
