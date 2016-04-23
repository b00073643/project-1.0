<?php
// load classes
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

use Itb\Controller\MainController;

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'itb');

$templatesPath = __DIR__.'/../templates';
$app = new \Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(),[
    'twig.path'=>$templatesPath
]);
$app->get('/','Itb\Controller\MainController::indexAction');
$app->get('/list','Itb\Controller\MainController::listAction');
$app->get('/studentList','Itb\Controller\MainController::studentList');
$app->get('/show/{id}','Itb\Controller\MainController::showAction');
$app->get('/show/','Itb\Controller\MainController::showMissingAction');
$app->get('/login','Itb\Controller\LoginController::loginAction');
$app->get('/listModel','Itb\Controller\MainController::listModAction');
$app->get('/double','Itb\Controller\MainController::doubleIMMCreditsAction');
$app->get('/doubleSeen','Itb\Controller\MainController::doubleSeen');
$app->get('/listSingleStudent/{id}','Itb\Controller\MainController::listSingleStudent');



$app->error(function (\Exception $e, $code) use ($app) {


    $mainController = new \Itb\Controller\MainController();
    return $mainController->errorAction($app, $code);
});

$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
$mainController = new MainController();

switch ($action){

    case 'processLogin':
        header("Location: /suc"); /* Redirect browser */
        exit();
        break;

    //---------- main ROUTES ---------------
    case 'login':

        $mainController->loginAction();
        break;

    case 'doubleIMMCredits':
        header("Location: /double"); /* Redirect browser */
        exit();
        break;

    case 'doubleSeen':
        header("Location: /doubleSeen"); /* Redirect browser */
        exit();
        break;


}
$app->run();

?>

