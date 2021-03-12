<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DishCC - <?=$page;?></title>

	<?php
		// Link all css files
		$styles = glob('view/content/style/*.css');
		foreach($styles as $style){echo "<link rel='stylesheet' type='text/css' href='". $style ."'>";}
	?>
</head>
<body>
  <?php
  echo "
    <div id='modify_password'>
      <a id='close' href='#'
        onclick='document.getElementById(\"modify_password\").style.display = \"none\";'
      ></a>
      <h3>Modify password</h3>
      <form method='post' action='index.php?action=modify_password'>
        <input type='password' class='password textfield' name='cPassword' placeholder='Current password' minlength='8' required>
        <p class='message'></p>

        <input type='password' class='password textfield' name='password' placeholder='New password' minlength='8' required>
        <p class='message'></p>

        <input type='password' class='password textfield' name='confirm' placeholder='Confirm' minlength='8' required>
        <p class='message'></p>

        <input type='submit' class='submit' name='submit' value='Modify'>
      </form>
    </div>
    <style>#modify_password{display: none;}</style>
    ";
  ?>
	<div class="rightbar">
    <?php
      if(isset($_SESSION['email'])){
        echo "
          <style>.rightbar{width: 30em;}</style>
          <div class='container'>
            <a "; if($_GET['action'] == 'search_a_dish'){echo "style='color:#1FAB89;'";} echo " class='menuElement' href='index?action=search_a_dish'>Search a dish</a>
            <a "; if($_GET['action'] == 'calories_calculator'){echo "style='color:#1FAB89;'";} echo " class='menuElement' href='index?action=calories_calculator'>Calories calculator</a>
            <a "; if($_GET['action'] == 'my_history'){echo "style='color:#1FAB89;'";} echo " class='menuElement' href='index?action=my_history'>My history</a>
            <a "; if($_GET['action'] == 'suggest_a_dish'){echo "style='color:#1FAB89;'";} echo " class='menuElement' href='index?action=suggest_a_dish'>Suggest a dish</a>
            <a class='menuElement sign_out' href='index?action=sign_out'>Sign out</a>
          </div>
          <script src='view/script/modify_password.js'></script>
          <a class='modify_password' href='#'
            onclick='document.getElementById(\"modify_password\").style.display = \"block\";'
          >Modify password</a>";
      }else{
        echo '<style>.rightbar{width: 45em;}</style>';
        if(isset($_COOKIE['haveAccount'])){
            echo "
              <form class='container' method='post' action='index.php?action=sign_in'>
                <h1>Sign in</h1>
                <p class='message'>";
                if(isset($message['general'])) echo $message['general'];
                echo "</p>
                <input type='email' class='text' name='email' placeholder='Email' required>
                <p class='message'></p>

                <input type='password' class='password textfield' name='password' placeholder='Password' minlength='8' required>
                <p class='message'></p>

                <input type='submit' class='submit' name='submit' value='Sign in'>

                <a href='index.php?action=sign_up'>Don't have an account?<br>Sign up!</a>
              </form>
            ";
        }else{
            echo "
              <form class='container' method='post' action='index.php?action=sign_up'>
                <h1>Sign up</h1>

                <input type='email' class='text' name='email' placeholder='Email' required>
                <p class='message'>";
                if(isset($message['email'])) echo $message['email'];
                echo "</p>
                <input type='password' class='password' name='password' placeholder='Password' minlength='8' required>
                <p class='message'>";
                if(isset($message['password'])) echo $message['password'];
                echo "</p>

                <input type='password' class='password' name='confirm' placeholder='Confirm' minlength='8' required>

                <input type='submit' class='submit' name='submit' value='Sign up'>

                <a href='index.php?action=sign_in'>Already have an account?<br>Sign in!</a>
              </form>
            ";
        }
      }
    ?>
	</div>
  <div class="content">
  <?=$content;?>
  </div>
</body>
</html>
