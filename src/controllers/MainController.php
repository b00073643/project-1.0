<?php

namespace Itb\Controller;

use Itb\Model\Book;
use Itb\Model\Student;
use Itb\Model\Module;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{

    public function doubleIMMCreditsAction(Request $request,Application $app)
    {
        echo 'getting in here ya whooore';
        // we looked this up manually in the DB

        $id = 3;

        /**
         * @var $moduleIMM Module
         */
            $moduleIMM = Module::getOneById($id);

            $oldCredits = $moduleIMM->getCredits();
            $newCredits = 2 * $oldCredits;
            $moduleIMM->setCredits($newCredits);

            $updateSuccess = Module::update($moduleIMM);

            if($updateSuccess) {
                $argsArray = [
                    'module' => $moduleIMM
                ];
                $templateName = 'listSingle';

                return $app['twig']->render($templateName . '.html.twig', $argsArray);
            }
    }

    public function doubleSeen(Request $request,Application $app)
    {
        // we looked this up manually in the DB

        $id = 2;

        /**
         * @var $moduleIMM Module
         */
        $student = Student::getOneById($id);

        $oldSeen = $student->getSeen();
        $newS = $oldSeen+1;
        $student->setSeen($newS);
        $newSeen = $student->getSeen();

       $updateSuccess = Student::update($student);
//
            $argsArray = [
                'student' => $student,
                'oldseen' =>$oldSeen,
                'newseen' =>$newSeen
            ];
            $templateName = 'listSingleStudent';

            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }



    public function listSingleStudent(Request $request,Application $app,$id)
    {
        echo'gettgtgergdrf';
        $id=2;
        $student = Student::getOneById($id);


        $argsArray = [
            'student' => $student,
        ];
        $templateName = 'listSingleStudent';

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function listModAction(Request $request,Application $app)
    {
        $modules = Module::getAll();

            $argsArray = [
                'modules'=> $modules
            ];
            $templateName = 'listMod';

            return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
    public function studentList(Request $request, Application $app)
    {echo"student";
        $students = Student::getAll();
        $argsArray = [
            'students' => $students
        ];
        $templateName = 'studentList';

        return $app['twig']->render($templateName . '.html.twig', $argsArray);

    }

    public function indexAction(Request $request, Application $app)
    {
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig',[]);
    }

    public function hello()
    {
       print 'hello there world';
    }
    public function listAction(Request $request, Application $app)
    {
        $books = Book::getAll();
        $argsArray = [
            'books'=> $books
        ];
        $templateName = 'list';

        return $app['twig']->render($templateName . '.html.twig', $argsArray);

    }

    public function showAction(Request $request, Application $app, $id)
    {
        $book = Book::getOneById($id);

        $message= 'Sorry no book could be found with the ID number'.$id;

        $argsArray = [
            'message'=> $message
        ];
        $templateName='error';
        if(null != $book) {
            $argsArray = [
                'book' => $book
            ];

            $templateName = 'show';
        }

        return $app['twig']->render($templateName . '.html.twig', $argsArray);

    }
    public function showMissingAction(Request $request, Application $app)
    {

        $message= 'Sorry no ID was entered';

        $argsArray = [
            'message'=> $message
        ];
        $templateName='error';

        return $app['twig']->render($templateName . '.html.twig', $argsArray);

    }

    public function errorAction(Application $app, $code)
    {
        $message = '404 Error sorry cant find resource';
        if($code != 404)
        {
            $message='Sorry UNKOWN ERROR OCCURRED';
        }
        $argsArray = [
            'message'=> $message
        ];
        $templateName='error';

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}