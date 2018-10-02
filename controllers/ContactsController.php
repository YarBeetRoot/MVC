<?php

include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/components/Validator.php';
include_once ROOT .  '/models/Model_Contacts.php';

class ContactsController extends Controller
{
    private $contactsModel;

    public function __construct()
    {
        parent::__construct();
        $this->contactsModel = new Model_Contacts();
    }

    public function actionIndex()
    {
        $this->view->generate('template_view.phtml', 'contacts/index.phtml');
    }

    public function actionSendMail()
    {
        $validator = new Validator($_POST);
        $validator->text('name',3,30);
        $validator->text('message');

        if ($validator->hasErrors()){

            //редирект на статью, или там алерт, или чето еще
            var_dump($validator->getErrors());exit;
        }else{

            //save to DB and then redirect to news
            $this->contactsModel->saveContactForm($_POST);

        }

        $this->redirect('/contacts/?success=true');
    }
}