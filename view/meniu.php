<header>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
          <li <?php echo $this->active == 'index' ? 'class="active"' : ''; ?>><a href="index.php">Home</a></li>
          <li><a href="#">Page 1</a></li>
          <?php
          
           echo "<li ",   $this->active == 'profil' ? 'class="active"' : '', '><a href="profil.php?id=',  $_SESSION['UserData']->user_id,'">Profil</a></li>';?>
          <li <?php echo $this->active == 'contor' ? 'class="active"' : ''; ?>><a href="contor2.php">Contor</a></li>
          <?php
            if($_SESSION['UserData']->acces_index == 1)
             echo '<li ', $this->active == 'administrator' ? 'class="active"' : '', '><a href="administrator.php">Administrator</a></li>';
          ?>
          <li class="navbar-right"></li>
        </ul>
        <?php  
              $this->logOut();
        ?>    
      </div>
    </div>
  </nav>
</header>