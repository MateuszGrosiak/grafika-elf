<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!-- PANEL GŁÓWNY -->
            <li>
                <?php

                // check if tab should be active
                ($this->params['controller'] =='users' && $this->params['action'] == 'teachers') ?
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

            <li>
                <a class="" href="index.html"><i class="fa fa-user-md fa-fw"></i> Grupy</a>
            </li>

            <li>
                <a class="" href="index.html"><i class="fa fa-user-md fa-fw"></i> Studenci</a>
            </li>

            <li>
                <a class="" href="index.html"><i class="fa fa-user-md fa-fw"></i> Zadania</a>
            </li>

        </ul>
    </div>
</div>