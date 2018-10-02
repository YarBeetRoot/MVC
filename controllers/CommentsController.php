<?php

include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/components/Validator.php';
include_once ROOT .  '/models/Model_Comments.php';

class CommentsController extends Controller
{
    private $commentsModel;

    public function __construct()
    {
        //parent::__construct();
        $this->commentsModel = new Model_Comments();
    }

    public function actionAddcomment($id){

        //validate all comment field
        //check name

        $validator = new Validator($_POST);
        $validator->text('name',3,30);
        $validator->text('comment');

        //$errors = $validator->getErrors();

        //$errors = $this->_checkCommentInput($_POST);
        if ($validator->hasErrors()){

            //редирект на статью, или там алерт, или чето еще
            var_dump($validator->hasErrors());exit;
        }else{

            //save to DB and then redirect to news
            $this->commentsModel->saveComment($_POST);

        }

        $this->redirect('/news/details/'.$id);
    }

    /*protected function _checkCommentInput($inpudData){

        $errors = [];
        if (!isset($_POST['name'])){
            $errors[]="Введите правильное имя";
        }

        return $errors;
    }*/
}