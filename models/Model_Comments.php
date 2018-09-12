<?

class Model_Comments extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function saveComment(array $commentData = [])
    {
        //INSERT INTO `comments`(`user_name`, `user_email`, `comment_theme`, `comment_text`, `news_id`) VALUES ('test', 'g@g.ua', 'test', 'tetststtststs', '2')
        $sql = $this->connection->prepare('INSERT INTO `comments` (`user_name`, `user_email`, `comment_theme`, `comment_text`, `news_id`) VALUES (:name, :email, :website, :comment, :news_id)');
        $sql->bindParam(':name',$commentData['name']);
        $sql->bindParam(':email',$commentData['email']);
        $sql->bindParam(':website',$commentData['website']);
        $sql->bindParam(':comment',$commentData['comment']);
        $sql->bindParam(':news_id',$commentData['news_id']);
        $sql->execute();
    }

    public function getComments($id)
    {
        $sql = $this->connection->prepare("SELECT * FROM `comments` WHERE `news_id` = :id");
        $sql->bindParam(':id',$id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComments4LastNews($count = 3) {
        $sth = $this->connection->prepare('SELECT comments.user_name as name, comments.comment_text as text FROM `news` INNER JOIN comments ON news.news_id = comments.news_id ORDER BY news.news_id DESC LIMIT :count');
        $sth->bindParam(':count', $count, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}