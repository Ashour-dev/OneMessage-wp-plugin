<?php
$firstStep=false;
$logedin=false;
$alreadyUser=null;
$WSC=null;
$ApiC=null;
$apiKPagelink="Workspace undefined";
use inc\Init;
use inc\RegistrationFuncs;

// $WSName=null;

/*session created*/

if(isset($_GET['alreadyUser'])){
    $alreadyUser=$_GET['alreadyUser'];
};
if(isset($_GET['WSName'])){
    $WSName= $_GET['WSName'];
    $response=RegistrationFuncs::WSCheck($WSName);
    if ($response==false)
        $WSC='Workspace not found';
    else{
        $WSC='Workspace found';
        $_SESSION['WSName']=$WSName;
        $apiKPagelink="https://" . $WSName . ".onemessage.chat/api-key/list";
    }
};
if(isset($_GET['ApiK'])){
    $ApiK=$_GET['ApiK'];
    $request = new HTTP_Request2();
    $request->setUrl("https://$WSName.onemessage.chat/api/v1/social-profiles");
    $request->setMethod(HTTP_Request2::METHOD_GET);
    $request->setConfig(array(
    'follow_redirects' => TRUE
    ));
    $request->setHeader(array(
    'Authorization' => "Bearer $ApiK"
    ));
    try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        $ApiC="Api Key valid";
        $_SESSION['ApiK']=$ApiK;
        $_SESSION['AllSet']=true;
        Init::db_initiazlization();
        RegistrationFuncs::StoreSessionVars();
    }
    else {
        if($response->getStatus() == 401){
            $ApiC="Api Key is Invalid";
        }else{
            $ApiC='Unexpected HTTP status: ' . $response->getStatus() . ' ' .$response->getReasonPhrase();
        }
    }
    }
    catch(HTTP_Request2_Exception $e) {
        // $ApiC=null;
        // dd($e->getMessage());
        echo 'Error: ' . $e->getMessage();
    }
    // $ApiC=RegistrationFuncs::ApiKCheck($WSName,$ApiK);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="OneMessagePage">
        <!-- <h1>Getting Started</h1> -->
        <div class="login_container">
            <?php if($alreadyUser==null){
            echo'<h1>Hey There! Are you already a OneMessage user?</h1>
            <div class="buttons-cont">
            <a href="?page=one_message&alreadyUser=yes">Yes</a><a href="?page=one_message&alreadyUser=no">Not yet</a>
            </div>';
            };
            if ($alreadyUser=='yes'&& $WSC!='Workspace found'){
                echo'
                    <div class="WSStep">
                        <h1>Insert your worksace name</h1>
                        <input id="WSName" name="WSName" type="text">
                        <span id="errorWS">' . $WSC .'</span>
                        <button class="button-primary"
                        onclick="sendWSN()">look for my Workspace</button>
                    </div>';
                        // onsubmit="sendWSN()"
                        // href="?page=one_message&alreadyUser=yes&WSINserted=true" type="submit"
            };
            if ($alreadyUser=='no'){
                // echo'
                // <div class="bookDemo">
                // <a href="https://www.onemessage.chat/book-a-demo/">Book a demo</a>
                // </div>';
                header("Location: https://www.onemessage.chat/book-a-demo/");
                exit();
            };
            if($WSC=='Workspace found' && $ApiC!="Api Key valid"){
                echo'
                    <div class="WSStep">
                        <h1>Insert your Api Key</h1>
                        <input id="ApiK" name="ApiK" type="text">
                        <span id="errorApi">' . $ApiC . '</span>
                        <button class="button-primary"
                        onclick="sendApiK()">Check the Api Key</button>
                        <a href="' . $apiKPagelink . '" target="OneMessage" id="apiKPage">Api Keys page</a>
                    </div>';
                }
            if($ApiC=="Api Key valid"){
                echo'
                <div class="all-set"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:none;}
                    .st1{fill:#121331;}
                </style>
                <g id="bounding_area">
                    <rect class="st0" width="10" height="10"/>
                </g>
                <g id="design">
                    <g>
                        <path class="st1" d="M10.66,16c-0.19,0-0.38-0.07-0.53-0.22l-2.51-2.5c-0.29-0.29-0.29-0.77,0-1.06c0.29-0.29,0.77-0.29,1.06,0    l1.98,1.97l4.98-4.98c0.29-0.29,0.77-0.29,1.06,0c0.29,0.29,0.29,0.77,0,1.06l-5.51,5.51C11.04,15.93,10.85,16,10.66,16z"/>
                        <path class="st1" d="M11.99,22c-2.58,0-5.02-0.97-6.89-2.76c-1.93-1.84-3.03-4.33-3.1-7C1.87,6.73,6.25,2.14,11.76,2    c2.67-0.06,5.21,0.91,7.14,2.76c1.93,1.84,3.03,4.33,3.1,7l0,0c0.06,2.67-0.91,5.21-2.76,7.14c-1.84,1.93-4.33,3.03-7,3.1    C12.16,22,12.07,22,11.99,22z M12.01,3.5c-0.07,0-0.14,0-0.21,0c-4.69,0.11-8.41,4.02-8.29,8.7c0.05,2.27,0.99,4.38,2.63,5.95    s3.79,2.4,6.07,2.34c2.27-0.05,4.38-0.99,5.95-2.63s2.4-3.8,2.34-6.07l0,0c-0.05-2.27-0.99-4.38-2.63-5.95    C16.27,4.33,14.2,3.5,12.01,3.5z"/>
                    </g>
                </g>
                </svg> 
                <h1>You are all set</h1>
                </div>';
            }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    document.getElementById("WSName")?document.getElementById("WSName").addEventListener("keydown", (e) => {if (e.key == "Enter"){sendWSN();}}):"";
    document.getElementById("ApiK")?document.getElementById("ApiK").addEventListener("keydown", (e) => {if (e.key == "Enter"){sendApiK();}}):"";
    function sendWSN() {
        let WSN=document.getElementById("WSName").value.trim();
        errF=document.getElementById("errorWS");
        if(WSN.length==0){
            errF.textContent="Please enter the name of your Workspace";
        }else
        location.href = window.location.href + "&WSName=" + WSN;
    }
    function sendApiK(){
        let ApiK=document.getElementById("ApiK").value.trim();
        errF=document.getElementById("errorApi");
        if(ApiK.length==0){
            errF.textContent="Please enter your Api Key";
        }else
        location.href = window.location.href + "&ApiK=" + ApiK;
    }

</script>
</html>