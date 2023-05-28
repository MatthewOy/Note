<?php
    // 目標URL
    $page_url = ''; 
    // 存檔目錄
    $save_dir = ''; 
    // CA包路徑
    $cacert_path = ''; 

    // 創建資料夾，失敗則退出
    if (!is_dir($save_dir)) {
        if (!mkdir($save_dir)) {
            exit('Error: Failed to create directory'); 
        }
    }
    //用 cURL 函數庫來發送 HTTP 請求，以獲取指定網頁的內容
    $ch = curl_init();
    //設置選項，驗證 SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
    //指定 CA 包路徑
    curl_setopt($ch, CURLOPT_CAINFO, $cacert_path); 
    //指定網頁 URL
    curl_setopt($ch, CURLOPT_URL, $page_url);       
    //將 curl_exec() 函數的返回值設為網頁內容，而不是直接輸出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
    //設置cookie
    curl_setopt($ch, CURLOPT_COOKIE, 'over18=1');
    //執行 cURL 會話，並將返回的網頁內容存儲在 $html 變量中
    $html = curl_exec($ch);                         

    // 輸出cURL錯誤訊息
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch); 
    }

    curl_close($ch);
    // 如果網頁內容get失敗則退出
    if (empty($html)) {
        exit('Error: Failed to get page content'); 
    }

    $doc = new DOMDocument();
    //加載網頁內容到 DOMDocument
    @$doc->loadHTML($html);
    //從 DOMDocument 中獲取所有 <img> 元素
    $tags = $doc->getElementsByTagName('img');
    
    // 初始化計數器
    $counter = 1; 
    //遍歷所有 <img> 元素，從中獲取 src 屬性值，即圖像URL
    foreach ($tags as $tag) {
        $url = $tag->getAttribute('src');
        $extension = pathinfo($url, PATHINFO_EXTENSION);
            if ($extension == 'gif') {
                $save_path = $save_dir . sprintf('image%03d.gif', $counter);
            } else {
                $save_path = $save_dir . sprintf('image%03d.jpg', $counter);
            }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, $cacert_path);
        //開啟文件指針，用於將下載的圖像保存到本地文件中
        $fp = fopen($save_path, 'wb');
        //設置選項，將下載的圖像保存到指定文件中
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $counter++; // 遞增
    }
?>