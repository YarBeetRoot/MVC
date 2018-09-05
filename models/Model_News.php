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
        $sth = $this->connection->prepare('SELECT *
                 FROM news
                 WHERE news_id = :id
                 ORDER BY news_date DESC
                 LIMIT 10');
        $sth->bindParam(':id',$id);
        $sth->execute();

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNewsVisits($id)
    {
        $sth = $this->connection->prepare('UPDATE `news` SET `visits`= `visits` + 1 WHERE `news_id` = :id');
        $sth->bindParam(':id',$id);
        $sth->execute();
//        $this->connection->query(
//            "UPDATE `news` SET `visits`= `visits` + 1 WHERE `news_id` = $id"
//        );
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

    public function getLastNews($count = 3) {
        $sth = $this->connection->prepare('SELECT * FROM `news` LIMIT :count');
        $sth->bindParam(':count', $count, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopNews() {
        $sth = $this->connection->prepare('
      SELECT *
      FROM news
      LEFT JOIN category ON news.news_cat_id = category.cat_id
      WHERE `news_day` = :newsTop
    ');
        $sth->bindValue(':newsTop', self::TOP_NEWS, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsCategories() {
        $result = $this->connection->query(
            "SELECT *
                 FROM category"
        );

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsByCategory($category) {
        $sth = $this->connection->prepare('
      SELECT *
      FROM news
      LEFT JOIN category ON news.news_cat_id = category.cat_id
      WHERE `cat_code` = :category
    ');
        $sth->bindValue(':category', $category);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}