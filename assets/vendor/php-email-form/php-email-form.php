<?php

class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $smtp = array();
  public $messages = array();
  public $ajax = false;

  public function add_message($message, $label = '') {
    $this->messages[] = array('label' => $label, 'message' => $message);
  }

  public function send() {
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: '.$this->from_name.' <'.$this->from_email.'>' . "\r\n";

    $email_body = '<html><body>';
    foreach ($this->messages as $msg) {
      $email_body .= "<p><strong>{$msg['label']}:</strong> {$msg['message']}</p>";
    }
    $email_body .= '</body></html>';

    if( !empty($this->smtp) ) {
      // SMTP settings can be added here using PHPMailer or a similar library
      return 'SMTP functionality is not implemented in this basic form.';
    } else {
      // Default mail() function
      if (mail($this->to, $this->subject, $email_body, $headers)) {
        return 'OK';
        // return 'Message sent successfully!';
      } else {
        return 'Error sending email!';
      }
    }
  }
}

?>