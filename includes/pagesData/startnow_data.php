<?php

$Alerts_Data = array(
  'empty' => $Form_empty,
  'mail' => $Form_mailInvalid,
  'phone' => $Form_phoneLength,
  'onlyNums' => $Form_onlyNums,
  'onlyLetters' => $Form_onlyLetters,
  'processing' => $Form_processing,
  'sendFailed' => $Form_error,
  'sendSuccess' => $Form_success,
  'submitText' => $Form_btn
);

$Alerts_Json = json_encode($Alerts_Data);
$Alerts = htmlspecialchars($Alerts_Json);
