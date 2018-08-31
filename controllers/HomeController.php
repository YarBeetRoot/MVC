<?php

include_once ROOT . '/controllers/Controller.php';

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndex($category = NULL)
    {

        try {

            $this->view->message = 'добро пожаловать на наш сайт :)';

            $this->view->generate('template_view.php', 'home/index.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;
    }


}