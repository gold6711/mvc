<?php
class Article extends Model{
    public $id;
    public $title;
    public $content;
    public $author;
   // public $tags;

    public static function getAll(){
        /**
         * Подумайте, какие неудобства возникают при данной архитектуре класса БД
         * и класса Article
         */
        return Db::getInstance()->fetch("SELECT a.id, a.title,a.content, a.date FROM articles a
                    LEFT JOIN users AS u ON user_id = u.id");
    }

     /**
     * Одиночная статья по ид
     * @param $id
     */
    function getById($id){
        return $this->db->fetch("SELECT a.id, a.title,a.content,u.login AS author FROM articles a
                    LEFT JOIN users AS u ON user_id = u.id
                    WHERE a.id = {$id}")[0];
    }

    /**
     * Обновить статью
     * @param $title
     * @param $content
     * @param $user_id
     * @param $date
     * @return bool|mysqli_result|void
     */
    function update($title,$content,$user_id,$date){
        return $this->db->query("UPDATE articles SET title = {$title}, content = {$content}, user_id = $user_id,`date` = {$date},");
    }

    /**
     * Добавить статью
     * @param $title
     * @param $content
     * @param $user_id
     * @param $date
     * @return bool|mysqli_result|void
     */
    function insert($title,$content,$user_id,$date){
        return $this->db->query("INSERT INTO articles(title,content,user_id,`date`) VALUES({$title},{$content},{$user_id},$date)");
    }

    /**
     * Получить привязанные коментари к ИД
     * @param $articleId
     */
    function getComments($articleId){

    }

    /**
     * Добавить новый комментарий
     */
    function addComment($article_id,$user_id,$content,$date){

    }
}
///// ПРОБНЫЕ ИЗМЕНЕНИЯ С ПРИМЕНЕНИЕМ GIT BASH
//// И КОМАНДНОЙ СТРОКИ ЧЕРЕЗ BASH КОНСОЛЬ В PHP-STORM













