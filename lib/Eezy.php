<?php


class Eezy{
	static public function var_dump($x, $y){
		echo '<pre>';
		echo htmlspecialchars(print_r($x, true));
		echo '</pre>';
		if($y)
			die;
	}
}
