<?php

class ArticleList extends Model
{
    protected $articles = [];

    /**
     * @param $article
     */
    function add(Article $article) {
        array_push($this->articles, $article);
    }

    /**
     * @param $id
     */
    function delete($id) {
        foreach ($this->articles as $key => $val) {
            if ($id == $val->id) {
                unset($this->articles[$key]);
                return;
            }
        }
    }

    /**
     * Получаем список всех статей
     */
    function getAll(){
        return $this->db->fetch("SELECT a.id, a.title,a.content, a.date FROM articles a
                    LEFT JOIN users AS u ON user_id = u.id");
    }
}
///// ПРОБНЫЕ ИЗМЕНЕНИЯ С ПРИМЕНЕНИЕМ GIT BASH
//// И КОМАНДНОЙ СТРОКИ ЧЕРЕЗ BASH КОНСОЛЬ В PHP-STORM