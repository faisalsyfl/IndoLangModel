<!-- 
	Language Model
	Arranged By Faisal S.A
	4 November 2017
	about.me/faisalsyfl
 -->
 <!-- Edited in 23 Okctober 2017 -->
<!doctype html>
<html class="no-js" lang="en">
<head>
	<!-- Page Header -->
	<title>Language Model</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">  	
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">  	
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
  	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body onload="load()">
	<!-- Navigation  -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a style="padding-top: 10px; color:white;" href="<?php echo site_url(); ?>"class="navbar-brand">&nbsp;&nbsp;<span><img src="<?php echo base_url(); ?>assets/img/h.png" width="5%">&nbsp;&nbsp;</span>Indonesian Language Model</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul style="padding-right: 10px;" class="nav navbar-nav navbar-right">
					<li>
						<div style="padding: 8px 5px 0px 0px">
							<button class="btn btn-warning" type="button" onclick="toggleFullScreen()"><span class="glyphicon glyphicon-fullscreen"></span></button>
						</div>
					</li>
					<li>					
						<div class="dropdown" style="padding: 8px 5px 0px 0px" id="dropdown">
		  					<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;About</button>
						  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							    <li class="dropdown-header">Programmer</li>
							    <li><a href="http://about.me/faisalsyfl" target="_blank">Faisal Syaiful Anwar</a></li>
							    <li><a href="http://about.me/faisalsyfl" target="_blank">Anita Dyah Pertiwi</a></li>
						  	</ul>
						</div>
					</li>					
				</ul>
			</div>
		</div>
	</nav>

	<div id="loader"></div>

	<!-- Page Container -->
	<div class="container animate-bottom" style="display: none; padding-top: 70px;" id="container">
		<div class="row">
			<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible" role="alert">
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  	<span class="glyphicon glyphicon-alert aria-hidden="true"></span>&nbsp;&nbsp;We recommend using Google Chrome browser to keep our program running as it should.
			</div>
			</div>
		</div>
		<div class="row" id="rowmanual">
			<div class="col-md-7">
				<div class="panel panel-primary">
	  				<div class="panel-heading">
	    				<h3 class="panel-title"><span class="glyphicon glyphicon-pencil aria-hidden="true"></span>&nbsp;&nbsp;Input Testing</h3>
				  	</div>
	  				<div class="panel-body">
	  					<?php echo form_open('Home/probChecker/'); ?>
	  					<h4>Probability Checker (Bigram)</h4>
							<div class="form-group">
								<div class="col-md-6">
									<input type="text" id="firstString" class="form-control" placeholder="First Word" name="first" required="">		
								</div>
								<div class="col-md-6">
									<input type="text" id="secondWord" class="form-control" placeholder="Second Word" name="second" required="">
								</div>
						  </div>
							<small style='font-style:italic; color:grey;'>&nbsp;&nbsp;&nbsp;&nbsp;ex: di atas, kartu SIM,START saya, dia END</small>
						  <br>
  							<div class="form-group">
								<input type="submit" class="btn btn-success form-control " data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>" id="submitm" value="Check">			  						  
						  </div>
						 <?php echo form_close(); ?>	
						 <?php echo form_open('Home/sentenceGeneration'	); ?>
	  					<h4>Sentence Generation from given word</h4>
							<div class="form-group">
								<div class="col-md-6">
									<input type="text" id="firstWord" class="form-control" placeholder="Given Word" name="first" required="">		
								</div>
								<div class="col-md-6">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Min</span>
									  <input type="number" class="form-control" placeholder="Sentence Length" name="min" aria-describedby="basic-addon1" required="">
									</div>
								</div>				
						  </div>
						  <br><br>
  							<div class="form-group">
								<input type="submit" class="btn btn-success form-control " data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>" id="submitm" value="Generate">			  						  
						  </div>
						 <?php echo form_close(); ?>									 			 
					</div>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="panel panel-primary">
	  				<div class="panel-heading">
	    				<h3 class="panel-title"><span class="glyphicon glyphicon-info-sign aria-hidden="true"></span>&nbsp;&nbsp;Information & Top Frequency</h3>
				  	</div>
	  				<div class="panel-body">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-warning">
						    <div class="panel-heading" role="tab" id="headingOne">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
						          Model Information
						        </a>
						      </h4>
						    </div>
						    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						      <div class="panel-body">
				  					<table class="table table-condensed">
				  						<tbody>
				  							<tr>
				  								<td>Number of {corpus}.txt</td>
				  								<td>:</td>
				  								<td><?php echo $numOfCorpus; ?></td>
				  							</tr>
				  							<tr>
				  								<td>Number of unique words (unigram)</td>
				  								<td>:</td>
				  								<td><?php echo $numOfUnigram; ?></td>
				  							</tr>
				  							<tr>
				  								<td>Number of bigrams</td>
				  								<td>:</td>
				  								<td><?php echo $numOfBigram; ?></td>	  								
				  							</tr>
				  							<tr>
				  								<td>Number of bigrams with freq > 3</td>
				  								<td>:</td>
				  								<td><?php echo $numOfBigramTreshold ?></td>	  								
				  							</tr>	  	
				  							<tr>
				  								<td>Number of trigrams</td>
				  								<td>:</td>
				  								<td><?php echo $numOfTrigram ?></td>	  								
				  							</tr>					  													
				  						</tbody>
				  					</table>
				  					"This program train the model using Indonesian news article with theme 'Technology'. We pursed an article that crawls with one theme for the generated sentence to be focused on the theme 'Technology'"
						      	<br> 
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-info">
						    <div class="panel-heading" role="tab" id="headingTwo">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Top 10 frequency unigram
						        </a>
						      </h4>
						    </div>
						    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="panel-body">
				  					<table class="table table-condensed">
				  						<tbody>
				  							<?php $i=1;foreach($top10Unigram as $row){ if($row['words'] == "START" || $row['words'] == "END") continue; ?>
				  							<tr>
				  								<td><?php echo $i++; ?></td>
				  								<td><?php echo $row['words']; ?></td>
				  								<td><?php echo $row['count']; ?></td>
				  							</tr>
											<?php } ?>
				  						</tbody>
				  					</table>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-info">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Top 10 frequency bigram
						        </a>
						      </h4>
						    </div>
						    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTree">
						      <div class="panel-body">
				  					<table class="table table-condensed">
				  						<tbody>
				  							<?php $i=1;foreach($top10Bigram as $row){?>
				  							<tr >
				  								<td><?php echo $i++; ?></td>
				  								<td <?php if(substr($row['words'],-3) == "END") echo "style='color:red;'"; else if(substr($row['words'],0,5) == "START") echo "style='color:green;'" ?>><?php echo $row['words']; ?></td>
				  								<td><?php echo $row['count']; ?></td>
				  							</tr>
											<?php } ?>						
				  						</tbody>
				  					</table>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-info">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						          Top 10 frequency trigram
						        </a>
						      </h4>
						    </div>
						    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTree">
						      <div class="panel-body">
				  					<table class="table table-condensed">
				  						<tbody>
				  							<?php $i=1;foreach($top10Trigram as $row){?>
				  							<tr >
				  								<td><?php echo $i++; ?></td>
				  								<td <?php if(substr($row['words'],-3) == "END") echo "style='color:red;'"; else if(substr($row['words'],0,5) == "START") echo "style='color:green;'" ?>><?php echo $row['words']; ?></td>
				  								<td><?php echo $row['count']; ?></td>
				  							</tr>
											<?php } ?>						
				  						</tbody>
				  					</table>
						      </div>
						    </div>
						  </div>						  
  						  <div class="panel panel-danger">
						    <div class="panel-heading" role="tab" id="headingFour">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						          Want to contribute? 
						        </a>
						      </h4>
						    </div>
						    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="panel-body">
				  					<h4>COMING SOON!</h4>
						      </div>
						    </div>
						  </div>							  
						</div>	  				
					</div>
				</div>	
			</div>

		</div>
		<div id="hasil" class="row" style="">
			<div class="col-md-12">
				<div class="panel panel-primary">
	  				<div class="panel-heading">
	    				<h3 class="panel-title"><span class="glyphicon glyphicon-check aria-hidden="true"></span>&nbsp;&nbsp;Calculate Result</h3>
				  	</div>
	  				<div class="panel-body">
	  					<div class="row">
	  						<div class="col-md-6">
			  					<div class="panel panel-info">
					  				<div class="panel-heading">
					    				<h3 class="panel-title">Bigram Information</h3>
								  	</div>
								  	<div class="panel-body">
								  		<table class="table table-condensed">
					  						<tbody>
					  							<tr>
					  								<td>Words</td>
					  								<td>:</td>
					  								<td><?php echo $result['words'] ?></td>
					  							</tr>
					  							<tr>
					  								<td>Count</td>
					  								<td>:</td>
					  								<td><?php echo $result['count']; ?></td>
					  							</tr>
					  							<tr>
					  								<td>Probability</td>
					  								<td>:</td>
					  								<td><?php echo $result['probabilty']; ?></td>	  								
					  							</tr>							
					  						</tbody>
					  					</table>
									</div>
								</div>
							</div>
	  						<div class="col-md-6">
			  					<div class="panel panel-info">
					  				<div class="panel-heading">
					    				<h3 class="panel-title">Bigram similar to <i style="color:orange;"><?php echo $result['first']; ?></i></h3>
								  	</div>
								  	<div class="panel-body">
								  		<table class="table table-condensed">
					  						<thead>
					  							<tr>
					  								<td>No.</td>
					  								<td>Words</td>
					  								<td>Count</td>
					  								<td>Probability</td>
					  							</tr>
					  						</thead>
					  						<tbody>
								  			<?php $n=1;if(isset($similar)) foreach($similar as $i){ ?>
					  							<tr <?php if(substr($i['words'],-3) == "END") echo "class='danger';"; else if(substr($i['words'],0,5) == "START") echo "class='success';" ?>>
					  								<td><?php echo $n++; ?></td>
					  								<td><?php echo $i['words']; ?></td>
					  								<td><?php echo $i['count']; ?></td>
					  								<td><?php echo $i['probabilty']; ?></td>
					  							</tr>					
					  						<?php } ?>
					  						</tbody>
					  					</table>								  		
									</div>
								</div>
							</div>							
						</div>												
					</div>
				</div>
			</div>
		</div>
	</div> 
			
