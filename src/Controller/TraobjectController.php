<?php

namespace App\Controller;


use App\Entity\Comment;
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
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findByTraobject($traobject);
        return $this->render('traobject/show.html.twig', [
            'traobject' => $traobject,
            'comments' => $comments
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/lost", name="traobjects_lost")
     */
    public function showLost()
    {
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $traobjects = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateLost);
        return $this->render('traobject/lost.html.twig', [
            'traobjects' => $traobjects
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/found", name="traobjects_found")
     */
    public function showFound()
    {
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjects = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateFound);
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

            $traobject->setUser($this->getUser());
            $state = $this->getDoctrine()->getRepository(State::class)->find($request->get('state_id'));
            $traobject->setState($state);

            $em->persist($traobject);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);

        return $this->render('traobject/new.html.twig', [
            'traobject' => $traobject,
            'formFound' => $form->createView(),
            'formLost' => $form->createView(),
            'stateFound' => $stateFound,
            'stateLost' => $stateLost,
        ]);
    }
    /**
     * @Route("/newlost", name="traobject_new_lost", methods="GET|POST")
     */
    public function newLost(Request $request): Response
    {
        $traobject = new traobject();
        $form = $this->createForm(TraobjectType::class, $traobject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $traobject->setUser($this->getUser());
            $state = $this->getDoctrine()->getRepository(State::class)->find($request->get('state_id'));
            $traobject->setState($state);

            $em->persist($traobject);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        return $this->render('traobject/newlost.html.twig', [
            'traobject' => $traobject,
            'form' => $form->createView(),
            'stateLost' => $stateLost,
        ]);
    }
    /**
     * @Route("/newFound", name="traobject_new_found", methods="GET|POST")
     */
    public function newFound(Request $request): Response
    {
        $traobject = new traobject();
        $form = $this->createForm(TraobjectType::class, $traobject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $traobject->setUser($this->getUser());
            $state = $this->getDoctrine()->getRepository(State::class)->find($request->get('state_id'));
            $traobject->setState($state);

            $em->persist($traobject);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        return $this->render('traobject/newfound.html.twig', [
            'traobject' => $traobject,
            'form' => $form->createView(),
            'stateFound' => $stateFound,
        ]);
    }


}
