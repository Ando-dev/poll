<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">Poll</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php if(isset($cnt->user['user_id'])){?>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $cnt->user['name']?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/user/">Անձնական տվյալներ</a></li>
            <li><a href="/user/poll">Իմ հարցումները</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="?cmd=logOut">Ելք <i class="fa fa-sign-out"></i></a></li>
          </ul>
        </li>
      </ul>
      <?php }else{?>
      <ul class="nav navbar-nav navbar-right sign">
        <li><a href="/">Մուտք</a></li>
        <li><a href="/signUp">Գրանցում</a></li>
      </ul>
      <?php }?>
    </div>
  </div>
</nav>