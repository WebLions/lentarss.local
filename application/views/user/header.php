
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Admin panel</title>

  <?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
  <?php echo link_tag('bootstrap/css/bootstrap-theme.css'); ?>
  <?php echo link_tag('bootstrap/css/elegant-icons-style.css'); ?>
  <?php echo link_tag('bootstrap/css/font-awesome.min.css'); ?>
  <?php echo link_tag('bootstrap/css/owl.carousel.css'); ?>
  <?php echo link_tag('bootstrap/css/fullcalendar.css'); ?>
  <?php echo link_tag('bootstrap/css/widgets.css'); ?>
  <?php echo link_tag('bootstrap/css/style-responsive.css'); ?>
  <?php echo link_tag('bootstrap/css/xcharts.min.css'); ?>
  <?php echo link_tag('bootstrap/css/jquery-ui-1.10.4.min.css'); ?>
  <?php echo link_tag('bootstrap/css/jquery-jvectormap-1.2.2.css'); ?>
  <?php echo link_tag('bootstrap/css/style.css'); ?>

</head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>



      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
          <li id="task_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="icon-task-l"></span>
              <span class="badge bg-important">0</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">


            </ul>
          </li>
          <!-- task notificatoin end -->
          <!-- inbox notificatoin start-->
          <li id="mail_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <i class="icon-envelope-l"></i>
              <span class="badge bg-important">0</span>
            </a>
            <ul class="dropdown-menu extended inbox">

            </ul>
          </li>
          <!-- inbox notificatoin end -->
          <!-- alert notification start-->
          <li id="alert_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

              <i class="icon-bell-l"></i>
              <span class="badge bg-important">7</span>
            </a>
            <ul class="dropdown-menu extended notification">

            </ul>
          </li>
          <!-- alert notification end-->
          <!-- user login dropdown start-->

          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="profile">
              <i class="icon_house_alt"></i>
              <span>Административная панель</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="/rss" class="">
              <i class="icon_document_alt"></i>
              <span>Ленты</span>
            </a>

          </li>
          <li class="sub-menu">
            <a href="/errors" class="">
              <i class="icon_desktop"></i>
              <span>Отчёт об ошибках RSS </span>
            </a>

          </li>
          <li>
            <a class="" href="/special_rss">
              <i class="icon_genius"></i>
              <span>Специальные новости</span>
            </a>
          </li>
          <li>
            <a class="" href="chart-chartjs.html">
              <i class="icon_piechart"></i>
              <span>В разработке</span>

            </a>

          </li>

          <li class="sub-menu">
            <a href="/logout" class="">
              <i class="icon_table"></i>
              <span>Выход</span>
            </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->