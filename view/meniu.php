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
          <li><a href="#">Page 2</a></li>
          <li <?php echo $this->active == 'contor' ? 'class="active"' : ''; ?>><a href="contor.php">Contor</a></li>
          <li class=\"navbar-right\"></li>
        </ul>
        <?php  
              $this->logOut();
        ?>    
      </div>
    </div>
  </nav>
</header>