<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 16/09/2019
 * Time: 19:54
 */

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMediaController extends AbstractController
{


    /**
     * @var mediaRepository
    */
    private $MediaRepository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AdminFormController constructor.
     * @param mediaRepository $MediaRepository
     */

    public function __construct(mediaRepository $MediaRepository, ObjectManager $objectManager)
    {
        $this->mediaRepository = $MediaRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/admin/medias",name="admin.media.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $medias = $this->mediaRepository->findAll();
        return $this->render('admin/media/index.html.twig',compact('medias'));
    }

    /**
     * @Route("/admin/media/{id}", name="admin.media.edit")
     * @param Media $media
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Media $media,Request $request )
    {
         $form = $this->createForm(MediaType::class,$media );
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $this->objectManager->flush();
             $this->objectManager->persist($media);
             return $this->redirectToRoute('admin.media.index');
         }
         return $this->render('admin/media/edit.html.twig', [
             'media' => $media,
             'form' => $form->createView(),
         ]);
    }

    /**
     * @Route("/admin/media/create", name="admin.media.new")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
         $media = new Media();
         $form = $this->createForm(MediaType::class);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             

             $this->objectManager->persist($trick);
             $this->objectManager->flush();
             return $this->redirectToRoute('admin.media.index');
         }
         return $this->render('admin/media/edit.html.twig', [
             'media' => $media,
             'form' => $form->createView(),
         ]);
    }
}