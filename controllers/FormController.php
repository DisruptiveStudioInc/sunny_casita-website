<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Includes\Localization;

class FormController extends BaseController {

  public function handleJoinSubmission() {
    header('Content-Type: application/json');

    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      return;
    }

    // Get form data
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $usertype = $_POST['usertype'] ?? '';
    $message = $_POST['message'] ?? '';
    $lang = $_POST['lang'] ?? 'es';

    // Load language file for messages
    Localization::setLang($lang);
    Localization::loadLanguage();

    // Validate required fields
    if (empty($name) || empty($phone) || empty($email) || empty($usertype)) {
      http_response_code(400);
      echo json_encode([
        'success' => false,
        'message' => $lang === 'en'
          ? 'All required fields must be filled'
          : 'Todos los campos requeridos deben ser completados'
      ]);
      return;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo json_encode([
        'success' => false,
        'message' => $lang === 'en'
          ? 'Invalid email format'
          : 'Formato de correo electrónico inválido'
      ]);
      return;
    }

    // Load constants
    $constants = include __DIR__ . '/../includes/constants.php';

    error_log("Submission data:");
    error_log(print_r($_POST, true));
    // Send email
    $emailSent = $this->sendEmail($name, $phone, $email, $usertype, $message, $constants);

    if ($emailSent) {
      echo json_encode([
        'success' => true,
        'message' => $GLOBALS['Form_success'] ?? ($lang === 'en'
          ? 'Your request has been sent successfully. We will contact you soon.'
          : 'Tu solicitud ha sido enviada exitosamente. Te contactaremos pronto.')
      ]);
    } else {
      http_response_code(500);
      echo json_encode([
        'success' => false,
        'message' => $GLOBALS['Form_error'] ?? ($lang === 'en'
          ? 'There was an error sending your request. Please try again later.'
          : 'Hubo un error al enviar tu solicitud. Por favor intenta de nuevo más tarde.')
      ]);
    }
  }

  private function sendEmail($name, $phone, $email, $usertype, $message, $constants) {
    $mailer = new PHPMailer(true);

    error_log('Sendgrid key: ' . $_ENV['SENDGRID_KEY']);
    try {
      // SendGrid SMTP configuration
      $mailer->isSMTP();
      $mailer->Host = 'smtp.sendgrid.net';
      $mailer->SMTPAuth = true;
      $mailer->Username = 'apikey';
      $mailer->Password = $_ENV['SENDGRID_KEY'];
      $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mailer->Port = 587;
      $mailer->CharSet = 'UTF-8';

      // Enable verbose debug output
      $mailer->SMTPDebug = 2;
      $mailer->Debugoutput = function($str, $level) {
        error_log("SMTP Debug level $level: $str");
      };

      // Sender and recipient
      $mailer->setFrom(
        $constants['from_email'],
        $constants['company_name']
      );
      $mailer->addAddress($constants['email']);
      $mailer->addReplyTo($email, $name);

      // Email content
      $mailer->isHTML(true);
      $mailer->Subject = 'New Join Request - Sunny Casitas';

      $htmlBody = $this->buildEmailTemplate($name, $phone, $email, $usertype, $message);
      $mailer->Body = $htmlBody;
      $mailer->AltBody = $this->buildPlainTextEmail($name, $phone, $email, $usertype, $message);

      $mailer->send();
      return true;

    } catch (Exception $e) {
      error_log("Email Error: " . $mailer->ErrorInfo);
      return false;
    }
  }

  private function buildEmailTemplate($name, $phone, $email, $usertype, $message) {
    return "
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset='UTF-8'>
        <style>
          body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
          .container { max-width: 600px; margin: 0 auto; padding: 20px; }
          .header { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
          .content { background-color: #ffffff; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px; }
          .field { margin-bottom: 15px; }
          .label { font-weight: bold; color: #495057; }
          .value { color: #212529; margin-left: 10px; }
        </style>
      </head>
      <body>
        <div class='container'>
          <div class='header'>
            <h2 style='margin: 0; color: #495057;'>New Join Request</h2>
          </div>
          <div class='content'>
            <div class='field'>
              <span class='label'>Name:</span>
              <span class='value'>" . htmlspecialchars($name) . "</span>
            </div>
            <div class='field'>
              <span class='label'>Phone:</span>
              <span class='value'>" . htmlspecialchars($phone) . "</span>
            </div>
            <div class='field'>
              <span class='label'>Email:</span>
              <span class='value'>" . htmlspecialchars($email) . "</span>
            </div>
            <div class='field'>
              <span class='label'>User Type:</span>
              <span class='value'>" . htmlspecialchars($usertype) . "</span>
            </div>
            " . (!empty($message) ? "
            <div class='field'>
              <span class='label'>Message:</span>
              <div style='margin-top: 10px; padding: 10px; background-color: #f8f9fa; border-radius: 5px;'>
                " . nl2br(htmlspecialchars($message)) . "
              </div>
            </div>
            " : "") . "
          </div>
        </div>
      </body>
      </html>
    ";
  }

  private function buildPlainTextEmail($name, $phone, $email, $usertype, $message) {
    $text = "New Join Request - Sunny Casitas\n\n";
    $text .= "Name: $name\n";
    $text .= "Phone: $phone\n";
    $text .= "Email: $email\n";
    $text .= "User Type: $usertype\n";

    if (!empty($message)) {
      $text .= "\nMessage:\n$message\n";
    }

    return $text;
  }
}
