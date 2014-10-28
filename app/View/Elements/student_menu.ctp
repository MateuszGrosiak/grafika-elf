<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!-- PANEL GŁÓWNY -->
            <li>
                <?php

                // check if tab should be active
                ($this->params['controller'] =='users' && $this->params['action'] == 'students') ?
                    $active = 'active' : $active = '';

                echo $this->Html->link(
                    '<i class="fa fa-dashboard fa-fw"></i> Panel główny',
                    array(
                        'controller' => 'users',
                        'action'     => 'students'
                    ),
                    array(
                        'escape'     => false,
                        'class' => $active
                    )
                );
                unset($active);

                ?>
            </li>

            <!--<li>
                <a class="" href="index.html"><i class="fa fa-user-md fa-fw"></i> Prowadzący</a>
            </li>-->

            <!--<li>
                <a href=""><i class="fa fa-tasks fa-fw"></i> Zadania</a>
            </li>-->

            <!--<li>
                <a href=""><i class="fa fa-tasks fa-fw"></i> Projekty</a>
            </li>-->

            <!--<li>
                <a href=""><i class="fa fa-calendar fa-fw"></i> Terminarz</a>
            </li>-->

            <!--<li>
                <a href="#"><i class="fa fa-info-circle fa-fw"></i> Zasady i regulamin<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="blank.html">Zasady zaliczenia</a>
                    </li>
                    <li>
                        <a href="login.html">Jak oddawać prace</a>
                    </li>
                    <li>
                        <a href="login.html">Jak korzystać z systemu</a>
                    </li>
                </ul>
            </li>-->

        </ul>
    </div>
</div>