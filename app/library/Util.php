<?php

use Phalcon\Mvc\User\Component;

/**
 * Util
 *
 * Utilities class
 */
class Util extends Component
{
	public function getNextSixMonths () {	
		
		$months = [];
        for ($i=0; $i < 6; $i++) {
        	$date = date('Y-m-d');
        	$months[$i] = date("m/Y", strtotime($date." +" . $i . " month"));
        }   

        return $months;
	}
}