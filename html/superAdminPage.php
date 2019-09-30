<?php

require_once(__DIR__ . '/../core/init.php');

$controller->superAdminPage();

$title = "Super Admin Page";

include(__DIR__ . '/../includes/head.php');

?>

<header>
  <h1>Super Admin Page</h1>
</header>
<section>
  <a href="/?logout=true"><button type="button" name="logout">LOGOUT</button></a>
</session>

<?php

include(__DIR__ . '/../includes/footer.php');
