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


$hash = hash('sha512',$key.'|'.$transaction['travally_transaction_details_txn_id'].'|'.$transaction['travally_transaction_details_amount'].'|'.$transaction['travally_transaction_details_txn_id'].'|'.$user['travally_profiles_name'].'|'.$user['email'].'|||||||||||'.$salt);?>

    <form id="myform" action='https://test.payu.in/_payment' method='post'>
    <input type="hidden" name="firstname" value="<?php echo $user['travally_profiles_name'] ?>" /><br/>
    <input type="hidden" name="lastname" value=""/><br/>
    <input type="hidden" name="surl" value="<?php echo $surl; ?>" />
    <input type="hidden" name="phone" value="8285846853" /><br/>
    <input type="hidden" name="key" value="<?php echo $key; ?>" />
    <input type="hidden" name="hash" value = "<?php echo $hash; ?>" />
    <input type="hidden" name="curl" value="<?php echo $curl; ?>" />
    <input type="hidden" name="furl" value="<?php echo $furl; ?>" />
    <input type="hidden" name="txnid" value="<?php echo $transaction['travally_transaction_details_txn_id']; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $transaction['travally_transaction_details_txn_id']; ?>" />
    <input type="hidden" name="amount" value="<?php echo $transaction['travally_transaction_details_amount']; ?>" /><br/>
    <input type="hidden" name="email" value="<?php echo $user['email'] ?>" /><br/>
</form>
<script>
    $('#myform').submit();
</script>
</body></html>