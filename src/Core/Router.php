<?php


namespace Code\Core;


class Router
{
    private $table = array();

    public function __construct()
    {
        $this->table['default'] = new Route('Code\Model\JokeList', 'Code\JokeList\ListView', 'Code\JokeList\ListController');
        $this->table['list'] = new Route('Code\Model\JokeList', 'Code\JokeList\ListView', 'Code\JokeList\ListController');
        $this->table['edit'] = new Route('Code\Model\JokeForm', 'Code\JokeForm\FormView', 'Code\JokeForm\FormController');
    }

    public function getRoute($route)
    {
        $route = strtolower($route);

        if (!isset($this->table[$route])) {
            return $this->table['default'];
        }

        return $this->table[$route];
    }
}
