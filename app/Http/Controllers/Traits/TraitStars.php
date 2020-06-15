<?php 
namespace App\Http\Controllers\Traits;

/**
 * 
 */
trait TraitStars
{
    public function getScoreHtml($score)
    {
        $html = '';

        if($score < 1){
            $html = '<span class="fa fa-star-half-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score == 1){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score > 1 && $score < 2){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star-half-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score == 2){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score > 2 && $score < 3){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-half-o"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score == 3){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score > 3 && $score < 4){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-half-o"></span>
            <span class="fa fa-star-o"></span>';
        }elseif($score == 4){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-o"></span>
          ';
        }elseif($score > 4 && $score < 5){
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star-half-o"></span>';
        }else{
            $html = '<span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>';
        }

        return $html;
    }
}
