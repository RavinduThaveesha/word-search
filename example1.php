<?php 

include ('wordsearch.php');

$wordsearch = new WordSearch();
$wordsearch->string = "KEEDKFORFEEDS|GEEESQUIZFEED|EEEQAPRACTICE|FEEGEEJACTICE|GEEQAPRACTICE|FEEDAPRACTICE|KEEKKFORFEEDS";
$wordsearch->word = "FEED";

?>

<html>
<body>
	<table>
		<tr>
			<td>
			<h4>Matrix</h4>
				<?php echo $wordsearch->gridHtml(); ?>
			</td>
			<td>
				<h4>Result</h4>
				<?php echo $wordsearch->run()->resultHtml(); ?>
			</td>
		</tr>
	</table>
</body>
</html>

