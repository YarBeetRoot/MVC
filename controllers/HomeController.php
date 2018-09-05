<?php

include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_News.php';

class HomeController extends Controller
{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new Model_News();
    }

    public function actionIndex($category = NULL)
    {

        try {

            $this->view->lastNews = $this->newsModel->getLastNews();
            $this->view->topNews = $this->newsModel->getTopNews();

            $this->view->generate('template_view.phtml', 'home/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;
    }


}