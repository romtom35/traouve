<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\State;
use App\Entity\Traobject;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TraobjectController
 * @package App\Controller
 * @Route("/category")
 */
class CategoryController extends BaseController
{
    /**
     * @Route("/show/{id}", name="category_show")
     */
    public function show(Category $category)
    {
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjectLosts = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, $category, $stateLost);
        $traobjectFounds = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(4, $category, $stateFound);
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'traobjectLosts' => $traobjectLosts,
            'traobjectFounds' => $traobjectFounds,
        ]);
    }
    /**
     * @Route("/showlost/{id}", name="category_show_lost")
     */
    public function showLost(Category $category)
    {
        $stateLost = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::LOST]);
        $traobjectLosts = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(99, $category, $stateLost);
        return $this->render('category/showlost.html.twig', [
            'category' => $category,
            'traobjectLosts' => $traobjectLosts
        ]);
    }
    /**
     * @Route("/showfound/{id}", name="category_show_found")
     */
    public function showFound(Category $category)
    {
        $stateFound = $this->getDoctrine()->getRepository(State::class)->findOneBy(["label" => State::FOUND]);
        $traobjectFounds = $this->getDoctrine()->getRepository(Traobject::class)->findLastTraobjectBy(99, $category, $stateFound);
        return $this->render('category/showfound.html.twig', [
            'category' => $category,
            'traobjectFounds' => $traobjectFounds
        ]);
    }

    public function footerList()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render(
            'category/footerList.html.twig',
            array('categories' => $categories)
        );

    }
}