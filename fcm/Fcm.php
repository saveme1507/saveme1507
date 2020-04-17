<?php
class Fcm
{
    function sendNotif($token, $judul, $isi)
    {

        $curl = curl_init();

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
"judul": "Notifikasi baru ",
"isi": "Laporan dari PT..."
},
"data": {
"judul": "' . $judul . '",
"isi": "' . $isi . '"
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
        // echo $response;
    }
}
