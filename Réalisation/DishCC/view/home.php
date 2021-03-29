home
<?php
  if(isset($_SESSION['pwdChanged'])){
    if($_SESSION['pwdChanged']){
      echo "<p style='color: red;'><br />Your password has been changed.</p>";
      unset($_SESSION['pwdChanged']);
    }
  }
?>
