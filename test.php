<?php

// Türkiye'deki son 10 depremin verilerini çekmek için API adresi
$url = "https://hublabs.com.tr/api/tr-earthquakes";

// API verilerini cURL ile çek
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$data = curl_exec($ch);
curl_close($ch);

// API'den gelen verileri PHP dizisi olarak çöz
$earthquakes = json_decode($data, true);

// Veritabanı bağlantısı kur
$dsn = "mysql:host=localhost;dbname=database_name";
$pdo = new PDO($dsn, "database_user", "database_password");

// 6.0 ve üstündeki depremleri bul
foreach ($earthquakes as $earthquake) {
    if ($earthquake["magnitude"] >= 6.0) {
        // 6.0 ve üstündeki depremin tarihi
        $date = $earthquake["time"];
        
        // Aboneler tablosundaki mailleri çek
        $stmt = $pdo->prepare("SELECT email FROM subscribers");
        $stmt->execute();
        $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Her aboneye mail gönder
        foreach ($subscribers as $subscriber) {
            $to = $subscriber["email"];
            $subject = "Yeni bir deprem oldu: " . $date;
            $message = "Tarih: " . $date . "\nBüyüklük: " . $earthquake["magnitude"] . "\nKonum: " . $earthquake["place"];
            $headers = "From: deprem@example.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();
            mail($to, $subject, $message, $headers);
        }
    }
}

?>
