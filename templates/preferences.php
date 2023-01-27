<?php
use inc\Webhooks;
use inc\Api;
global $wpdb;
$error=null;
$isApproved=null;
$button="Save preferences";
$tbName= $wpdb->prefix . 'woocommerce_api_keys';
$options=[
    ['Order created','order_created'],
    ['Order updated','order_updated'],
    ['Order deleted','order_deleted'],
    ['Product created','product_created'],
    ['Product updated','product_updated'],
    ['Product deleted','product_deleted'],
    ['Product restored','product_restored']
];
// if(isset($_GET['wrapup'])){
$apiKey=$wpdb->get_results("SELECT * FROM $tbName WHERE description='OneMessage - API'");
if(!$apiKey){
    if(isset($_GET['permission'])){
        $isApproved=$_GET['permission']=="granted";
        wp_safe_redirect( admin_url('admin.php?page=one_message'));
    }
    if($isApproved){
        // dd("Action preformed successfully");
        $Key=Api::create_keys();
    }
}else{
    $permission=$apiKey[0]->permissions=='read_write';
    if(!$permission)
        $error="please update the permissions of the Api key to Read/Write";
    //elseif($apiKey[0]->consumer_key==null||$apiKey[0]->consumer_secret==null)
        //Regenerate Api Key
    else{
    $WSName=$wpdb->get_results("SELECT WSName FROM {$wpdb->prefix}One");
    // header(sprintf("Location: https://%s.onemessage.chat/automations",$WSName[0]->WSName));
    // exit();
    if(isset($_GET['order_created'])){
        for($i=0;$i<count($options);$i++){
            array_push($options[$i],$_GET[$options[$i][1]]);
        }
        Webhooks::saving($options);
        wp_safe_redirect( admin_url('admin.php?page=one_message'));
    }
}
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
        <!-- <h1>Preferences</h1> -->
        <div class="login_container wcp">
            <?php
            if(!$apiKey){
                if(!$isApproved){
                    echo '<img class="logo" src="' . PLUGIN_URL . 'assets/OneMessage_logo.png" alt="OneMessage" />
                    <div class="content">
                    <h2>OneMessage would like to connect to your store</h2>
                    <p>This will give &quot;<strong>OneMessage</strong>&quot; <strong>Read/Write</strong> access which will allow it to:</p>
                    <ul class="permissions">
                        <li>Create webhooks</li>
                        <li>View and manage customers</li>
                        <li>View and manage orders and sales reports</li>
                        <li>View and manage products</li>
                        <li>View and manage coupons</li>
                    </ul>
                    <div class="buttons">
                    <a href="" class="button button-primary" id="approve">Approve</a>
                    <a href="" class="button" id="deny">Deny</a>
                    </div>
                    ';
                }
            }
            else{
                // echo '<h2 id="error">' . $error . '</h2>';
                echo '<h1>Webhook prefrecnces</h1><div class="prefs">';
                    foreach($options as $option){
                        echo "<input type=\"checkbox\" class=\"check\" name=\"$option[1]\"/>
                        <label for=\"$option[1]\">
                        <span>$option[0]</span>
                        </label><br>";
                    };
                    echo '<br><button class="button-primary" onclick="sendApiK()"> ' . $button . ' </button></div>';
            }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    if(document.getElementById('approve')){
        document.getElementById('approve').href=window.location.href + "&permission=granted";
        document.getElementById('deny').href=window.location.href + "&permission=denied";
    }
    if(document.getElementById('wrapup'))
    document.getElementById('wrapup').href=window.location.href + "&wrapup=true";
    function sendApiK(){
        let actions=document.getElementsByClassName('check');
        actions=Object.entries(actions);
        let results="";
        actions.forEach((action=>{
            results+="&"+action[1].name+"="+action[1].checked;
        }));
        location.href = window.location.href + results;  
        console.log(results);
    }
</script>
</html>

