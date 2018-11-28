<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\State;
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
        $categories = $this->getDoctrine()->getRepository(Category::class)->findBY([], ['label' => 'ASC']);
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjectLosts = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateLost);
        $traobjectfounds = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateFound);
        return $this->render('default/homepage.html.twig', [
            'traobjectLosts' => $traobjectLosts,
            'traobjectFounds' => $traobjectfounds,
            'categories' => $categories

        ]);
    }
}