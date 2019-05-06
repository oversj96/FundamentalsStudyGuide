<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Math 300 Study Guide</title>
	<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css">
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
	<script src='show.js'></script>
	<!-- <link rel="stylesheet" href="styles/debug.css"> -->
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
				// echo html for header
				echo "<div class=\"notification is-dark header\" id =\"theorems\">"
				. "<h1 class=\"title\" >Definitions and Theorems</h1>"
				. "</div>";

			// setup sql connection and perform query
			require_once('docs/mysqli_connect.php');
			$query = "SELECT question, answer, type "
			. "FROM studyinfo";
			$response = @mysqli_query($conn, $query);

			// initialize variables for jquery and keep count of buttons
			$jqueryInside = "";
			$count = 0;

			// loop until no definitions
			while($responseRow = $response->fetch_assoc()){
				// check row type
				if ($responseRow['type'] != 'definition'){
					break 1;
				}
					echo "<div class=\"columns\">"
					. "<div class=\"column\">"
					.	"<div class=\"notification\">"
					. "<p>{$responseRow['question']}</p>"
					. "</div>"
					. "</div>"
					. "<div class=\"column\">"
					. "<a class=\"button is-info is-outlined is-large is-fullwidth\" id=\"butDefS{$count}\">Solution</a>"
					. "<p class=\"section notification is-bold hidden\" id=\"defS{$count}\">{$responseRow['answer']}</p>"
					. "</div>"
					. "</div>";

				// implement javascript for solution buttons
				$count++;			
				$jqueryInside .= '$("#butDefS' . $count . '").click(function(){
					$("#defS' . $count . '").fadeToggle("slow");
				});';
			}

			// echo html for header
			echo "<div class=\"notification is-dark header\" id =\"proofs\">"
				. "<h1 class=\"title\" >Proofs</h1>"
				. "</div>";

			// loop until no proofs
			while($responseRow = $response->fetch_assoc()){
				// check row type
				if ($responseRow['type'] != 'proof'){
					break 1;
				}
					echo "<div class=\"columns\">"
					. "<div class=\"column\">"
					.	"<div class=\"notification\">"
					. "<p>{$responseRow['question']}</p>"
					. "</div>"
					. "</div>"
					. "<div class=\"column\">"
					. "<a class=\"button is-info is-outlined is-large is-fullwidth\" id=\"butDefS{$count}\">Solution</a>"
					. "<p class=\"section notification is-bold hidden\" id=\"defS{$count}\">{$responseRow['answer']}</p>"
					. "</div>"
					. "</div>";

				// implement jquery actions for buttons
				$count++;			
				$jqueryInside .= '$("#butDefS' . $count . '").click(function(){
					$("#defS' . $count . '").fadeToggle("slow");
				});';
			}

			// echo html for header
			echo "<div class=\"notification is-dark header\" id =\"other\">"
				. "<h1 class=\"title\" >Multi-Part and Other Problems</h1>"
				. "</div>";

			// loop until no other questions, checking row type unneccessary at this stage
			while($responseRow = $response->fetch_assoc()){
					echo "<div class=\"columns\">"
					. "<div class=\"column\">"
					.	"<div class=\"notification\">"
					. "<p>{$responseRow['question']}</p>"
					. "</div>"
					. "</div>"
					. "<div class=\"column\">"
					. "<a class=\"button is-info is-outlined is-large is-fullwidth\" id=\"butDefS{$count}\">Solution</a>"
					. "<p class=\"section notification is-bold hidden\" id=\"defS{$count}\">{$responseRow['answer']}</p>"
					. "</div>"
					. "</div>";

				// implement jquery actions for buttons
				$count++;			
				$jqueryInside .= '$("#butDefS' . $count . '").click(function(){
					$("#defS' . $count . '").fadeToggle("slow");
				});';
			}

			// finalize php and jquery, close out
			echo "<script>"
			.	"$(document).ready(function(){"
			. "{$jqueryInside}"
			. "});"
			. "</script>";
			$conn->close();
			?> 
			<!-- end php -->
		</div>
	</section>
</body>
</html>
