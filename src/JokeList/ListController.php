<?php

namespace Code\JokeList;

use Code\Model\JokeList;

class ListController
{

    public function filterList(JokeList $jokeList): JokeList
    {
        if (!empty($_GET['sort'])) {
            $jokeList = $jokeList->sort($_GET['sort']);
        }

        if (!empty($_GET['search'])) {
            $jokeList = $jokeList->search($_GET['search']);

        }

        if (!empty($_GET['page'])) {
            $jokeList = $jokeList->page($_GET['page']);
        }

        return $jokeList;
    }

//	public function pagination(JokeList $jokeList): JokeList {
//        if (!empty($_GET['page'])) {
//            return $jokeList->page($_GET['page']);
//        }
//    }

    public function delete(JokeList $jokeList): JokeList
    {
        return $jokeList->delete($_POST['id']);
    }
}
