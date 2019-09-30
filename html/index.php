<?php

require_once(__DIR__ . '/../core/Init.php');

$controller->index();

$title = "Login Page";

include(__DIR__ . '/../includes/head.php');

?>

<header>
  <h1>A login page</h1>
</header>
<section>
  <form action="/" method="post">
    <div>
      <label for="username"><b>Username</b></label>
      <br/>
      <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
    </div>
    <?php
      if($errorHandler->getErrors('username')){
        echo '<ul>';
        foreach($errorHandler->getErrors('username') as $error){
          echo '<li>' . $error .'</li>';
        }
        echo '</ul><br/>';
      }
     ?>
    <div>
      <label for="password"><b>Password</b></label>
      <br/>
      <input type="password" name="password" required>
      <?php
        if($errorHandler->getErrors('password')){
          echo '<ul>';
          foreach($errorHandler->getErrors('password') as $error){
            echo '<li>' . $error .'</li>';
          }
          echo '</ul>';
        }
       ?>
    </diV>
    <button type="submit">Login</button>
  </form>
</section>

<?php

include(__DIR__ . '/../includes/footer.php');
