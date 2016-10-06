<?php

namespace frontend\widgets;

use Yii;

class Rating extends \yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $ratesTemplate = [
        'filled'   => '<i class="fa fa-star"></i>',
        'unfilled'  => '<i class="fa fa-star-o"></i>',
    ];
    /**
     * @var array the options for rendering 
     */
    public $rating;
    public $max_rating;
    public $min_rating;
    public $num_stars;


    public function init()
    {
        parent::init();

        if ($this->rating === null) {
            $this->rating = 0;
        }

        if ($this->max_rating === null) {
            $this->max_rating = 5;
        }

        if ($this->min_rating === null) {
            $this->min_rating = 0;
        }

        if ($this->num_stars === null) {
            $this->num_stars = 5;
        }
    }

    public function run()
    {
        $interval = ($this->max_rating - $this->min_rating) / $this->num_stars;
        $value = floor(min($this->rating, $this->max_rating) / $interval);

        $html = '<div class="rating">';

        for ($i=0; $i< $value; $i++) {
            $html .= $this->ratesTemplate['filled'];
        }

        for (; $i < $this->num_stars; $i++) {
            $html .= $this->ratesTemplate['unfilled'];   
        }

        $html .= '</div>';

        return $html;
    }
}
