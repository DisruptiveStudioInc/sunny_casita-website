<?php
	session_start();
	if(isset($_SESSION['user_replica']) && !isset($_GET['ref'])){
		$user_replica = $_SESSION['user_replica'];
	}
	else{
		$user_replica = isset($_GET['ref']) ? $_GET['ref'] : NULL;
		$_SESSION['user_replica'] = $user_replica;
	}

  $Maintenance = false;
  $ConnectBO = true;
  $pages_dir = 'pages';

  if($Maintenance){
    if(isset($_GET['dev'])){
      include("./includes/header.php");
        if(!empty($_GET['p'])){

          $pages = scandir ($pages_dir, 0);
          unset ($pages[0], $pages[1]);
          $p = $_GET['p'];

          if (in_array($p.'.inc.php', $pages)){
            include ($pages_dir.'/'.$p.'.inc.php');
          }else{
            echo '<section><div class="jc-center ai-center h-100"><p>Sorry, the page does not exist.</p></div></section>';
          }
        } else {
          include($pages_dir.'/home.inc.php');
        }
      include("./includes/footer.php");
    } else {
      include_once('./includes/soon.php');
    }
  } else {
    include("./includes/header.php");
      if(!empty($_GET['p'])){

        $pages = scandir ($pages_dir, 0);
        unset ($pages[0], $pages[1]);
        $p = $_GET['p'];

        if (in_array($p.'.inc.php', $pages)){
          include ($pages_dir.'/'.$p.'.inc.php');
        }else{
          echo '<section><div class="jc-center ai-center h-100"><p>Sorry, the page does not exist.</p></div></section>';
        }
      } else {
        include($pages_dir.'/home.inc.php');
      }
    include("./includes/footer.php");
  }
?>
