<?php
$firstStep=false;
$logedin=false;
$alreadyUser=null;
$WSC=null;
if(isset($_GET['alreadyUser'])){
    $alreadyUser=$_GET['alreadyUser'];
    echo 'alreadyUser=' . $alreadyUser;
};
if(isset($_GET['WSINserted'])){
    $WSName= $_GET['WSName'];
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

    // $response = curl_exec($curl);
    $response = curl_exec($curl);

    curl_close($curl);
    // dd($response);
    if ($response==false)
        $WSC='Workspace not found';
    else{
        $WSC='Workspace found';
        // require_once plugin_dir_path(__FILE__) . '../assets/globals.php';
        // $GLOBALS['WSName']=$WSName;
        // dd($GLOBALS);
    }
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
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
                        <span class="error">' . $WSC .'</span>
                        <button
                        onclick="sendWSN()">look for my Workspace</button>
                    </div>';
                        // onsubmit="sendWSN()"
                        // href="?page=one_message&alreadyUser=yes&WSINserted=true" type="submit"
            };
            if ($alreadyUser=='no'){
                echo'
                <div class="bookDemo">
                <a href="https://www.onemessage.chat/book-a-demo/">Book a demo</a>
                </div>';
            };
            if($WSC=='Workspace found'){
                echo'<h1>Workspace found</h1>';
            }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    function sendWSN(){
        // e.preventDefault();
        // let WSN=$('input[name=WSName]').val();
        // let formAction=document.getElementById("WSForm").action;
        // formAction+=WSN;
        let WSN=document.getElementById("WSName").value;
        console.log(WSN.length);
        if(WSN.length==0){
            errF=document.getElementsByClassName("error");
            console.log(errF)
            errF.textContent="Please enter the name of your Workspace";
        }else
        location.href = "/wp-admin/admin.php?page=one_message&alreadyUser=yes&WSINserted=true&WSName=" + WSN ;
        // newLink+=WSN;
        // alert(newLink);
        // form.submit();
        // $.ajax({
        //     type:'post',
        //     data:{WSName:WSN},
        //     success:(response)=>{
        //         $_POST['WSName']=WSN;
        //     },
        // })
        // $.post("?page=one_message&alreadyUser=yes&WSINserted=true",WSN,()=>WSName=WSN)
    }

</script>
</html>