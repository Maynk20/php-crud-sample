<?php

/**
 * Email Configuration
 * Uses PHPMailer with Gmail SMTP
 */

// Gmail Configuration
define('GMAIL_EMAIL', 'thakkarrmayank@gmail.com');      // Your Gmail address
define('GMAIL_PASSWORD', '');       // Your Gmail App Password (NOT your regular password)

/**
 * Send Email using Gmail SMTP
 * 
 * @param string $to - Recipient email
 * @param string $subject - Email subject
 * @param string $message - Email body (HTML supported)
 * @return bool - true if sent, false otherwise
 */
function sendEmail($to, $subject, $message)
{
     try {
          // PHPMailer lives next to this file (nested folder from zip extract)
          $phpmailerSrc = __DIR__ . '/PHPMailer-master/PHPMailer-master/src';
          require_once $phpmailerSrc . '/Exception.php';
          require_once $phpmailerSrc . '/PHPMailer.php';
          require_once $phpmailerSrc . '/SMTP.php';

          $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

          // Server settings
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = GMAIL_EMAIL;
          $mail->Password = GMAIL_PASSWORD;
          $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          // Recipients
          $mail->setFrom(GMAIL_EMAIL, "Mayank's Check");
          $mail->addAddress($to);

          // Content
          $mail->CharSet = 'UTF-8';
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body = $message;
          $mail->AltBody = strip_tags($message); // Plain text fallback

          // Send
          if ($mail->send()) {
               return true;
          } else {
               error_log("Mail send failed: " . $mail->ErrorInfo);
               return false;
          }
     } catch (Exception $e) {
          error_log("Email exception: " . $e->getMessage());
          return false;
     }
}
