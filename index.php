<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Math 300 Study Guide</title>
	<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css">
	<!-- <link rel="stylesheet" href="styles/debug.css"> -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
</head>
<style>
	.hidden { display: none; } 
	.header { text-align: center;}
</style>
<!-- /.hero -->
<body>
	<section class="hero is-primary is-bold">
		<div class="hero-body">
			<h1 class="title" color="white">
				Math 300 - Study Guide
			</h1>
			<p class="subtitle">
				For the mouths agape
			</p>
		</div>
	</section>

	<!-- study guide -->
	<section class="section" id="studyGuide">
		<div class="container is-fluid">

			<!-- php -->
			<?php	
			function makeCategory($title){
				// echo html for header
				echo "<div class=\"notification is-dark header\" id =\"{$title}\">"
				. "<h1 class=\"title\" id=\"header_{$title}\">{$title}</h1>"
				. "</div>";			
			}	

			// setup sql connection and perform query
			require_once('docs/mysqli_connect.php');
			// first query for bulk of page
			$query = "SELECT question, answer, type "
			. "FROM studyinfo ORDER BY type";
			$response = @mysqli_query($conn, $query);
			// second query for categories
			$queryTypes =  "SELECT DISTINCT type FROM studyinfo";
			$typeResponse = @mysqli_query($conn, $queryTypes);

			$conn->close();
			// load questions and answers
			while($row = $response->fetch_assoc()){
				$table[] = $row;
			}
			$response->close();
			// count the categories
			while($typeRow = $typeResponse->fetch_assoc()){
				$typeTable[] = $typeRow;
			}
			// initialize variables
			$lastType = "";
			$jquery = "";
			$count = 0;
			// loop through the process of constructing the elements for the study guide
			for ($i = 0; $i < count($typeTable); $i++){
				// make new category header
				makeCategory($typeTable[$i]['type']); 
				// add columns for category
				while($count < count($table) ){
					// check to see if question type hasn't changed, else break
					if ($lastType == $table[$count]['type']  or $lastType == ""){
						echo "<div class=\"columns\">"
						. "<div class=\"column\">"
						.	"<div class=\"notification\">"
						. "<p>{$table[$count]['question']}</p>"
						. "</div>"
						. "</div>"
						. "<div class=\"column\">"
						. "<a class=\"button is-info is-outlined is-large is-fullwidth\" id=\"butDefS{$count}\">Solution</a>"
						. "<p class=\"section notification is-bold hidden\" id=\"defS{$count}\">{$table[$count]['answer']}</p>"
						. "</div>"
						. "</div>";

						// implement jquery for solution buttons
						$jquery .= '$("#butDefS' . $count . '").click(function(){
							$("#defS' . $count . '").fadeToggle("slow");
						});';

						// store current question type for type checking
						$lastType = $table[$count]['type'];
						$count++;
					} else { 	
						$lastType = "";
						break; }				
				}
			}

			// finalize php and jquery, close out
			echo "<script>"
			.	"$(document).ready(function(){"
			. "{$jquery}"
			. "});"
			. "</script>";
			?> 
			<!-- end php -->
		</div>
	</section>
</body>
<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<!-- <script src="vue.js"></script> -->
</html>
