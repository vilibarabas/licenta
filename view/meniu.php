<header>
  <div id="header_img">
    
  </div>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div>
        <ul class="nav navbar-nav" style="width:700px">
          <li <?php echo $this->active == 'index' ? 'class="active"' : ''; ?>><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <?php
          
           echo "<li ",   $this->active == 'profil' ? 'class="active"' : '', '><a href="profil.php?id=',  $_SESSION['UserData']->user_id,'&work"><span class="glyphicon glyphicon-tasks"></span> Profil</a></li>';?>
          <?php
            if($_SESSION['UserData']->acces_index == 1)
             echo '<li ', $this->active == 'administrator' ? 'class="active"' : '', '><a href="administrator.php"><span class="glyphicon glyphicon-object-align-top"></span> Administrator</a></li>';
          ?>
          <?php
            if($_SESSION['UserData']->acces_index == 2)
            {
              echo '<li ', $this->active == 'statistics' ? 'class="active"' : '', '><a href="statistics.php"><span class="glyphicon glyphicon-equalizer"></span> Team statistics</a></li>';
              echo '<li ', $this->active == 'time_management' ? 'class="active"' : '', '><a href="time_management.php"><span class="glyphicon glyphicon-time"></span>Time Management</a></li>';
            }
          ?>
          <li <?php echo $this->active == 'contor' ? 'class="active"' : ''; ?>><a href="contor2.php"><span class="glyphicon glyphicon-time"></span> Contor</a></li>
          <li <?php echo $this->active == 'raport' ? 'class="active"' : ''; ?>><a href="raport.php"><span class="glyphicon glyphicon-send"></span> Raport</a></li>
          
          <li class="navbar-right"></li>
        </ul>    
      </div>
    </div>
  </nav>
</header>