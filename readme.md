## Description
Indonesian Language Model
This program trains Indonesian model using ngram technique.
The data used are the 9 most popular news sites in Indonesia.
There is an automatic sentence generator feature of a word using Shannon Visualization technique.   

## Datasets
Please see the ```datasets/ ``` for the datasets

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
/* Your first string */
var string1;
/* Your second string */
var string2;

matrixMED = MED(string1,string2);
matrixLED = LED(string1,string2)
console.log(matrixMED);
console.log(matrixLED);

seqOperationMED = backTrace(matrixMED);
seqOperationLED = backTrace(matrixLED);
console.log(seqOperationMED);
console.log(seqOperationLED);

```

## Documentation
![alt text](https://s1.postimg.org/2xeoni799b/image.png "Input")  
![alt text](https://s1.postimg.org/10bktu5mcf/image.png "Matrix & Backtrace")
![alt text](https://s1.postimg.org/1lxzubdftr/image.png "Matrix & Backtrace")