<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 16/09/2019
 * Time: 19:54
 */

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrickController extends AbstractController
{


    /**
     * @var TrickRepository
    */
    private $trickRepository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * AdminFormController constructor.
     * @param TrickRepository $trickRepository
     */

    public function __construct(TrickRepository $trickRepository, ObjectManager $objectManager)
    {
        $this->trickRepository = $trickRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/admin/tricks",name="admin.trick.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $tricks = $this->trickRepository->findAll();
        return $this->render('admin/tricks/index.html.twig',compact('tricks'));
    }

    /**
     * @Route("/admin/trick/{id}", name="admin.trick.edit")
     * @param Trick $trick
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Trick $trick,Request $request )
    {
         $form = $this->createForm(TrickType::class,$trick,  [
                "validation_groups" => ["Default", "add"]
             ]
         );
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $this->objectManager->persist($trick);
             $this->objectManager->flush();
             return $this->redirectToRoute('admin.trick.index');
         }
         return $this->render('admin/tricks/edit.html.twig', [
             'trick' => $trick,
             'form' => $form->createView(),
         ]);
    }

    /**
     * @Route("/admin/trick/create", name="admin.trick.new")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
         $trick = new Trick();
         $form = $this->createForm(TrickType::class);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $this->objectManager->persist($trick);
             $this->objectManager->flush();
             return $this->redirectToRoute('admin.trick.index');
         }
         return $this->render('admin/tricks/edit.html.twig', [
             'trick' => $trick,
             'form' => $form->createView(),
         ]);
    }
}