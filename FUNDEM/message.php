<?php
    if(isset($_SESSION['message'])) :
?>

    <span class = "error-msg">
        <?= $_SESSION['message']; ?>
    </span>

<?php

    unset($_SESSION['message']);
    endif;

?>