<?php
// namespace templates;
use inc\DefaultFuncs;
// DefaultFuncs::StoreSessionVars();

// $DefaultFuncs=new DefaultFuncs();
// $WSName= $DefaultFuncs.$WSName;

    // echo "+++++++++++++++++++++" .  $WSName;
    // echo "+++++++++++++++++++++" .  $ApiK;
    // echo "+++++++++++++++++++++" .  $AllSet;



    $request = new HTTP_Request2();
    $request->setUrl("https://" . $_SESSION['WSName'] .".onemessage.chat/api/v1/social-profiles");
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
    'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
    'Authorization' => "Bearer " . $_SESSION['ApiK']
    ));
    try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        $responseBody=$response->getBody();
        var_dump($responseBody);
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .$response->getReasonPhrase();
    }
    }
    catch(HTTP_Request2_Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="OneMessagePage">
        <h1>Preferences</h1>
        <div>
            <h2>Social Profiles</h2>
        </div>
    </div>
</body>
</html>

