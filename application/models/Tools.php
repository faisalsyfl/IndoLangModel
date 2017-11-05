<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Model {

	public function index(){
		parent::__construct();
	}
	public function pre_print_r($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";

	}
	public function bigramCount($data,$indexes){
		//Clean The Data from un required chars!
		$data = preg_split('/\.|\?|!/',$data);
		$data = preg_replace("/[^\w]/"," ",$data);
		$data = preg_replace('/\s+/', ' ',$data);

		// $this->pre_print_r($data);
		foreach($data as $i){
			$segments[] = explode(" ",$i);
		}
		for($i=0;$i<count($segments);$i++){
			if($i != 0){
				$segments[$i][0] = "START";
			}

			for($j=0;$j<count($segments[$i]);$j++){
				if($segments[$i][$j] == ""){
					unset($segments[$i][$j]);
				}else{
					if($segments[$i][$j] != "START"){
						$segments[$i][$j] = strtolower($segments[$i][$j]);
					}				
				}
			}
			$segments[$i][count($segments[$i])] = "END";
		}
		// $this->pre_print_r($segments);
		for($i=0;$i<count($segments);$i++){
			for($j=0;$j<count($segments[$i]);$j++){
				if($j == 0){
					continue;
				}
				if(trim($segments[$i][$j-1]) != "" && trim($segments[$i][$j]) != ""){
					$key = trim($segments[$i][$j - 1]) . " " . trim($segments[$i][$j]);
					if(array_key_exists($key,$indexes)){
						$indexes[$key]["count"]++;
					}else{
						$indexes[$key] = array(
						  'count' => 1,
						  'words' => $key,
						  'first' => trim($segments[$i][$j-1])
						);
					}
				}
			}
		}
		$total = 0;
		foreach($indexes as $i){
				$total++;
			if($i['count'] > 2){
			}
		}
		// $this->pre_print_r($indexes);
		return $indexes;
	}

	public function unigramCount($data,$indexes){
		//Clean The Data from un required chars!
		$data = preg_split('/\.|\?|!/',$data);
		$data = preg_replace("/[^\w]/"," ",$data);
		$data = preg_replace('/\s+/', ' ',$data);

		// $this->pre_print_r($data);
		foreach($data as $i){
			$segments[] = explode(" ",$i);
		}
		for($i=0;$i<count($segments);$i++){

			if($i != 0){
				$segments[$i][0] = "START";
			}
			for($j=0;$j<count($segments[$i]);$j++){
				if($segments[$i][$j] == ""){
					unset($segments[$i][$j]);
				}else{
					if($segments[$i][$j] != "START"){
						$segments[$i][$j] = strtolower($segments[$i][$j]);
					}
				}
			}
			$segments[$i][count($segments[$i])] = "END";
		}
		// $this->pre_print_r($segments);

		for($i=0;$i<count($segments);$i++){
			for($j=0;$j<count($segments[$i]);$j++){
				if(trim($segments[$i][$j]) != ""){
					$key = trim($segments[$i][$j]);
					if(array_key_exists($key,$indexes)){
						$indexes[$key]["count"]++;
					}else{
						$indexes[$key] = array(
						  'count' => 1,
						  'words' => $key,
						);
					}
				}
			}
		}
		// $this->pre_print_r($indexes);
		return $indexes;
	}

	public function shannonVisual($model,$first,$min){
		$string = array();
		$probs = array();
		$stats = 0;
		$n = 0;
		// $this->pre_print_r($model);
		while($stats == 0){
			if($n < $min){
				$rand = rand(0,2);
				foreach($model as $row){
					if($row['first'] == $first && substr($row['words'],-3) != "END"){
						$temp = $row['first'];
						$tempWords = $row['words'];
						$tempProbs = $row['probabilty'];
						if($rand != 0){
							$rand--;
						}else{
							break;
						}
					}
				}
				if(!isset($temp)){
					return NULL;
				}
				$n++;
				$string[] = $temp;
				$probs[] = $tempProbs;
				$first = explode(" ",$tempWords)[1];
				
			}else{
				$f = 0;
				foreach($model as $row){
					if($row['first'] == $first){
						if($f == 0){
							$temp = $row['first'];
							$tempWords = $row['words'];
							$tempProbs = $row['probabilty'];

							$f = 1;
						}else{
							if(substr($row['words'],-3) == "END"){
								$temp = $row['first'];
								$tempWords = $row['words'];
								$tempProbs = $row['probabilty'];

								break;
							}
						}
					}
				}
				$n++;
				$string[] = $temp;
				$probs[] = $tempProbs;
				if(substr($tempWords,-3) == "END"){
					$stats = 1;
				}else{
					$first = explode(" ",$tempWords)[1];
				}
			}
			// $n++;
			// $string[] = $temp;
			// if(substr($tempWords,-3) == "END"){
			// 	$stats = 1;
			// }else{
			// 	$first = explode(" ",$tempWords)[1];
			// }

		}
		

		return [$string,$probs];
	}
	public function trigramCount($data,$indexes){
		//Clean The Data from un required chars!
		$data = preg_split('/\.|\?|!/',$data);
		$data = preg_replace("/[^\w]/"," ",$data);
		$data = preg_replace('/\s+/', ' ',$data);

		// $this->pre_print_r($data);
		foreach($data as $i){
			$segments[] = explode(" ",$i);
		}
		for($i=0;$i<count($segments);$i++){
			if($i != 0){
				$segments[$i][0] = "START";
			}

			for($j=0;$j<count($segments[$i]);$j++){
				if($segments[$i][$j] == ""){
					unset($segments[$i][$j]);
				}else{
					if($segments[$i][$j] != "START"){
						$segments[$i][$j] = strtolower($segments[$i][$j]);
					}				
				}
			}
			$segments[$i][count($segments[$i])] = "END";
		}
		// $this->pre_print_r($segments);
		for($i=0;$i<count($segments);$i++){
			for($j=0;$j<count($segments[$i]);$j++){
				if($j == 0 || $j == 1){
					continue;
				}
				if(trim($segments[$i][$j-1]) != "" && trim($segments[$i][$j]) != "" && trim($segments[$i][$j-2])){
					$key = trim($segments[$i][$j - 2]) . " " . trim($segments[$i][$j - 1]). " " . trim($segments[$i][$j]);
					if(array_key_exists($key,$indexes)){
						$indexes[$key]["count"]++;
					}else{
						$indexes[$key] = array(
						  'count' => 1,
						  'words' => $key,
						  'first' => trim($segments[$i][$j-1])
						);
					}
				}
			}
		}
		// $this->pre_print_r($indexes);
		return $indexes;
	}
}