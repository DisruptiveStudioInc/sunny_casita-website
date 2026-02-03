<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Includes\Localization;

class FormController extends BaseController {

  public function handleJoinSubmission() {
    if (!$this->validateRequestMethod()) {
      return;
    }

    // Get form data
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $usertype = $_POST['usertype'] ?? '';
    $message = $_POST['message'] ?? '';
    $lang = $_POST['lang'] ?? 'es';

    // Initialize language
    $this->initializeLanguage($lang);

    // Validate required fields
    $requiredFields = ['name' => $name, 'phone' => $phone, 'email' => $email, 'usertype' => $usertype, 'address' => $address];
    if (!$this->validateRequiredFields($requiredFields, $lang)) {
      return;
    }

    // Validate email format
    if (!$this->validateEmailFormat($email, $lang)) {
      return;
    }

    // Load constants
    $constants = include __DIR__ . '/../includes/constants.php';

    // Send email
    $emailSent = $this->sendJoinEmail($name, $phone, $email, $address, $usertype, $message, $constants);

    // Send response
    $this->sendFormResponse($emailSent, $lang);
  }

  public function handleStartNowSubmission() {
    if (!$this->validateRequestMethod()) {
      return;
    }

    // Get form data
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $acceptance = $_POST['acceptance'] ?? '';
    $lang = $_POST['lang'] ?? 'es';

    // Initialize language
    $this->initializeLanguage($lang);

    // Validate required fields
    $requiredFields = ['name' => $name, 'phone' => $phone, 'email' => $email, 'address' => $address, 'city' => $city, 'state' => $state, 'acceptance' => $acceptance];
    if (!$this->validateRequiredFields($requiredFields, $lang)) {
      return;
    }

    // Validate email format
    if (!$this->validateEmailFormat($email, $lang)) {
      return;
    }

    // Load constants
    $constants = include __DIR__ . '/../includes/constants.php';

    // Send email
    $emailSent = $this->sendStartNowEmail($name, $phone, $email, $address, $city, $state, $acceptance, $constants);

    // Send response
    $this->sendFormResponse($emailSent, $lang);
  }

  private function sendJoinEmail($name, $phone, $email, $address, $usertype, $message, $constants) {
    $subject = 'New Join Request - Sunny Casitas';
    $fields = [
      'Name' => $name,
      'Phone' => $phone,
      'Email' => $email,
      'Address' => $address,
      'User Type' => $usertype,
    ];

    if (!empty($message)) {
      $fields['Message'] = $message;
    }

    return $this->sendEmail($subject, $fields, $email, $name, $constants);
  }

  private function sendStartNowEmail($name, $phone, $email, $address, $city, $state, $acceptance, $constants) {
    $subject = 'New Start Now Request - Sunny Casitas';
    $fields = [
      'Name' => $name,
      'Phone' => $phone,
      'Email' => $email,
      'Address' => $address,
      'City' => $city,
      'State' => $state,
      'Acceptance' => $acceptance,
    ];

    return $this->sendEmail($subject, $fields, $email, $name, $constants);
  }

  private function validateRequestMethod() {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      return false;
    }

    return true;
  }

  private function initializeLanguage($lang) {
    Localization::setLang($lang);
    Localization::loadLanguage();
  }

  private function validateRequiredFields($fields, $lang) {
    foreach ($fields as $value) {
      if (empty($value)) {
        http_response_code(400);
        echo json_encode([
          'success' => false,
          'message' => $lang === 'en'
            ? 'All required fields must be filled'
            : 'Todos los campos requeridos deben ser completados'
        ]);
        return false;
      }
    }
    return true;
  }

  private function validateEmailFormat($email, $lang) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      http_response_code(400);
      echo json_encode([
        'success' => false,
        'message' => $lang === 'en'
          ? 'Invalid email format'
          : 'Formato de correo electrónico inválido'
      ]);
      return false;
    }
    return true;
  }

  private function sendFormResponse($emailSent, $lang) {
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

  private function sendEmail($subject, $fields, $replyEmail, $replyName, $constants) {
    $mailer = new PHPMailer(true);

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
      $mailer->SMTPDebug = 0;
      $mailer->Debugoutput = function($str, $level) {
        error_log("SMTP Debug level $level: $str");
      };

      // Sender and recipient
      $mailer->setFrom(
        $constants['from_email'],
        $constants['company_name']
      );
      $mailer->addAddress($constants['email']);
      $mailer->addReplyTo($replyEmail, $replyName);

      // Email content
      $mailer->isHTML(true);
      $mailer->Subject = $subject;

      $htmlBody = $this->buildEmailTemplate($subject, $fields);
      $mailer->Body = $htmlBody;
      $mailer->AltBody = $this->buildPlainTextEmail($subject, $fields);

      $mailer->send();
      return true;

    } catch (Exception $e) {
      error_log("Email Error: " . $mailer->ErrorInfo);
      return false;
    }
  }

  private function buildEmailTemplate($subject, $fields) {
    $fieldsHtml = '';

    foreach ($fields as $label => $value) {
      // Check if this is a long text field (like Message)
      $isLongText = (strlen($value) > 100 || strpos($value, "\n") !== false);

      if ($isLongText) {
        $fieldsHtml .= "
            <div class='field'>
              <span class='label'>" . htmlspecialchars($label) . ":</span>
              <div style='margin-top: 10px; padding: 10px; background-color: #f8f9fa; border-radius: 5px;'>
                " . nl2br(htmlspecialchars($value)) . "
              </div>
            </div>";
      } else {
        $fieldsHtml .= "
            <div class='field'>
              <span class='label'>" . htmlspecialchars($label) . ":</span>
              <span class='value'>" . htmlspecialchars($value) . "</span>
            </div>";
      }
    }

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
            <h2 style='margin: 0; color: #495057;'>" . htmlspecialchars($subject) . "</h2>
          </div>
          <div class='content'>
            " . $fieldsHtml . "
          </div>
        </div>
      </body>
      </html>
    ";
  }

  private function buildPlainTextEmail($subject, $fields) {
    $text = $subject . "\n\n";

    foreach ($fields as $label => $value) {
      $text .= "$label: $value\n";
    }

    return $text;
  }
}
