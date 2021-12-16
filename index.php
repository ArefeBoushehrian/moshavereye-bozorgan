<?php
$question = 'این یک پرسش نمونه است';
$msg = 'این یک پاسخ نمونه است';
$en_name = 'hafez';
$fa_name = 'حافظ';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>

<?php

$strJsonFileContents = file_get_contents('people.json');
$obj =json_decode($strJsonFileContents, true);

$strtext=fopen("messages.txt","rb");

while(!feof($strtext)){

	$line_of_text[]=fgets($strtext);
}
fclose($strtext);
?>

<?php 
	$question= $_POST["question"];
	$person= $_POST["person"];
	$en_name=$person;
	$fa_name=$obj[$person];
	$x=hash('md5', "$question");
	$y=hash('md5', "$person");
	$arrlenght=count($line_of_text);
	$z=$x+$y;
	$msg=$line_of_text[(($z)%($arrlenght))];
?>

<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">

<?php 
if($question ==null)
{ $msg='سوال خود را بپرس!';
$person=array_rand($obj,1);
$fa_name=$obj[$person];
$en_name=$person;
?>
<?php }else { ?>

        	<span id="label">پرسش:</span>        	
	<span id="question"><?php echo $question ?></span>
<?php } ?>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php
                /*
                 * Loop over people data and
                 * enter data inside `option` tag.
                 * E.g., <option value="hafez">حافظ</option>
                 */
	
	foreach ($obj as $key => $value)
	{
		if($en_name==$key){
			echo "<option value=".$key." selected>$value </option>";}
		else{
			echo "<option value=".$key.">$value </option>";}
	}
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>