<script>

	/*Other Function and Variable for CSS & JS (Visual Things)*/

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	var timer;
	function load() {
	    timer = setTimeout(showContainer, 1000);	
	}

	function showContainer() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("container").style.display = "block";
	}

	// Error Handling
    $('#reset').on('click',function() {
		$("#inputres").modal();
    	$("#hasil").hide("slow");
    });

    // About
  	$('.dropdown').on('show.bs.dropdown', function() {
    	$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  	});
  	$('.dropdown').on('hide.bs.dropdown', function() {
    	$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  	});

  	/**
  	 * toogling Full Screen for visual purposes
  	 * @return {} 
  	 */
  	function toggleFullScreen() {
	  	if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
		    if (document.documentElement.requestFullScreen) {  
		      	document.documentElement.requestFullScreen();  
		    }else if(document.documentElement.mozRequestFullScreen) {  
		      	document.documentElement.mozRequestFullScreen();  
		    }else if(document.documentElement.webkitRequestFullScreen) {  
		      	document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
		    }  
	  	}else{  
			if(document.cancelFullScreen) {  
				document.cancelFullScreen();  
			}else if(document.mozCancelFullScreen) {  
				document.mozCancelFullScreen();  
			}else if(document.webkitCancelFullScreen) {  
				document.webkitCancelFullScreen();  
			}  
	  }  
	}
</script>
</body>
</html>