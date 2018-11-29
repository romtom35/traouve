<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Traobject;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController
 * @package App\Controller
 * @Route("/comment")
 */
class CommentController extends BaseController
{
    /**
     * @Route("/new/{id}", name="comment_new", methods="GET|POST")
     */
    public function new(Traobject $traobject, Request $request): Response
    {
        $comment = new Comment();
        $comment->setUser($this->getUser());
        $comment->setTraobject($traobject);

        $form = $this->createForm(CommentType::class, $comment, [
            'action' => $this->generateUrl('comment_new', ['id' => $traobject->getId()])
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('traobject_show', ['id' => $traobject->getId()]);
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

}