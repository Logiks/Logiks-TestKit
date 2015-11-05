<?php
if(!isset($_REQUEST['src'])) {
	exit("<h1 align=center>SRC not defined</h1>");
}

$groups=findTestGroups();

if(array_key_exists($_REQUEST['src'], $groups)) {
  $tests=findTests($groups[$_REQUEST['src']]['path']);

  if(is_array($tests) && count($tests)>0) {
    foreach ($tests as $group => $files) {
      if($group=="generic") {
        foreach ($files as $nx=>$script) {
          $hash=md5($script['path']);
          echo "<li>
                    <a class='testScript' hash='{$hash}' href='#{$script['path']}' category='{$script['category']}'><i class='fa fa-bolt fa-fw'></i> ".($script['name'])."</a>
                  </li>";
        }
      } else {
        echo "<li>
                  <a href='#'><i class='fa fa-folder fa-fw'></i> ".ucwords($group)."<span class='fa arrow'></span></a>
                  <ul class='nav nav-third-level'>";
          foreach ($files as $nx=>$script) {
            $hash=md5($script['path']);
            echo "<li>
                      <a class='testScript' hash='{$hash}' href='#{$script['path']}' category='{$script['category']}'><i class='fa fa-bolt fa-fw'></i> ".($script['name'])."</a>
                    </li>";
          }
          echo "  </ul>
                </li>";
      }
    }
  } else {
    echo "<h4 align=center>No Test Scripts Found</h4>";
  }
} else {
  echo "<h4 align=center>No Test Group Found</h4>";
}
?>
