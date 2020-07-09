<?php
namespace Code\JokeForm;

use Code\Model\JokeForm;

class FormController {

    private $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

	public function edit(JokeForm $jokeForm): JokeForm  {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $jokeForm = $this->submit($jokeForm);
            return $jokeForm;
        }

		if (isset($_GET['id'])) {

			return $jokeForm->load($_GET['id']);
		}
		else {
			return $jokeForm;
		}

	}

	public function submit(JokeForm $jokeForm): JokeForm  {
		return $jokeForm->save($_POST['joke']);
	}
}
