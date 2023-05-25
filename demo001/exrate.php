<?php
    // 從表單中獲取基準貨幣，目標貨幣和金額
    $base_currency = $_POST['base-currency'];
    $target_currency = $_POST['target-currency'];
    $amount = $_POST['amount'];

    // 設置API URL和API密鑰
    $api_key = '5a50dfb951df22b49fb8c944';
    $api_url = "https://v6.exchangerate-api.com/v6/{$api_key}/latest/{$base_currency}";

    // 初始化cURL會話
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // 執行cURL請求並獲取結果
    $response = curl_exec($ch);
    curl_close($ch);

    // 解碼JSON響應
    $data = json_decode($response, true);

    // 檢查是否存在錯誤
    if ($data['result'] == 'error') {
        echo "Error: " . $data['error-type'];
    } else {
        // 獲取匯率並計算結果
        $rate = $data['conversion_rates'][$target_currency];
        $converted_amount = round($amount * $rate, 2);
        echo "即時匯率: 1 {$base_currency} = {$rate} {$target_currency}<br>";
        echo "轉換金額: {$amount} {$base_currency} = {$converted_amount} {$target_currency}";
    }
?>