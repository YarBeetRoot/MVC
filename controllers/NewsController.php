<?php
include_once ROOT . '/models/Model_News.php';
include_once ROOT . '/controllers/Controller.php';

class NewsController extends Controller
{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new Model_News();
    }

    public function actionIndex($category = NULL)
    {
        if (!empty($category)) {
            $this->showNewsByCategory($category);
        }
        try {

            //var_dump($this->view); die;
            $this->view->title = 'News Index Page';
            $this->view->news = $this->newsModel->getNewsList();
            $this->view->categories = $this->newsModel->getNewsCategories();
            //$this->view->some_data = 'Hello World';
            //var_dump($this->view); die;
//            $this->view->time = time();
//            $this->view->count = count($result);
            $this->view->generateSideBar('news/side-bar.phtml');
            $this->view->generate('template_view.phtml', 'news/index.phtml');

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;
    }

    public function actionDetail($id)
    {
        $this->newsModel->updateNewsVisits($id);
        $this->view->detailNews = $this->newsModel->getNewsById($id);
        $this->view->generate('template_view.phtml', 'news/detail.phtml');
        //$result = Model_News::getNewsById($id);
        // require_once(ROOT . '/views/news/post.php');
        return true;
    }

    public function showNewsByCategory ($category) {
        try {

            $this->view->news = $this->newsModel->getNewsByCategory($category);
            $this->view->categories = $this->newsModel->getNewsCategories();
            $this->view->generateSideBar('news/side-bar.phtml');
            $this->view->generate('template_view.phtml', 'news/index.phtml');

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;

    }

}

