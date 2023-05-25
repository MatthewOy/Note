<!DOCTYPE html>
<html>
<head>
    <title>P/B 計算器</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>P/B 計算器</h1>
    <form method="post" class="form">
        <label for="market_value" class="label">市值:</label>
        <input type="number" step="0.01" name="market_value" id="market_value" required><br><br>
        <label for="book_value" class="label">帳面價值:</label>
        <input type="number" step="0.01" name="book_value" id="book_value" required><br><br>
        <input type="submit" value="計算" class="btn">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $market_value = $_POST['market_value'];
        $book_value = $_POST['book_value'];
        if ($book_value == 0) {
            echo "錯誤：帳面價值不能為零。";
        } else {
            $pb_ratio = $market_value / $book_value;
            echo "<p>P/B 比率為: " . round($pb_ratio, 2) . "</p>";
            if ($pb_ratio < 1) {
                echo "<p>股票可能被低估。</p>";
            } elseif ($pb_ratio > 1) {
                echo "<p>股票可能被高估。</p>";
            } else {
                echo "<p>合理價。</p>";
            }
        }
    }
    ?>
</body>
</html>