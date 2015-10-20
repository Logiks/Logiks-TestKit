<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?=$_ENV['urlPath']?>">
    	<small>
            <img src="assets/images/logiks.png" alt="Test Kit Logo" style='width: 36px;margin-top: -9px;' />
        </small>
        <?=$testHead?>
    </a>
</div>
<ul class="nav navbar-top-links navbar-left tools-menu">
    <li>
        <a class="dropdown-toggle" data-toggle="dropdown" title="Reload List" href="#" onclick="reloadWindow()">
            <i class="icon fa fa-refresh fa-2x"></i>
        </a>
    </li>
    <li>
        <a class="dropdown-toggle" data-toggle="dropdown" title="Clear Test History" href="#" onclick="clearWindow()">
            <i class="icon fa fa-ban fa-2x"></i>
        </a>
    </li>
    <!-- 
    <li>
        <a class="dropdown-toggle" data-toggle="dropdown" title="Dashboard" href="#dashboard">
            <i class="icon fa fa-dashboard fa-2x"></i>
        </a>
    </li>
    <li>
    	<a class="dropdown-toggle" data-toggle="dropdown" title="Run Selected Tests" href="#">
        	<i class="icon fa fa-play fa-2x"></i>
    	</a>
    </li>
    <li>
    	<a class="dropdown-toggle" data-toggle="dropdown" title="Pause Activity" href="#">
        	<i class="icon fa fa-pause fa-2x"></i>
    	</a>
    </li> -->
</ul>
<ul class="nav navbar-top-links navbar-right drop-menu">
    <li>
        <a id='rightSidebar-toggle' class="dropdown-toggle" href="#">
            <i class="fa fa-tasks"></i>
        </a>
    </li>
	<!--<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-cogs fa-spin"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
             <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                        <span class="pull-right text-muted small">12 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-tasks fa-fw"></i> New Task
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </li> -->
</ul>