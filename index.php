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
</style>
<!-- /.hero -->
<body>
	<section class="hero is-primary is-bold">
		<div class="hero-body">
			<h1 class="title" color="white">
				Math 300 
			</h1>
			<p class="subtitle">
				A study guide website
			</p>
		</div>
	</section>

	<!-- study guide -->
	<section class="section" id="studyGuide">
		<div class="container is-fluid">
			<div class="notification is-dark" id ="theorems">
				<strong><center>Definitions and Theorems</center></strong>
			</div>
		<?php
		require_once('docs/mysqli_connect.php');
		$query = "SELECT question, answer
		          FROM studyinfo";
		$response = @mysqli_query($conn, $query);

		$jqueryInside = "";
		$count = 0;
		while($responseRow = $response->fetch_assoc()){
			$count++;
			echo "<div class=\"columns\">
				<div class=\"column\">
					<div class=\"notification\">
						<p>
							{$responseRow['question']}
						</p>
					</div>
				</div>
				<div class=\"column\">
					<button class=\"button is-info is-outlined is-large is-fullwidth\" id=\"butDefS{$count}\">Solution</button>
					<p class=\"section notification is-bold hidden\" id=\"defS{$count}\">
					{$responseRow["answer"]}
					</p>
				</div>
			</div>";
			$jqueryInside .= '$("#butDefS' . $count . '").click(function(){
  													$("#defS' . $count . '").toggleClass("hidden");
  											});';
		}
		echo "<script>
						$(document).ready(function(){
							{$jqueryInside}
						});
					</script>";
		?> 
	</section>
</body>
</html>
