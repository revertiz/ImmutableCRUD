<?php

use Code\Core\Container;
use Code\JokeForm\FormController;
use Code\JokeForm\FormView;
use Code\JokeForm\Helper;
use Code\JokeList\ListController;
use Code\JokeList\ListView;
use Code\Model\JokeForm;
use Code\Model\JokeList;
use Code\Model\TimeManager;

$container = new Container();
$container->set(
    FormController::class,
    function (Container $container) {
        return new \Code\JokeForm\FormController(
            $container->get(Helper::class)
        );
    }
)->set(
    FormView::class,
    function (Container $container) {
        return new \Code\JokeForm\FormView();
    }
)->set(
    ListView::class,
    function (Container $container) {
        return new \Code\JokeList\ListView();
    }
)
    ->set(
        JokeForm::class,
        function (Container $container) {
            return new \Code\Model\JokeForm(
                $container->get('PDO'),
                $container->get(TimeManager::class)
            );
        }
    )
    ->set(
        JokeList::class,
        function (Container $container) {
            return new \Code\Model\JokeList(
                $container->get('PDO')
            );
        }
    )
    ->set(
        ListController::class,
        function (Container $container) {
            return new \Code\JokeList\ListController();
        }
    )->set(
        Helper::class,
        function (Container $container) {
            return new \Code\JokeForm\Helper();
        }
    )->set(
        TimeManager::class,
        function (Container $container) {
            return new \Code\Model\TimeManager();
        }
    )->set(
        'PDO',
        function () {
            return new PDO('mysql:host=db;dbname=test_db', 'devuser', 'devpass');
        }
    );

