<?php
namespace inc;
// require_once PLUGIN_PATH . 'vendor/pear/http_request2/HTTP/Request2.php';
// use HTTP\HTTP_Request2;

class RegistrationFuncs{
public static function WSCheck($WSName){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://' . $WSName . '.onemessage.chat/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
// public static function ApiKCheck($WSName,$ApiK){
//     $request = new HTTP_Request2();
//     $request->setUrl("https://$WSName.onemessage.chat/api/v1/social-profiles");
//     $request->setMethod(HTTP_Request2::METHOD_GET);
//     $request->setConfig(array(
//     'follow_redirects' => TRUE
//     ));
//     $request->setHeader(array(
//     'Authorization' => "Bearer $ApiK"
//     ));
//     try {
//     $response = $request->send();
//     if ($response->getStatus() == 200) {
//         $ApiC="Api Key valid";
//         $_SESSION['ApiK']=$ApiK;
//         $_SESSION['AllSet']=true;
//         Init::db_initiazlization();
//         DefaultFuncs::StoreSessionVars();
//     }
//     else {
//         if($response->getStatus() == 401){
//             $ApiC="Api Key is Invalid";
//         }else{
//             $ApiC='Unexpected HTTP status: ' . $response->getStatus() . ' ' .$response->getReasonPhrase();
//         }
//     }
//     }
//     catch(HTTP_Request2_Exception $e) {
//         $ApiC= 'Error: ' . $e->getMessage();
//     }
//     return $ApiC;
// }
}