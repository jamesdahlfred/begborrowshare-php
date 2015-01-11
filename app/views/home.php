<!doctype html>
<html lang="en" id="ng-app" ng-app="begborrowshare" xmlns:ng="http://angularjs.org">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/assets/ico/favicon.ico">
  <title>Beg, Borrow, or Share</title>
  <link rel="stylesheet" href="/assets/css/app.css" type="text/css" media="screen" title="CSS for Screens" charset="utf-8">
  <script src="/assets/js/lib.js" type="text/javascript" charset="utf-8"></script>
  <script src="/assets/js/app.js" type="text/javascript" charset="utf-8"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
    angular.module("begborrowshare").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
  </script>
</head>
<body>
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Beg, Borrow, Share</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <form class="navbar-form navbar-right" role="search" name="navbarSearch" ng-controller="searchController" novalidate ng-submit="search()">
        <div class="input-group">
          <label for="query" class="sr-only">Search for</label>
          <input type="text" class="form-control" id="query" name="query" placeholder="Search" ng-model="query">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default" ng-disabled="navbarSearch.$invalid" ng-click="search()">Search</button>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right" ng-switch="authenticated">
        <li class="active"><a href="#/">
          <span class="glyphicon glyphicon-home"></span>
          <span translate="global.menu.home">Home</span>
        </a></li>
        <?php if (true) { ?>
        <li><a href="#/dashboard">
          <span class="glyphicon glyphicon-stats"></span>
          <span translate="global.menu.dashboard">Dashboard</span>
        </a></li>
        <li ng-switch-when="true"><a href="#/account">
          <span class="glyphicon glyphicon-user"></span>
          <span translate="global.menu.dashboard">Account</span>
        </a></li>
        <li><a href="#/settings">
          <span class="glyphicon glyphicon-cog"></span>
          <span translate="global.menu.settings">Settings</span>
        </a></li>
        <?php } else { ?>
        <li><a href="#/login">Login</a></li>
        <?php } ?>
<!--         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          </ul>
        </li> -->
      </ul>
<!--       <form class="navbar-form navbar-left" role="form" name="loginForm" ng-controller="loginController" novalidate ng-submit="login()">
        <div class="form-group">
          <div class="input-group">
            <label class="sr-only" for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" ng-model="credentials.email" required>
          </div>
        </div>
        <div class="form-group">
          <label class="sr-only" for="exampleInputPassword2">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" ng-model="credentials.password" required>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-default" ng-disabled="loginForm.$invalid" ng-click="login()">Sign in</button>
      </form>
 -->
    </div>

    <div ng-view class="reveal-animation"></div>

  </div>
  <script src="//use.typekit.net/gkh0vdb.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>
</body>
</html>
