<?php
use inc\Webhooks;
// DefaultFuncs::StoreSessionVars();
global $wpdb;
$error=null;
$isConfigured=null;
$button="Submit";
$tbName= $wpdb->prefix . 'woocommerce_api_keys';
$options=[
    ['Contact created','contact_created'],
    ['Contact updated','contact_updated'],
    ['Contact deleted','contact_deleted'],
    ['Product created','product_created'],
    ['Product updated','product_updated'],
    ['Product deleted','product_deleted'],
    ['Product restored','product_restored']
];
$apiKey=$wpdb->get_results("SELECT * FROM $tbName WHERE description='OneMessage'");
$permission=$apiKey[0]->permissions=='read_write';
if(!$apiKey)
    $error="Api Key Not Found";
elseif(!$permission)
    $error="please update the permissions of the Api key to Read/Write";
elseif($apiKey[0]->consumer_key==null||$apiKey[0]->consumer_secret==null)
    $error="Somthing went wrong please delete the key that you have created and create a new one";
else{
    $isConfigured=true;
    if(isset($_GET['contact_created'])){
        for($i=0;$i<count($options);$i++){
            array_push($options[$i],$_GET[$options[$i][1]]);
        }
        Webhooks::saving();
    }
}
        // dd($apiKey[0]->consumer_key);

    // var_dump($_GET);
    dd($options)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="OneMessagePage">
        <!-- <h1>Preferences</h1> -->
        <div class="login_container wcp">
            <?php
            if(!$error){
                if(!$isConfigured){
                    echo '<h2>Now We need to setup the connection between <br> Our platform and woocommerce</h2> 
                    <h4>To setup that connection you will need to follow some <a href="/">simple steps</a></h4>
                    <h4>Once you finish these steps please click <a id="wrapup" href="/">here</a></h4>
                    ';
                }
                else{
                    // $fn="../inc/Webhooks.php";
                    // echo'<h1>Webhooks</h1><form action="' . $fn . '">';
                    foreach($options as $option){
                        echo"<input type=\"checkbox\" class=\"check\" id=\"$option[1]\"/>
                        <label for=\"$option[1]\">
                        <span>$option[0]</span>
                        </label><br>";
                    };
                    echo '<br><input onclick="sendApiK()" type="submit" value="' . $button . '">';
                    // </form>';
                }
            }
            else{
                echo '<h2 id="error">' . $error . '</h2>';
            }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    // document.getElementById('wrapup').href=window.location.href + "&wrapup=true";
    function sendApiK(){
        let actions=document.getElementsByClassName('check');
        actions=Object.entries(actions);
        let results="";
        actions.forEach((action=>{
            results+="&"+action[1].id+"="+action[1].checked;
            // console.log(action[1].checked)
        }));
        location.href = window.location.href + results;  
        console.log(results);
    }
</script>
</html>

