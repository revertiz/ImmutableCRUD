<?php

namespace Code\JokeList;

use Code\Model\JokeList;

class ListView
{

    public function output(JokeList $model): string
    {

        $sort = $model->getSort();
        $page = $model->getPage();
        if (!empty($model->getKeyword())) $keyword = '&amp;search=' . $model->getKeyword();

        $output = '<div class="container">
		<form action="" method="get">
				<input type="hidden" value="filterList" name="action" />
				<input type="hidden" value="' . $sort . '" name="sort" />
				<input type="hidden" value="' . $page . '" name="page" />
				<input type="text"  placeholder="Ieskoti juokelio" name="search" />

				<input class="btn btn-default" type="submit" value="Ieskoti" />
			</form>

			<p>Rikiavimas: <a href="index.php?action=filterList&amp;sort=newest&amp;page=' . $model->getPage() . $keyword . '">Naujesni</a> | <a href="index.php?action=filterList&amp;sort=oldest&amp;page=' . $model->getPage() . $keyword . '">Senesni</a>
			<div class="list-group">
            </div>
			';

        $output .= '
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Joke</th>
                        <th colspan="2"></th>
                      </tr>
                    </thead>
                    <tbody>';

        foreach ($model->getJokes() as $joke) {
            $output .= '
                    <tr>
                        <td>' . $joke['text'] . '</td>

                <td style="text-align: right">

                            <form action="index.php?action=delete" method="POST">
                                <input  type="hidden" name="id" value="' . $joke['id'] . '" />     
                                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                <a class="btn btn-success" role="button" href="index.php?route=edit&amp;action=edit&amp;id=' . $joke['id'] . '"><i class="glyphicon glyphicon-pencil"></i></a>
                            </form>
                            </td>
                            
                    </tr>';
        }
        $output .= '
                  
                </tbody>
              </table>
            </div>
         </div>';

        $perPage = $model->getRecordsPerPage();
        $pageNo = $model->getPage();
        $totalRecords = $model->getTotalResults();
        $totalPages = ceil($totalRecords / $perPage);

//Pagination su first previous next last, kurie atsiranda vaikstant per puslapius
//		$output .= '</ul>';
//        $output .= '<ul class="pagination" >';
//        $output .= '<li><a href="?action=filterList&amp;page=1">First</a></li>';
//        if($pageNo > 1){
//            $output .='<li ><a href="?action=filterList&amp;page=' . ($pageNo-1) . '">Previous</a></li>';
//        }
//        if($pageNo < $totalPages){
//            $output .='<li><a href="?action=filterList&amp;page='. ($pageNo+1) . '">Next</a></li>';
//        }
//        $output .= '<li > <a href = "?action=filterList&amp;page=' . $totalPages .'"> Last</a > </li>';
//        $output .= '</ul>';

//pagination su visais puslapiu skaiciais,  ju esant daugiau rodomi dots
        $html = '
    <div class="container">
        <ul class="pagination pagination-lg">';
        //rodyklele previous bootstrap
        $html .= '
            <li >
              <a href="?action=filterList&amp;sort=' . $model->getSort() . $keyword . '&amp;page=' . ($pageNo - 1) . '" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>';

        //leeway nustato kiek puslapiu rodyti iki dots
        $leeway = 2;
        $firstPage = $pageNo - $leeway;
        $lastPage = $pageNo + $leeway;


        if ($firstPage < 1) {
            $firstPage = 1;
            $lastPage += 1 - $firstPage;

        }
        if ($lastPage > $totalPages) {
            $firstPage -= $lastPage - $totalPages;
            $lastPage = $totalPages;
        }
        if ($firstPage < 1) {
            $firstPage = 1;
        }

        if ($firstPage != 1) {
            $html .= '<li><a href="?action=filterList&amp;sort=' . $model->getSort() . $keyword . '&amp;page=1" title="Page 1">1</a></li>';
//            $html .= '<li class="page dots"><span>...</span></li>';
        }

        for ($i = $firstPage; $i <= $lastPage; $i++) {
            if ($i == $pageNo) {

                $html .= '<li class="active"><span><b>' . $i . '</b></span></li>';
            } else {
                $html .= '<li ><a href="?action=filterList&amp;sort=' . $model->getSort() . $keyword . '&amp;page=' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($lastPage != $totalPages) {
//            $html .= '<li class="page dots"><span>...</span></li>';
            $html .= '<li><a href="?action=filterList&amp;sort=' . $model->getSort() . $keyword . '&amp;page=' . $totalPages . '" title="Page ' . $totalPages . '">' . $totalPages . '</a></li>';
        }

        //rodykle next bootstrap
        $html .= '
        <li >
          <a  href="?action=filterList&amp;sort=' . $model->getSort() . $keyword . '&amp;page=' . ($pageNo + 1) . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>

          </a>
        </li>';
        $html .= '</ul></div>';

        $output .= $html;

        return $output;

    }
}
