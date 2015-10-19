<div id='sidebar' class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li id='groupholder' class="active">
                <a href="#"><i class="fa fa-th fa-fw"></i> Test Groups<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php
                        $groups=findTestGroups();
                        foreach ($groups as $title => $rel) {
                            echo "<li class='group'>
                                        <a href='#{$rel}'><i class='fa fa-folder fa-fw'></i> {$title} <i class='fa fa-chevron-right pull-right'></i></a>
                                    </li>";
                        }
                    ?>
                </ul>
            </li>
            <li id='activeCaseGroup'>
            </li>
        </ul>
    </div>
</div>