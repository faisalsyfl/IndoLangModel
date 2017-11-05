<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $modelBigram;
	private $modelUnigram;
	private $modelBigramTreshold;
	private $top10Unigram;
	private $top10Bigram;
	private $numOfCorpus;


	public function __construct(){
		parent::__construct();
		$this->modelBigram = array();
		$this->modelBigramTreshold = array();
		$this->modelUnigram = array();
		$this->modelTrigram = array();
		$this->top10Unigram = array();
		$this->top10Bigram = array();
		$this->top10Trigram = array();
	}
	public function index(){
		$this->process();
		$data['numOfCorpus'] = $this->numOfCorpus;
		$data['numOfUnigram'] = count($this->modelUnigram);
		$data['numOfBigram'] = count($this->modelBigram);
		$data['numOfBigramTreshold'] = count($this->modelBigramTreshold);
		$data['numOfTrigram'] = count($this->modelTrigram);
		$data['top10Unigram'] = array_slice($this->top10Unigram,0,12);
		$data['top10Bigram'] = array_slice($this->top10Bigram,0,10);
		$data['top10Trigram'] = array_slice($this->top10Trigram,0,10);
		// var_dump($data['numOfBigramTreshold']);
		// usort($this->modelBigramTreshold, function ($a, $b){
		//  return strcmp($a['words'],$b['words']);
		// });
		// $this->Tools->pre_print_r($this->modelBigramTreshold);
		$this->load->view('home',$data);
	}
	public function process(){
		/*Datasets i've been crawl from Indonesian News Sites*/
		/*You can add others data which has been pre-processed into this Array*/
		/*Place your file to folder ROOT/datasets/   */

		// $corpus = Array('datakompas.txt','datatempo.txt','datatribunn.txt','datajpnn.txt','datamerdeka.txt','datametrotv.txt','dataviva.txt','datarepublika.txt','datasuara.txt');
		$corpus = Array('datatribunn.txt','datakompas.txt','datatempo.txt','datajpnn.txt','datamerdeka.txt');
		$this->numOfCorpus = count($corpus);
		

		/*Learning step to add corpus into Model*/
		foreach($corpus as $i){
			$this->modelUnigram = $this->Tools->unigramCount(file_get_contents(FCPATH.'datasets/'.$i),$this->modelUnigram);
			$this->modelBigram = $this->Tools->bigramCount(file_get_contents(FCPATH.'datasets/'.$i),$this->modelBigram);
			$this->modelTrigram = $this->Tools->trigramCount(file_get_contents(FCPATH.'datasets/'.$i),$this->modelTrigram);
		}
		/*Key error deletion*/
		unset($this->modelBigram['START END']);



		/*Selecting top1 Unigram & Bigram*/
		$this->top10Unigram = $this->modelUnigram;
		usort($this->top10Unigram, function ($a, $b) {
		    return $a['count'] < $b['count'];
		});

		$this->top10Bigram = $this->modelBigram;
		usort($this->top10Bigram, function ($a, $b) {
		    return $a['count'] < $b['count'];
		});
		$this->top10Trigram = $this->modelTrigram;
		usort($this->top10Trigram, function ($a, $b) {
		    return $a['count'] < $b['count'];
		});

		/*Calculate Probability*/
		foreach($this->modelBigram as &$row){
			$row['probabilty'] = $row['count']/$this->modelUnigram[$row['first']]['count'];
		}
		/*Selecting bigram below the treshold*/
		foreach($this->modelBigram as $i){
			if($i['count'] > 3){
				$this->modelBigramTreshold[$i['words']] = $i;
			}
		}
	}

	public function debug(){
		// $this->process();
		// foreach(array_slice($this->modelBigramTreshold,0,100) as $row){
		$corpus = Array('datakompas.txt','datatempo.txt','datatribunn.txt','datajpnn.txt','datamerdeka.txt','datametrotv.txt','dataviva.txt','datarepublika.txt','datasuara.txt');
		$test = array();
		$debug = $this->Tools->trigramCount(file_get_contents(FCPATH.'datasets/'.$corpus[0]),$test);		
		$this->Tools->pre_print_r($debug);
		
	}

	public function probChecker(){
		$post = $this->input->post();
		$this->process();
		$data['numOfCorpus'] = $this->numOfCorpus;
		$data['numOfUnigram'] = count($this->modelUnigram);
		$data['numOfBigram'] = count($this->modelBigram);
		$data['numOfBigramTreshold'] = count($this->modelBigramTreshold);
		$data['numOfTrigram'] = count($this->modelTrigram);
		$data['top10Unigram'] = array_slice($this->top10Unigram,0,12);
		$data['top10Bigram'] = array_slice($this->top10Bigram,0,10);
		$data['top10Trigram'] = array_slice($this->top10Trigram,0,10);
		if(isset($this->modelBigram[$post['first']." ".$post['second']])){
			$data['result'] = $this->modelBigram[$post['first']." ".$post['second']];
			foreach($this->modelBigram as $i){
				if(strtolower($i['first']) == strtolower($data['result']['first'])){
					$data['similar'][$i['words']] = $i; 
				}
			}
			rsort($data['similar']);
			$data['similar'] = array_slice($data['similar'],0,10);
			
		}else{
			$data['result']['words'] = $post['first']." ".$post['second'];
			$data['result']['count'] = 0;
			$data['result']['first'] = $post['first'];
			$data['result']['probabilty'] = 0;
			foreach($this->modelBigram as $i){
				if(strtolower($i['first']) == strtolower($post['first'])){
					$data['similar'][$i['words']] = $i; 
				}
			}
			rsort($data['similar']);
			$data['similar'] = array_slice($data['similar'],0,10);
		}


		$this->load->view('pc',$data);				

	}

	public function sentenceGeneration(){
		$post = $this->input->post();
		$this->process();
		$data['numOfCorpus'] = $this->numOfCorpus;
		$data['numOfUnigram'] = count($this->modelUnigram);
		$data['numOfBigram'] = count($this->modelBigram);
		$data['numOfBigramTreshold'] = count($this->modelBigramTreshold);
		$data['numOfTrigram'] = count($this->modelTrigram);
		$data['top10Unigram'] = array_slice($this->top10Unigram,0,12);
		$data['top10Bigram'] = array_slice($this->top10Bigram,0,10);
		$data['top10Trigram'] = array_slice($this->top10Trigram,0,10);
		usort($this->modelBigram, function ($a, $b) {
		    return $a['probabilty'] < $b['probabilty'];
		});

		$data['visual'] = $this->Tools->shannonVisual($this->modelBigram,strtolower($post['first']),$post['min']);
		// $this->Tools->pre_print_r($data['visual']);
		$this->load->view('sg',$data);					
	}
	
}
