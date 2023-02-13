# Latest Earthquakes Notifications in Turkey
#TR
Bu proje, Türkiye'deki son 10 depremi çekerek magnitude (ml olarak adlandırılmış) değerine göre abonelerin e-postalarına bildirim göndermeyi amaçlar. Bu veriler "https://hublabs.com.tr/api/tr-earthquakes" adresindeki API'den çekilir ve PHP PDO kullanılarak MySQL veritabanındaki aboneler tablosundan okunur. 6 ve üstündeki magnitude değerlerindeki depremlerin bilgisi abonelerin e-postalarına gönderilir.

------------------
#EN
This project aims to retrieve the latest 10 earthquakes in Turkey and notify subscribers via email based on the magnitude (referred to as "ml") value. The data is obtained from the API at "https://hublabs.com.tr/api/tr-earthquakes" and is read from the subscribers table in the MySQL database using PHP PDO. Information about earthquakes with a magnitude of 6 and above is sent to the subscribers' emails.
