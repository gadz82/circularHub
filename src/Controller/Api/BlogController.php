<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractFOSRestController{

    /**
     * @Rest\Get("/api/blogs", methods="GET", name="api_blog_get_collection")
     */
    public function indexAction(PostRepository $postRepository) : Response
    {
        $data = $postRepository->findAll();
        $view = $this->view($data, 200);
        $view->getContext()->setGroups(['blog_list']);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/blog/{id}", methods="GET", name="api_blog_get_item")
     */
    public function listAction(Post $post) : Response
    {
        $view = $this->view($post, 200);
        $view->getContext()->setGroups(['blog_item']);
        return $this->handleView($view);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Rest\Post("/api/blogs", methods="POST", name="api_create_post")
     */
    public function createAction(Request $request) : Response
    {
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(PostType::class, $post, [
            'method' => 'post'
        ]);

        $form->submit($request->toArray());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            $view = $this->view($post, 200);
            $view->getContext()->setGroups(['blog_item']);

        } else {
            $view = $this->view($form);
        }
        return $this->handleView($view);

    }

}

