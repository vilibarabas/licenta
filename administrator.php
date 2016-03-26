<!DOCTYPE html>
<head>

<title>Licenta</title>
           
  <?php
    include "controller/controller.php";
    $controller = new Controller('administrator');
  ?>
</head>
<body>
  <?php
      $controller->getMeniu();
      $selector = $controller->model->getDistinctSelector();
      $department = $controller->getPostValue('select_department');
      
      $functie = $controller->getPostValue('select_functie');
      $acces_index = $controller->getPostValue('select_acces_index');

  ?>
  <div class="container">
    <div class="row"> 
      <div class="col-md-2">
        <div class="row"> 
          <ul class="nav">
            <li class="active"><a href="#tab_a" data-toggle="tab">Users Administrate</a></li>
            <li><a href="#tab_b" data-toggle="tab">Electric Admin</a></li>
            <li><a href="#tab_c" data-toggle="tab">Other Admin</a></li>
          </ul>
        </div>
      </div>
    
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_a">
            <div class="table-responsive">
              <form method="POST" action="administrator.php">
                <div class="row">
                  <div class="col-md-1">
                    <span>SortBy</span>
                  </div>
                  <div class="col-md-3">
                    <span>Department</span>
                  
                    <select name="select_department">
                      <option >All</option>
                      <?php
                        foreach($selector['department'] as $key => $dep)
                        {
                          echo '<option value="', $key,'" ', $key == $department ? 'selected' : '','>', $key,'</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <span>Functie</span>
                  
                    <select name="select_functie">
                        <option >All</option>
                        <?php
                          foreach($selector['functie'] as $key => $dep)
                          {
                            echo '<option value="', $key,'" ', $key == $functie ? 'selected' : '','>', $key,'</option>';
                          }
                        ?>
                      </select>
                  </div>
                  <div class="col-md-2">
                    <span>Acces</span>
                  
                    <select name="select_acces_index">
                        <option >All</option>
                        <?php
                          foreach($selector['acces_index'] as $key => $dep)
                          {
                            echo '<option value="', $key,'" ', $key == $acces_index ? 'selected' : '','>', $key,'</option>';
                          }
                        ?>
                      </select>

                  </div>
                  <div class="col-md-1">
                    <input type="submit" value="Sort" id="sort_users" class="btn btn-default"/>
                  </div>
                </div>
              </form>
              <hr>
              <div id="load_container">
                
              </div>
              <table class="table table-striped">
                
                  <tr>
                    <td>User Id</td>
                    <td>Name</td>
                    <td>User Name</td>
                    <td>Department</td>
                    <td>Acces Index</td>
                    <td>Function</td>
                    <td>Edit</td>
                  </tr>
                
                  <?php

                      $users = $controller->model->getAllUsers($department, $functie, $acces_index);
                      include('view/admin/print_all_users.php');
                  ?>
                
              </table>
            </div>
          </div>

          <div class="tab-pane" id="tab_b">
            <div class="table-responsive">
            </div>
          </div>

          <div class="tab-pane" id="tab_c">
            <div class="table-responsive">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
