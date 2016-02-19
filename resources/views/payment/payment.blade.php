<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

<?php

$salt='eCwWELxi';
$key='gtKFFx';

$surl = $callbacks['success'];
$furl = $callbacks['failure'];
$curl = $callbacks['cancel'];

$hash = hash('sha512',$key.'|'.$transaction['invoice_id'].'|'.$transaction['amount'].'|'.$transaction['id'].'|'.$buyer['candybrush_users_profiles_name'].'|'.$buyer['email'].'|||||||||||'.$salt);
?>
<form id="myform" action='https://test.payu.in/_payment' method='post'>
    <input type="hidden" name="firstname" value="<?php echo $buyer['candybrush_users_profiles_name'] ?>" /><br/>
    <input type="hidden" name="lastname" value=""/><br/>
    <input type="hidden" name="surl" value="<?php echo $surl; ?>" />

    <input type="hidden" name="phone" value="<?php echo $buyer['candybrush_users_profiles_mobile'] ?>" /><br/>

    <input type="hidden" name="key" value="<?php echo $key; ?>" />
    <input type="hidden" name="hash" value = "<?php echo $hash; ?>" />
    <input type="hidden" name="curl" value="<?php echo $curl; ?>" />
    <input type="hidden" name="furl" value="<?php echo $furl; ?>" />

    <input type="hidden" name="txnid" value="<?php echo $transaction['invoice_id']; ?>" />

    <input type="hidden" name="productinfo" value="<?php echo $transaction['id']; ?>" />
    <input type="hidden" name="amount" value="<?php echo $transaction['amount']; ?>" /><br/>

    <input type="hidden" name="email" value="<?php echo $buyer['email'] ?>" /><br/>

</form>
<script>
    $('#myform').submit();
</script>
</body></html>