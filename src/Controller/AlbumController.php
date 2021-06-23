<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlbumRepository;
use App\Repository\ImageRepository;
use App\Repository\CommentRepository;
use App\Form\CommentType;
use App\Entity\Comment;
use Psr\Log\LoggerInterface;

class AlbumController extends AbstractController
{
   #[Route('/{page<\d+>}', defaults: ['page' => 1], name: "index_paginated")]
    public function index(Request $request, int $page, AlbumRepository $albums, LoggerInterface $logger): Response
    {
        $logger->info('!!!!!');
        $next = $albums->findNext($page);
        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
            'paginator' => $next,
        ]);
    }

    #[Route('/album/{id<\d+>}/{page<\d+>}', defaults: ['page' => 1], name: 'album_paginated')]
    public function album(Request $request, int $id, int $page, AlbumRepository $albums, ImageRepository $images): Response
    {
        if(is_null($id)) {
            return $this->redirectToRoute("index_paginated");
        }

        $album = $albums->findById($id);
        if (is_null($album)) {
            return $this->redirectToRoute("index_paginated");
        }
        $album_images = $images->findByAlbumId($id, $page);
        return $this->render('album/images.html.twig', [
            'controller_name' => 'AlbumController',
            'album' => $album,
            'paginator' => $album_images,
        ]);
    }

    #[Route('/image/{albumid<\d+>}/{id<\d+>}', name: 'image')]
    public function image(Request $request, int $albumid, int $id, AlbumRepository $albums, ImageRepository $images, CommentRepository $comments): Response
    {
        if(is_null($albumid)) {
            return $this->redirectToRoute("index_paginated");
        }
        if(is_null($id)) {
            return $this->redirectToRoute("album_paginated", ["id" => $albumid]);
        }
        $album = $albums->findById($albumid);
        if (is_null($album)) {
            return $this->redirectToRoute("index_paginated");
        }
        $image = $images->findById($id);
        if (is_null($image)) {
            return $this->redirectToRoute("album_paginated", ["id" => $albumid]);
        }
        $comment = new Comment();
//        $comment->setImage($image);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setImage($image);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->redirectToRoute("image", ["albumid" => $albumid, "id" => $id]);
        }

        $image_comments = $comments->findByImageId($id);
        return $this->render('album/image.html.twig', [
            'controller_name' => 'AlbumController',
            'album' => $album,
            'image' => $image,
            'comments' => $image_comments,
            'form' => $form->createView(),
        ]);
    }


}
