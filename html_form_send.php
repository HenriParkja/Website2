<?php
if(isset($_POST['email'])) {

    // CHANGE THE TWO LINES BELOW
    $email_to = "";

    $email_subject = "Kontaktivormi kaudu saadetud sõnum kodulehelt";


    function died($error) {
        // your error code can go here
        echo "Meil on väga kahju, kuid leidsime teie sõnumis vigu. ";
        echo "Tuvastasime järgmised vead:<br /><br />";
        echo $error."<br />";
        echo "Palun mine tagasi ning paranda need vead.<br /><br />";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Meil on kahju, kuid teie päringuga tuli ette probleeme.');
    }

    $first_name = $_POST['first_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= ' - Sisestatud e-maili aadress ei paista olevat korrektne.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= ' - Sisestatud eesnimi ei paista olevat korrektne.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= ' - Teie sisestatud sõnum on liiga lühike.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Kontaktivormi kaudu saadeti järgmised andmed ja info:\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Eesnimi: ".clean_string($first_name)."\n\n";
    $email_message .= "E-mail: ".clean_string($email_from)."\n\n";
    $email_message .= "Telefon: ".clean_string($telephone)."\n\n";
    $email_message .= "Sõnum: ".clean_string($comments)."\n\n";


// create email headers
$headers = 'Kellelt: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- place your own success html below -->

Tänan kirja eest! Vastan kirjadele kahe ööpäeva jooksul.
Palun oodake, toimub tagasisuunamine kodulehele...

Thank you for the letter! I respond to letters within two days.
Please wait until you will be redirected to homepage...
<?php
}

?>
<meta http-equiv="refresh" content="5; url=http://www.marguschanneling.com">
