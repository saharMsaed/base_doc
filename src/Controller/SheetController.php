<?php

namespace App\Controller;

use App\Entity\Sheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SheetController extends AbstractController
{
    /**
     * @Route("/sheet/{id}", name="sheet")
     */
    public function index(Sheet $sheet): Response
    {
        return $this->render('sheet/index.html.twig', [
            'sheet' => $sheet,
        ]);
    }
}
