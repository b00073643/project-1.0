<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16/04/2016
 * Time: 00:40
 */

namespace Itb\Controller;

use Itb\Model\Book;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class LoginController
{

    public function loginAction(Request $request, Application $app)
    {
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig',[]);
    }
    public function suc(Request $request, Application $app)
    {
        $templateName = 'loginSuccess';
        return $app['twig']->render($templateName . '.html.twig',[]);
    }
}