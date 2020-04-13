<?php


$curl = curl_init();

$token = '[
    "f0fv4vx4Ge0:APA91bFGsmz6y6xZsQf9nCSIvzJVsN0PtcsCVs4JzF3JPabd13_N0oB3iGWIcgELWLIfaSfH2cPfJ6aTTIlcvZjMCRcdSzOzwg9FHlQpz1SN1MiDacl-3AQFDqQTpOOu4JAzZ2SzZw-f",
    "cHZM9KrNO_4:APA91bHDhTa7ewYEBthOFGZkatLX78cm1NLfmq_8WWgTz_Fukawfmqk9qUL5J1zNpbh5LbRAac8-Uz9EIgIDrWKVDm-LvXjlMNFOMtUXKFegj20tCGUAxVe0BA1I-gT_rK6-5x0bL3RA",
    "cy0Fm38ZIOA:APA91bHAw9IHOsLltgeH7UUzpgY9FfL0CGAFbmqmZo_eWT0U4-LHRO1PwFm3tE0dzlry5aqzaw4wQ6VfJB0nlS_6GaJSE-RuYeb4jMLc5TAZ0cHaYVnvQM1LdPE8E0oZXOu0oxDpt06w"
]';


curl_setopt_array($curl, array(
    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
    "registration_ids": ' . $token . ',
    "collapse_key": "type_a",
    "notification": {
        "judul": "Judul notifikasi default",
        "isi": "Isi notifikasi default"
    },
    "data": {
        "judul": "Body of Your Notification in Data",
        "isi": "Title of Your Notification in Title"
    }
}',
    CURLOPT_HTTPHEADER => array(
        "Authorization: key=AAAAYwXEOOg:APA91bEUAFCNo8kJ6t47cHx1pHU2Im0rux6xJRMKKry-jAxq3yX3toQXqdZ2DxwPeyf5qlaqysoEYiN23u2TLdQprCUST7uG3cEAnc8ae4GqoEMN9bT_1kaLAnu4uI7STqF11v77cubo",
        "Content-Type: application/json",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
