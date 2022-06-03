<?php

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$toEncrypt = "2022-ADMIN-00010-EBA9C";
$toDecrypt = "NRM3axHGNfKIIX7xrdqYnijEBA2h0R5DWYWgCMdbZEkLvQ8svM7exfx9ecs7W ELwZlzy4BGOMGMQAK6hJo4p9iu3MQGXYFI6drWzxtTvgv3cE21MIXOLkHFBBaLrSy0zgRs58iPU34SkmIPC/etjg==";

// echo $admin->secured_encrypt($toEncrypt);
echo "<br>";
echo $admin->secured_decrypt($toDecrypt);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        echo $_POST['sample'];
    }
}

// TaqbSm0PeT8q4YFViV50q1W7o94IPY5yTO62auQq+J+sciKYo+pTif88xCtWuzX6vJNehn57gvQRREc2UrkdWlt2Oj2XLE06gZYa+GpLYKpIpfoG7hLLkH9v7QuuGWDSPo/1T1SbQjmPgm+Wu91CWA==
// TaqbSm0PeT8q4YFViV50q1W7o94IPY5yTO62auQq+J+sciKYo+pTif88xCtWuzX6vJNehn57gvQRREc2UrkdWlt2Oj2XLE06gZYa+GpLYKpIpfoG7hLLkH9v7QuuGWDSPo/1T1SbQjmPgm+Wu91CWA==
// 9gjCDNgOT0OJHQgTAt2Oz7jS6RgBXn3XnZVhSq/DI6xXi5/Wad0Ed/UMqEHckAcp3ItEJAvgvoYwuhlJePznaG4gFtokZlK72fo/H6r/a5p7ZRV+IotCrxc26inLtPTiv56yulo359aVVRlpk/31gQ==

// Store a string into the variable which
// need to be Encrypted
$simple_string = "Welcome to GeeksforGeeks\n";
  
// Display the original string
echo "Original String: " . $simple_string;
  
// Store the cipher method
$ciphering = "AES-128-CTR";
  
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
  
// Non-NULL Initialization Vector for encryption
echo $iv = openssl_random_pseudo_bytes($iv_length);
  
// Store the encryption key
$encryption_key = "GeeksforGeeks";
  
// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($simple_string, $ciphering,
            $encryption_key, $options, $iv);
  
// Display the encrypted string
echo "Encrypted String: " . $encryption . "\n";
  
// Non-NULL Initialization Vector for decryption
// $decryption_iv = openssl_random_pseudo_bytes($iv_length);
  
// Store the decryption key
$decryption_key = "GeeksforGeeks";
  
// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ($encryption, $ciphering, 
        $decryption_key, $options, $iv);
  
// Display the decrypted string
echo "Decrypted String: " . $decryption;

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" name="sample" id="sample">
    <button type="submit" value="submit" name="submit">submit</button>

</form>

