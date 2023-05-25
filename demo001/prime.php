<?php
if (isset($_POST['start']) && isset($_POST['end'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    echo "{$start}到{$end}之間的質數為:<br><hr>";
    $i = $start;
    $sum = 0;
    while ($i <= $end) {
        if ($i == 1 || $i == 0) {
            $i++;
            continue;
        }
        $f = 1;
        $j = 2;
        while ($j <= intval($i / 2)) {
            if ($i % $j == 0) {
                $f = 0;
                break;
            }
            $j++;
        }
        if ($f == 1){
            echo $i . " ";
            $sum += $i;
        }
        $i++;
    }
    echo "<hr>區間內質數相加總和為: {$sum}";
}
?>

<!DOCTYPE html>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>簡易質數計算</title>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<form action="prime.php" method="post" class="form">
    <div class="label">開始數字:</div>
    <input type="number" name="start" id="start">
    <br>
    <div class="label">結束數字:</div>
    <input type="number" name="end" id="end">
    <br>
    <input type="submit" value="提交" class="btn">
    <input type="reset" value="重設" class="btn">
</form>
</body>
</html>