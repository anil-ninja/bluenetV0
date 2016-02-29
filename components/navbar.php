<div id="header-topbar-option-demo" class="page-header-topbar">
  <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
    <div class="navbar-header">
      <button type="button" id="toggleSideNav" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a id="logo" href="index.php" class="navbar-brand">
        <span class="fa fa-rocket"></span>
        <span class="logo-text">BlueNet</span>
        <span style="display: none" class="logo-text-icon">µ</span>
      </a>
    </div>
    <div class="topbar-main">
      <a id="menu-toggle"  href="#" class="hidden-xs r1"><i class="fa fa-bars"></i></a>
      <form id="topbar-search" onsubmit="return(validateSearch());" class="hidden-sm hidden-xs">
        <div class="input-icon right text-white">
          <a onclick="return(validateSearch());"><i class="fa fa-search"></i></a>
          <input type="text" id="searchworker" placeholder="Search by number..." class="form-control text-white"/>
        </div>
      </form>
      <div class="news-update-box hidden-xs">
        <span class="text-uppercase mrm pull-left text-white">News:</span>
        <ul id="news-update" class="ticker list-unstyled">
          <li> Education is the key to unlock the golden door of freedom.</li>
          <li>Education is the most powerful weapon which you can use to change the world.</li>
          <li>The roots of education are bitter, but the fruit is sweet.</li>
          <li>Education is not preparation for life; education is life itself.</li>
          <li>The whole purpose of education is to turn mirrors into windows.</li>
        </ul>
      </div>
      <ul class="nav navbar navbar-top-links navbar-right mbn">
        <!-- <li class="dropdown">
          <a data-hover="dropdown" href="#" class="dropdown-toggle">
            <i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span>
          </a>  
        </li>
        <li class="dropdown">
          <a data-hover="dropdown" href="#" class="dropdown-toggle">
            <i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span>
          </a>  
        </li>
        <li class="dropdown">
          <a data-hover="dropdown" href="#" class="dropdown-toggle">
            <i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span>
          </a>  
        </li> -->
        <li class="dropdown topbar-user">
          <a data-hover="dropdown" href="#" class="dropdown-toggle">&nbsp;
            <span class="hidden-xs"><?= strtoupper($_SESSION['first_name']) ?></span>&nbsp;<span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-user pull-right">
            <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
          </ul>
        </li>
        <!-- <li id="topbar-chat" class="hidden-xs">
          <a href="javascript:void(0)" data-step="4" data-intro="&lt;b&gt;Form chat&lt;/b&gt; keep you connecting with other coworker" data-position="left" class="btn-chat">
            <i class="fa fa-comments"></i><span class="badge badge-info">3</span>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>
</div>