<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Controller
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/create", name="post_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, [
            "validation_groups" => ["Default", "add"]
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("post/create.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}/update", name="post_update")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render("post/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
