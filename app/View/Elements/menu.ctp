<?php

// check if user logged in
// get user type
$userType = $this->Session->read('Auth.User.PermissionGroup.name');

?>

<!-- NAVIGATION -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

    <!-- NAVIGATION HEADER -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Nawigacja</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Człowiek komputer</a>
    </div>

    <!-- NAVBAR TOP MENU -->
    <ul class="nav navbar-top-links navbar-right">
        <?php
        // if user logged in
        if (!empty($userType)) {
            //echo $this->element('messages');
            //echo $this->element('notifications');
            echo $this->element('user_dropdown');
        }
        ?>
    </ul>

    <!-- USER MENU -->
    <?php
    if ($userType === 'Students') {
        echo $this->element('student_menu');
    }
    else if($userType === 'Teachers') {
        echo $this->element('teacher_menu');
    }
    else if($userType  === 'Admins') {
        echo $this->element('admin_menu');
    }
    ?>
</nav>
