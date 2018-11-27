<?php

namespace App\Controller;


use App\Entity\Category;
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


        return $this->render('category/show.html.twig', [
            'category' => $category
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