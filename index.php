<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/includes/helpers.php';
$constants = require __DIR__ . '/includes/constants.php';
foreach ($constants as $key => $value) {
  $GLOBALS[$key] = $value;
}
$config = require __DIR__ . '/config.php';
$bypassMaintenance = $_GET['dev'] ?? null;

// Initialize user_replica from session or URL parameter
if(isset($_SESSION['user_replica']) && !isset($_GET['ref'])){
  $user_replica = $_SESSION['user_replica'];
}
else{
  $user_replica = isset($_GET['ref']) ? $_GET['ref'] : NULL;
  $_SESSION['user_replica'] = $user_replica;
}

// Make $user_replica available globally throughout the application
$GLOBALS['user_replica'] = $user_replica;

// Maintenance Mode
if (isset($config['maintenance_mode']) && $config['maintenance_mode'] === true && !isset($bypassMaintenance)) {
  include __DIR__ . '/includes/soon.php';
  exit;
}

// Router Dispatch
require __DIR__ . '/includes/routes.php';
