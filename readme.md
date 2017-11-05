## Description
Indonesian Language Model   
This program trains Indonesian model using ngram technique   
The data used are the 9 most popular news sites in Indonesia   
There is an automatic sentence generator feature from given word using Shannon Visualization technique   

## Datasets
I use the python article scraper tool in this [link](https://github.com/codelucas/newspaper).   
I captured 9 automatic news sites then printed into a .txt file format

#### Important
On the demo website I only use 5 corpus because free memory size hosting is very bad.   

Please see the ```datasets/ ``` for the datasets
1. datajpnn.txt
2. datakompas.txt
3. datamerdeka.txt
4. datametrotv.txt
5. datarepublika.txt
6. datasuara.txt
7. datatempo.txt
8. datatribunn.txt
9. dataviva.txt

## Function

Please see the ```application/model/Tools.php``` for the function.  
The Following function can be used:

``` php
unigramCount($data,$indexes);
bigramCount($data,$indexes);
trigramCount($data,$indexes);
shannonVisual($model,$first,$min);
    
```
## Installation
1. Clone repo using Git
``` shell
# clone repository into your htdocs dir
git clone https://github.com/faisalsyfl/IndoLangModel.git 
```
2. Open your localhost/apache ex: http://localhost/IndoLangModel


## Getting Started
``` php
/* Your datasets filename */
$corpus = Array('datatribunn.txt','datakompas.txt','datatempo.txt','datajpnn.txt','datamerdeka.txt');
$modelUni = array();
$modelBi = array();
$modelTri = array();

foreach($corpus as $i){
	$modelUni = $this->Tools->unigramCount(file_get_contents(FCPATH.'datasets/'.$i),$modelUni);
	$modelBi = $this->Tools->bigramCount(file_get_contents(FCPATH.'datasets/'.$i),$modelBi);
	$modelTri = $this->Tools->trigramCount(file_get_contents(FCPATH.'datasets/'.$i),$modelTri);
}

$this->Tools->pre_print_r($modelUni);
$this->Tools->pre_print_r($modelBi);
$this->Tools->pre_print_r($modelTri);

```
## Documentation
![alt text](https://s1.postimg.org/8kbdma77cf/image.png "UI Program")  
![alt text](https://s1.postimg.org/39aidjzefj/image.png "Bigram Probs Checker")  
![alt text](https://s1.postimg.org/4jq6y1jten/image.png "Shannon Visualization")  

## Live Demo

<http://indolangmodel.byethost7.com/>
