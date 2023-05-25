<!DOCTYPE html>
<html>
<head>
    <title>P/E 計算器</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>P/E 計算器</h1>
    <form method="post" class="form">
        <table>
            <tr>
                <td><label for="price" class="label">Price:</label></td>
                <td><input type="number" step="0.01" name="price" id="price" required></td>
            </tr>
            <tr>
                <td><label for="eps" class="label">Earnings Per Share (EPS):</label></td>
                <td><input type="number" step="0.01" name="eps" id="eps" required></td>
            </tr>
        </table><br>
        <input type="submit" value="計算" class="btn">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $price = $_POST['price'];
        $eps = $_POST['eps'];
        if ($eps == 0) {
            echo "Error: EPS cannot be zero.";
        } else {
            $pe_ratio = $price / $eps;
            echo "<p>The P/E ratio is: " . round($pe_ratio, 2) . "</p>";
        }
    }
    ?>
</body>
</html>