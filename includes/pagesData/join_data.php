<?php

$PartOf_list = array(
  $PartOf_meaningList1, $PartOf_meaningList2, $PartOf_meaningList3, $PartOf_meaningList4
);

$Form_userType_options = array(
  [
    'id' => 'usertype1',
    'value' => $Form_typeUser_option1,
  ],
  [
    'id' => 'usertype2',
    'value' => $Form_typeUser_option2,
  ],
  [
    'id' => 'usertype3',
    'value' => $Form_typeUser_option3,
  ]
);

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
