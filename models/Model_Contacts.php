<?php

class Model_Contacts extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function saveContactForm(array $mail)
    {
        $sql = $this->connection->prepare('INSERT INTO `mails` (`name`, `email`, `phone`, `message`) VALUES (:u_name, :email, :phone, :message)');
        $sql->bindParam(':u_name',$mail['name']);
        $sql->bindParam(':email',$mail['email']);
        $sql->bindParam(':phone',$mail['phone']);
        $sql->bindParam(':message',$mail['message']);
        $sql->execute();
    }
}