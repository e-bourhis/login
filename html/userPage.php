<?php

require_once(__DIR__ . '/../core/init.php');

$controller->userPage();

$title = "User Page";

include(__DIR__ . '/../includes/head.php');

?>

<header>
  <h1>User Page</h1>
</header>
<section>
  <a href="/?logout=true"><button type="button" name="logout">LOGOUT</button></a>
</session>

<?php

include(__DIR__ . '/../includes/footer.php');
