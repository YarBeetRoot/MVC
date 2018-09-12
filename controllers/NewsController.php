<?php
include_once ROOT . '/models/Model_News.php';
include_once ROOT . '/models/Model_Categories.php';
include_once ROOT . '/models/Model_Comments.php';
include_once ROOT . '/controllers/Controller.php';

class NewsController extends Controller
{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new Model_News();
        $this->categoriesModel = new Model_Categories();
        $this->commentsModel = new Model_Comments();

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
            //$this->view->categories = $this->newsModel->getNewsCategories();
            $this->view->categories = $this->categoriesModel->getCategories();

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
        try {
            $this->newsModel->updateNewsViews($id);

            $this->view->detailNews = $this->newsModel->getNewsById($id);

            $this->view->categories = $this->categoriesModel->getCategories();

            $this->view->comments = $this->commentsModel->getComments($id);

            $this->view->generateSideBar('news/side-bar.phtml');

            $this->view->generate('template_view.phtml', 'news/detail.phtml');
            //$result = Model_News::getNewsById($id);
            // require_once(ROOT . '/views/news/post.php');
            //var_dump($test);die;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;
    }

    public function showNewsByCategory ($category) {
        try {

            if ($this->newsModel->getNewsByCategory($category)){
                $this->view->news = $this->newsModel->getNewsByCategory($category);
            }else{
                $this->view->news = 'такой категории нет!';
            }

            //$this->view->categories = $this->newsModel->getNewsCategories();
            $this->view->categories = $this->categoriesModel->getCategories();

            $this->view->generateSideBar('news/side-bar.phtml');
            $this->view->generate('template_view.phtml', 'news/index.phtml');

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return true;

    }
}

