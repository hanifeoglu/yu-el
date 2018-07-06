<?php
class Utils{
  function getToken($length=32){
      $token = "";
      $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
      $codeAlphabet.= "0123456789";
      for($i=0;$i<$length;$i++){
          $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
      }
      return $token;
  }

  function crypto_rand_secure($min, $max) {
      $range = $max - $min;
      if ($range < 0) return $min; // not so random...
      $log = log($range, 2);
      $bytes = (int) ($log / 8) + 1; // length in bytes
      $bits = (int) $log + 1; // length in bits
      $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
      do {
          $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
          $rnd = $rnd & $filter; // discard irrelevant bits
      } while ($rnd >= $range);
      return $min + $rnd;
  }

        // send email using built in php mailer
      public function sendEmailViaPhpMail($TO_EMAIL, $subject, $htmlContent){

        $FROM_EMAIL = 'me@erpb2b.com>';
        $API_KEY='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';
        $from = new SendGrid\Email(null, $FROM_EMAIL);
        $to = new SendGrid\Email(null, $TO_EMAIL);
        // Create Sendgrid content
        $content = new SendGrid\Content("text/html",$htmlContent);
        // Create a mail object
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $sg = new \SendGrid($API_KEY);
        $response = $sg->client->mail()->send()->post($mail);

        if ($response->statusCode() == 202) {
         // Successfully sent
          return true;
        } else {
         return false;
        }
      }



}
?>
