<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 09/09/2019
 * Time: 00:09
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class HomeController
{

    public function index(): Response
    {
        return new Response('hello');
    }
}