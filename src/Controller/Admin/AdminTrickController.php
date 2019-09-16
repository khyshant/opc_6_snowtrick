<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 16/09/2019
 * Time: 19:54
 */

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrickController extends AbstractController
{


    /**
     * @var TrickRepository
    */
    private $trickRepository;
    /**
     * AdminFormController constructor.
     * @param TrickRepository $trickRepository
     */
    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    /**
     * @Route("/admin",name="admin.trick.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $tricks = $this->trickRepository->findAll();
        return $this->render('admin/tricks/index.html.twig',compact('tricks'));
    }

    /**
     * @Route("/admin/{id}", name="admin.trick.edit")
     * @param Trick $trick
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Trick $trick)
    {
         return $this->render('admin/tricks/edit.html.twig',compact('trick'));
    }
}