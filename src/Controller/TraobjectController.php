<?php

namespace App\Controller;


use App\Entity\State;
use App\Entity\Traobject;
use App\Form\TraobjectType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @Route("/new", name="traobject_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $traobject = new traobject();
        $form = $this->createForm(TraobjectType::class, $traobject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traobject);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('traobject/new.html.twig', [
            'traobject' => $traobject,
            'form' => $form->createView(),
        ]);
    }
}