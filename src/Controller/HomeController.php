<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/09/2019
 * Time: 00:09
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;



class HomeController extends AbstractController
{
    /*
     * @ Environment
     **/
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return new Response($this->twig->render('pages/home.html.twig'));
    }
}