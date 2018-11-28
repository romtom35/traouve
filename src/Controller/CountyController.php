<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\County;
use App\Entity\State;
use App\Entity\Traobject;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CountyController
 * @package App\Controller
 * @Route("/county")
 */
class CountyController extends BaseController
{
    /**
     * @Route("/show/{id}", name="county_show")
     */
    public function show(County $county)
    {
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjectLosts = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateLost, $county);
        $traobjectFounds = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, null, $stateFound, $county);
        return $this->render('county/show.html.twig', [
            'county' => $county,
            'traobjectLosts' => $traobjectLosts,
            'traobjectFounds' => $traobjectFounds,
        ]);
    }
    /**
     * @Route("/showlost/{id}", name="county_show_lost")
     */
    public function showLost(County $county)
    {
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $traobjectLosts = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(99, null, $stateLost, $county);
        return $this->render('county/showlost.html.twig', [
            'county' => $county,
            'traobjectLosts' => $traobjectLosts
        ]);
    }
    /**
     * @Route("/showfound/{id}", name="county_show_found")
     */
    public function showFound(County $county)
    {
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjectFounds = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(99, null, $stateFound, $county);
        return $this->render('county/showfound.html.twig', [
            'county' => $county,
            'traobjectFounds' => $traobjectFounds
        ]);
    }

    public function footerList()
    {
        $counties = $this->getDoctrine()->getRepository(County::class)->findAll();

        return $this->render(
            'county/footerList.html.twig',
            array('counties' => $counties)
        );

    }
}