<?php

namespace App\Controller;


use App\Entity\State;
use App\Entity\Traobject;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TraobjectController
 * @package App\Controller
 * @Route("/traobject")
 */
class TraobjectController extends BaseController
{
    /**
     * @param Traobject $traobject
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/show/{id}", name="traobject_show")
     */
    public function show(Traobject $traobject)
    {
        return $this->render('traobject/show.html.twig', [
            'traobject' => $traobject
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/lost", name="traobjects_lost")
     */
    public function showLost(){
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $traobjects = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectByState($stateLost, 8);
        return $this->render('traobject/lost.html.twig', [
            'traobjects' => $traobjects
        ]);
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/found", name="traobjects_found")
     */
    public function showFound(){
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjects = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectByState($stateFound, 8);
        return $this->render('traobject/found.html.twig', [
            'traobjects' => $traobjects
        ]);
    }
}