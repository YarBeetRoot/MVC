<?php

class Model_News extends Db
{
    const TOP_NEWS = 1;

    public function __construct()
    {
        parent::__construct();
    }

    public function getNewsById($id)
    {
        $sql = $this->connection->prepare('SELECT *
                 FROM news
                 WHERE news_id = :id
                 ORDER BY news_date DESC
                 LIMIT 10');
        $sql->bindParam(':id',$id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNewsViews($id)
    {
        $sql = $this->connection->prepare('UPDATE `news` SET `news_views`= (`news_views` + 1) WHERE `news_id` = :id');
        $sql->bindParam(':id',$id);
        $sql->execute();
    }

    public function getNewsList()
    {
        $result = $this->connection->query(
            "SELECT *
                 FROM news
                 ORDER BY news_date DESC
                 LIMIT 10"
        );

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchNews(string $searchText = '')
    {
        $sql = $this->connection->prepare(
            'SELECT * FROM `news` 
            WHERE news.news_title LIKE :searchText
            OR news.news_content LIKE :searchText');
        $sql->bindParam(':searchText', $searchText, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastNews($count = 3) {
        $sql = $this->connection->prepare('SELECT * FROM `news` ORDER BY `news_id` DESC LIMIT :count');
        $sql->bindParam(':count', $count, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopNews() {
        $sql = $this->connection->prepare("SELECT * FROM news LEFT JOIN category ON news.news_cat_id = category.cat_id WHERE news_day = 1 ORDER BY news_date LIMIT 4");
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function getNewsCategories() {
//        $result = $this->connection->query(
//            "SELECT *
//                 FROM category"
//        );
//
//        return $result->fetchAll(PDO::FETCH_ASSOC);
//    }

    public function getNewsByCategory($category) {
        $sql = $this->connection->prepare('
      SELECT *
      FROM news
      LEFT JOIN category ON news.news_cat_id = category.cat_id
      WHERE `cat_code` = :category
    ');
        $sql->bindValue(':category', $category);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}