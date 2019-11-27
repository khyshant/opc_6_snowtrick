<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 26/11/2019
 * Time: 13:12
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class AdminController extends AbstractController
{
    /**
     * @Route("/admin",name="admin.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}