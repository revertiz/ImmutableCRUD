<?php

namespace Code\JokeForm;

use Code\Model\JokeForm;

class FormView
{

    public function output(JokeForm $model): string
    {

        $errors = $model->getErrors();

        if ($model->isSubmitted() && empty($errors)) {
            header('location: index.php');
        }

        $joke = $model->getJoke();

        $output = '<div class="container">';

        if (!empty($errors)) {
            $output .= '<p>The record could not be saved:</p>';
            $output .= '<ul>';
            foreach ($errors as $error) {
                $output .= '<li>' . $error . '</li>';
            }
            $output .= '</ul>';
        }

        $output .= '
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" value="' . ($joke['id'] ?? '') . '" name="joke[id]" />
                    <label>Enter your joke here:</label>
                    <textarea class="form-control" name="joke[text]">' . ($joke['text'] ?? '') . '</textarea>
                    
				</div>
				<div><button type="submit" class="btn btn-primary">Submit</button></div>
			</form></div>';


        return $output;

    }
}
