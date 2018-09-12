<?php

class Model_Categories extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories() {
        $sql = $this->connection->prepare('SELECT * FROM category');
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}