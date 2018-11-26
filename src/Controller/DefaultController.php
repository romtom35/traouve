<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Traobject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $traobjects = $this->getDoctrine()->getRepository(Traobject::class)->findAll();
        return $this->render('default/homepage.html.twig', [
            'traobjects' => $traobjects
        ]);
    }
}