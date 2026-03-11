<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kalkulator Kredytowy</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        label { display: block; margin: 10px 0 5px; }
        input, select { padding: 5px; width: 200px; }
    </style>
</head>
<body>

<h2>Kalkulator Kredytowy</h2>

<form action="calc.php" method="get">
    <label>Kwota kredytu:</label>
    <input type="text" name="amount" value="<?php echo $amount ?? ''; ?>">

    <label>Liczba lat:</label>
    <input type="text" name="years" value="<?php echo $years ?? ''; ?>">

    <label>Oprocentowanie roczne:</label>
    <select name="interest">
        <option value="2" <?php if(($interest ?? '') == '2') echo 'selected'; ?>>2%</option>
        <option value="4" <?php if(($interest ?? '') == '4') echo 'selected'; ?>>4%</option>
        <option value="6" <?php if(($interest ?? '') == '6') echo 'selected'; ?>>6%</option>
        <option value="8" <?php if(($interest ?? '') == '8') echo 'selected'; ?>>8%</option>
    </select>

    <br><br>
    <input type="submit" value="Oblicz miesięczną ratę">
</form>

<?php

if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:400px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:400px;">
<?php 
    $formatted_result = number_format((float)$result, 2, ',', ' ');
    echo 'Twoja miesięczna rata wynosi: ' . $formatted_result . ' PLN'; 
?>
</div>
<?php } ?>

</body>
</html>