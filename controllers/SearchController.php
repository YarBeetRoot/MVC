<?

include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_News.php';
include_once ROOT . '/models/Model_Categories.php';

class SearchController extends Controller
{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new Model_News();
        $this->categoriesModel = new Model_Categories();


    }

    public function actionIndex()
    {
        if (isset($_GET['blog-search']) && !empty($_GET['blog-search'])) {
            $searchText = "%{$_GET['blog-search']}%";

            $this->view->news = $this->newsModel->searchNews($searchText);

            $this->view->categories = $this->categoriesModel->getCategories();

            $this->view->generateSideBar('news/side-bar.phtml');
            $this->view->generate('template_view.phtml', 'news/index.phtml');
        }else{
            $this->redirect('/news');
        }
    }

}
