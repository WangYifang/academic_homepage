<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>News Detail / 25th News</title>
  <!--Standard meta-->
  <meta http-equiv="cache-control" content="private">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="search" type="application/opensearchdescription+xml" href="content-search.xml"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Anton|Bubbler+One|Indie+Flower|Oswald|Pangolin|Patrick+Hand+SC|Poppins|Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/4.3.2/sweetalert2.min.css">
  <link href="css/quill.snow.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/app-492c00a164.css"></link> -->
  <link href="css/DependencyHandler.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/4.3.2/sweetalert2.min.css">
  <link href="css/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="css/app-492c00a165.css"></link>

  <!-- <link rel="stylesheet" type="text/css" href="css/ShowUserInfo.css"> -->
  <!-- <script type="text/javascript" src="js/app-a928cce577.js"></script> -->
  <script charset="utf-8" src="js/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
  <style type="text/css">
    /*边框加上阴影*/
    .shade
    {
      box-shadow: 0px 0px 10px #000;
      /*box-shadow:2px 2px 5px #000;*/
    }
    .background2
    {
      opacity:0.9;
    }
    .background2:before
    {
      position: absolute;
      content: "";
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: -1;
      background-color: rgba(0,0,0,.25);
    }

    p {
      display: block;
      -webkit-margin-before: 1em;
      -webkit-margin-after: 1em;
      -webkit-margin-start: 0px;
      -webkit-margin-end: 0px;
      font-size: 17px;
    }

    .sidebar {
      border: 2px solid #eceeef;
      margin-bottom: 1rem;
      padding: 1.5rem;
      border-radius: .15rem;
      background: #fff;
    }
    
    .btn, {
      font-family: Karla;
      line-height: 2;
      letter-spacing: 0.5px;
    }
    .btn-group-lg>.btn, .btn-lg, .ql-container {
      font-size: 13px;
    }

    .btn:hover, .btn:focus, .btn.focus {
      color: #a06060;
      text-decoration: none;
    }

    .btn-group-lg>.btn, .btn-lg {
      padding: 0.75rem 1rem;
      border-radius: rem;
    }

    .navbar-header {
    margin: 1!important;
    }

    .clearfix:before, .clearfix:after, .dl-horizontal dd:before, .dl-horizontal dd:after, .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after, .form-horizontal .form-group:before, .form-horizontal .form-group:after, .btn-toolbar:before, .btn-toolbar:after, .btn-group-vertical>.btn-group:before, .btn-group-vertical>.btn-group:after, .nav:before, .nav:after, .navbar:before, .navbar:after, .navbar-header:before, .navbar-header:after, .navbar-collapse:before, .navbar-collapse:after, .pager:before, .pager:after, .panel-body:before, .panel-body:after, .modal-footer:before, .modal-footer:after, section.about-us-introduction:before, section.about-us-introduction:after, section.careers-introduction:before, section.careers-introduction:after, section.grantmaking-circular-image:before, section.grantmaking-circular-image:after, section.grantmaking-gray-background-orange-button-links div:before, section.grantmaking-gray-background-orange-button-links div:after, section.grantmaking-101-fixed-left-text div:before, section.grantmaking-101-fixed-left-text div:after, section.grantmaking-other-fixed-right-text div:before, section.grantmaking-other-fixed-right-text div:after, section.grantmaking-other-fixed-left-text div:before, section.grantmaking-other-fixed-left-text div:after, section.grantmaking-building-fixed-right-text div:before, section.grantmaking-building-fixed-right-text div:after, section.individuals-seeking-fellowships:before, section.individuals-seeking-fellowships:after, section.other-philanthropic-resources-resource-list div:before, section.other-philanthropic-resources-resource-list div:after, section.library-speeches-left-image-right-text:before, section.library-speeches-left-image-right-text:after, .container-fluid-full:before, .container-fluid-full:after, .email-slider form:before, .email-slider form:after {
    content: " ";
    display: table;
}
  </style>
</head>

<body class="transparent-dark home">
<!-- PHP连接MySql数据库 -->
 <?php

//  判断是否已经登陆
 if (!(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")) {
  // echo "您还未登陆，所以只能看这个页面啦~~" . "<br>";
  $user_id = $_SESSION["user_id"];

  //拿到从URL中取到的两个参数：
  // echo $_GET["news_column"] . "<br>";
  // echo $_GET["newsid"] . "<br>";
  $news_column = $_GET["news_column"];
  $newsid = $_GET["newsid"];

  switch ($news_column) {
    case 'news_constellation':
    $news_in_chinese = "星座"; //此变量用于显示频道的中文名
    $news_haibao = "xingzuo.jpg"; //此变量用于显示具体新闻内容的那张海报——不同频道显示不同的海报，相同频道显示相同的海报
    break;

    case 'news_economy':
    $news_in_chinese = "财经";
    $news_haibao = "economy_ICO融资让IPO望尘莫及.jpg";
    break;

    case 'news_education':
    $news_in_chinese = "教育";
    $news_haibao = "education.jpg";
    break;

    case 'news_entertainment':
    $news_in_chinese = "娱乐";
    $news_haibao = "entertainment.jpg";
    break;

    case 'news_headline':
    $news_in_chinese = "头条";
    $news_haibao = "headline.png";
    break;

    case 'news_health':
    $news_in_chinese = "健康";
    $news_haibao = "health.jpg";
    break;

    case 'news_military':
    $news_in_chinese = "军事";
    $news_haibao = "military.jpg";
    break;

    case 'news_NBA':
    $news_in_chinese = "NBA";
    $news_haibao = "NBA.jpeg";
    break;

    case 'news_news':
    $news_in_chinese = "热点";
    $news_haibao = "hotnews.jpg";
    break;

    case 'news_parenting':
    $news_in_chinese = "育儿";
    $news_haibao = "parenting.jpg";
    break;

    case 'news_sports':
    $news_in_chinese = "体育";
    $news_haibao = "sports.png";
    break;

    case 'news_stock':
    $news_in_chinese = "股票";
    $news_haibao = "stock.jpg";
    break;

    case 'news_technology':
    $news_in_chinese = "科技";
    $news_haibao = "tech.jpg";
    break;

    case 'news_woman':
    $news_in_chinese = "女性";
    $news_haibao = "woman_1.jpg";
    break;

    default:
            # code...
    break;
  }

  $servername = "localhost:8889";
  $username = "root";
  $password = "root";
  $dbname = "news";

    // 创建连接
  $conn = new mysqli($servername, $username, $password, $dbname);

    // 检测连接
  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  } 
  // echo "连接成功";


  //读取用户订阅的频道进行消息的个性化推送
  $sql = "SELECT title, time_news, src, category, pic, content FROM {$news_column} WHERE id={$newsid}";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      $news["title"] = $row["title"];
      $news["time_news"] = $row["time_news"];
      $news["src"] = $row["src"];
      $news["category"] = $row["category"];
      $news["pic"] = $row["pic"];
      $news["content"] = $row["content"];
    // echo "- title: " . $news["title"] . "<br>";
    // echo "- time_news: " . $news["time_news"] . "<br>";
    // echo "- src: " . $news["src"] . "<br>";
    // echo "- category: " . $news["category"] . "<br>";
    // echo "- pic: " . $news["pic"] . "<br>";
    // echo "- content: " . $news["content"] . "<br>";
    }
  } else {
      // echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
      // echo (!!$conn->error);//双感叹号!!来将资源句柄转换成布尔值，错误输出1
      echo "出错啦！新闻无法正确显示！";
    }

    // echo "恩……最后展示的时候需要把PHP调试开关（php.ini）给关掉";
    $conn->close();

  } else {
    //  验证失败，将 $_SESSION["admin"] 置为 false
    // echo "<div class='alert alert-warning'><a href='#'' class='close' data-dismiss='alert'>&times;</a>您还尚未登录！请重新登录！test!</div><script>window.location.href='login.php'</script>";
    $news_column = $_GET["news_column"];
    $newsid = $_GET["newsid"];
    echo "<div class='alert alert-warning'><a href='#'' class='close' data-dismiss='alert'>&times;</a>您已经登录，页面即将跳转</div>";
    echo $news_column;
    echo "<script>";
    //已经登陆的话就直接跳转到已登录的新闻正文展示界面。
    echo "window.location.href=" . "'ShowNewsDetail_login.php?news_column=" . $news_column . "&newsid=" .$newsid. "'";
    echo "</script>";
    // echo "为什么跳转不过去呢？？";

    // die();
  }

?>
  <!-- End of PHP连接数据库 -->




 <input type="hidden" value="ipaddress:" />
 <input type="hidden" value="Error:" />
 <header class="primary-nav">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header"  style="margin-top: 10%;">
      <div style="margin-left: 10%;margin-top:0; ">
        <a class="navbar-brand" tabindex="1" aria-label="Home" href="index.php">
          <span class="sr-only">Home</span> <!-- 点击图片可以回到主页 -->
          <img src="img/logo_white.png" />
        </a>
      </div>
        
      </div>
      <!-- <a href="#maincontent" class="sr-only" tabindex="2">Skip to main content</a> -->
      <div class="navigation-items" style="margin-right: 5%;margin-left: 5%;">
        <ul class="list-inline list-unstyled">
          <li class="dropdown-btn"><a title="城市天气"  
              data-container="body" data-toggle="popover" data-placement="bottom" 
              data-content='<iframe width="700" scrolling="no" height="70" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=2&icon=1&py=hangzhou&num=1&site=12"></iframe>'>天气</a></li>
          <li class="dropdown-btn"><a href="login.php">登录/注册</a></li>
          <li class="dropdown-btn"><a href="javascript:void(0)" dropdown id="btn_ideas" data-toggle="dropdown" data-target="#ideas-collapse" ng-click="closeMenu($event); openMenu($event)" tabindex="300">反馈</a></li>

          <li class="dropdown-btn"><a href="javascript:void(0)"  dropdown id="people-collapse-btn" data-toggle="dropdown" data-target="#about-collapse" ng-click="closeMenu($event); openMenu($event)" tabindex="400">关于我们</a></li>
          <li class="dropdown-btn"><a href="javascript:void(0)"  dropdown id="search" data-toggle="dropdown" data-target="#search-collapse" ng-click="closeMenu($event); openMenu($event)" class="" tabindex="500" ><i class="fa fa-search" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
    <!-- /.container-fluid -->
  </nav>


  <div class="absolute">
    <div class="container-fluid" id="menu-panels">

      <div class="collapse" id="work-collapse">
        <div class="backdrop" ng-click="closeMenu($event)">
        </div>
        <div class="row mega-menu">
          <div class="col-sm-8 col-md-6">
            <div class="menu-title margin-topx2">
              <a href="/work/challenging-inequality/" id="challengesHeaderLink" tabindex="100">Challenging inequality<i class="padding-left fa fa-angle-right"></i></a></span>
            </div>
            <p></p>
            <div class="row">
              <div class="menu-subtitle challenge">
                <div alt="challenge icon" class="img-circle" style="background-image: url('https://fordfoundcontent.blob.core.windows.net/media/2696/issue_area_icons_page_4.png')">
                </div>
                <a href="/work/challenging-inequality/civic-engagement-and-government/" tabindex="101">Civic Engagement and Government</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="collapse" id="search-collapse">
        <div class="backdrop" ng-click="closeMenu($event)">
        </div>
        <div class="row padding-bottomx6 padding-topx6">
          <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="input-group search-bar" role="search">
              <form method="GET" action="/search/">
                <div class="row">
                  <div class="col-md-10 col-sm-10 col-xs-9">
                    <input type="text" class="form-control" id="q" name="q" aria-label="Enter search terms" placeholder="Enter search terms" tabindex="501"/>
                    <input type="hidden" id="p" name="p" value="0"/>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <span class="input-group-btn">
                      <button role="button" class="btn btn-primary " type="submit" tabindex="501" id="searchButton">Search</button>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


</header>
<a id="maincontent" aria-label="Main Content"></a>


<section class="hero-carousel" tabindex="-1">
  <div id="carousel" class="carousel slide" data-interval="false" data-ride="carousel">
    <!-- begin of 照片 -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
       <a href="/campaigns/we-believe-in-democracy/">
        <div class="hero-full-inner ie8 background2"  title="" style="background-image: url(img/haibao/<?php echo "{$news_haibao}"?>)">
        </div>
        <div class="carousel-caption hero-text"  title="Boston, Massachusetts. 2004. Photo credit: Getty Images">
         <h2 style="font-size: 40px; text-align: left;"><?php echo "$news_in_chinese"?>频道</h2>
       </div>
       <div class="hero-text-post padding-topx6"></div>
     </a>
   </div>
 </div>
 <!-- end of 头条幻灯片 -->
</div>
</section>

<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript">
  // Setup swipe events
  $(function () {
    $(".carousel-caption, .carousel-inner, .navbar.navbar-default, .absolute").swipe({
      //Generic swipe handler for all directions
      swipeRight: function (event, direction, distance, duration, fingerCount) {
        $('.left-arrow').click();
      },
      swipeLeft: function (event, direction, distance, duration, fingerCount) {
        $('.right-arrow').click();
      },
      threshold: 50,
      excludedElements: $.fn.swipe.defaults.excludedElements + ", #menu-panels, .right-arrow, .left-arrow" // exclude arrows and main menu
    });
  });
</script>

<!-- 开始“最新消息” -->
<section class="latest">
 <div class="content">
  <div class="container">
    <br>
    <br>
    <div class="row">
      <div class="col-lg-8 mb-4 mb-lg-0">
        <h2 class="job-section-title" style="font-weight: normal;font-size: 20px;"> 频道/<span style="font-color:#962E2C;"><?php echo "$news_in_chinese"?></span></h2>
        <div class="job-about">
          <div class="job-about-information">
            <div class="job-about-title font-weight-bold" style="font-weight: bold;font-size: 30px;">
              <?php echo "{$news['title']}"?>
            </div>

            <div class="job-section-company">
              <span class="mr-2" style="color: #b48786; font-size: 15px;"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo "{$news['time_news']}"?></span>
              <span style="color: #b48786; font-size: 15px;"><i class="fa fa-fw fa-map-marker"></i><?php echo "{$news["src"]}"?></span>
            </div>
          </div>
        </div>
        <div class="job-company-description mt-2">
          <div style="text-align: center;">
            <img src="<?php echo "{$news['pic']}"?>">
          </div>
          <hr>
          <!-- <p>正文内容 正文内容 正文内容 正文内容 正文内容</p> -->
          <?php echo "{$news['content']}"?>
        </div>
      </div>

      <div class="col-lg-4 offset-lg-1 sidebar sidebar-sm ">
        <div class="job-share mb-3">
          <a href="#" onclick="javascript:window.open('https://twitter.com','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-lg btn-block btn-social text-left"><i class="fa fa-fw fa-twitter"></i> Share on
            Twitter</a>
            <a href="#" onclick="javascript:window.open('https://www.facebook.com','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-lg btn-block btn-social text-left"><i class="fa fa-fw fa-facebook"></i> Share on Facebook</a>
            <a href="#" onclick="javascript:window.open('http://www.weibo.com','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn btn-lg btn-block btn-social text-left"><i class="fa fa-weibo" aria-hidden="true"></i> Share on Weibo</a>
          </div>
          <div class="similar-jobs sidebar-box">
            <h3 style="font-size:20px;" >评论区</h3>
            <div class="similar-job">
              <div style="font-size: 15px;">SunshinePursuer<span class="text-capitalize text-muted small" style="font-size: 15px;">(2min前)：</span></div>
              <div class="small" style="font-size: 13px;">“That was fun!”</div>
            </div>

            <hr>
            <div class="similar-job">
              <div style="font-size: 15px;">二芳<span style="font-size: 15px;" class="text-capitalize text-muted small">(1h前)：</span></div>
              <div class="small" style="font-size: 13px;" >“二芳到此一游~~~”</div>
            </div>

            <hr>
            <div class="similar-job">
              <div style="font-size: 15px;">元芳<span style="font-size: 15px;" class="text-capitalize text-muted small">(3h前)：</span></div>
              <div class="small" style="font-size: 13px;">“大人，你怎么看？？？”</div>
            </div>

            <hr>
            <div class="similar-job">
              <div style="font-size: 15px;">一方菌<span style="font-size: 15px;" class="text-capitalize text-muted small">(5h前)：</span></div>
              <div class="small" style="font-size: 13px;">“沙发沙发！占沙发啦~~~”</div>
            </div>

            <hr>
            <div class="similar-job">
              <form role="form">
                <div class="form-group">
                  <span class="text-capitalize text-muted small" style="font-size: 15px;">(现在)：</span>
                  <br>
                  <textarea class="form-control small" rows="5" placeholder="请先登录再留言"></textarea>
                  <div style="font-size: 13px;"><a href="#" class="btn btn-md btn-default text-center disabled" style="margin-left: 30%;margin-top: 10%;">提交</a></div>
                </div>
              </form>
            </div>

          </div>        
        </div>
      </div>

    </div>
  </div>

</section>






<footer class="footer-wrapper" role="contentinfo">

  <div class="container-fluid">
    <div class="row"> 
      <div class="col-sm-3 col-md-4 col-lg-4 padding-topx3">
        <div class="h4" style="font-size: 23px;">联系我们</div>
        <div class="footer-icons">
         <a href="https://wangyifang.github.io/" target="blank" alt="Watch us on github" title="Github" tabindex="0"><i class="fa fa-github" aria-hidden="true"></i>
         </a> 
         <a href="https://facebook.com" target="blank" alt="Share on Facebook" title="Facebook" tabindex="0"><i class="fa fa-facebook-official" aria-hidden="true"></i>
         </a>
         <a href="http://www.twitter.com" target="blank" alt="Share on LinkedIn" title="LinkedIn" tabindex="0"><i class="fa fa-twitter-square" aria-hidden="true"></i>
         </a>
         <a href="http://www.weibo.com/1655874741/profile?rightmod=1&wvr=6&mod=personinfo" target="blank" alt="Watch us on Weibo" title="Weibo" tabindex="0"><i class="fa fa-weibo" aria-hidden="true"></i>
         </a>
       </div>
       <div class="visible-xs">
         <div class="rule margin-topx3 margin-bottomx3"></div>
       </div>
       <div class="h4 padding-topx3" style="font-size: 23px;">关于作者</div>
       <span class="small sans grey-light" style="font-size: 16px;">有关作者的更多信息，请移步<a href="https://wangyifang.github.io/">yifang的博客。</a></span>
     </div>
     <div class="col-xs-12 visible-xs">
      <div class="rule margin-topx3 margin-bottomx3"></div>
    </div>


    <div class="col-xs-12 col-sm-9 col-md-4 col-lg-6 padding-topx3">
      <div class="h4 contact" style="font-size: 23px;">地址</div>
      <div class="row">
        <div itemscope class="col-xs-7 col-md-12 col-lg-6 padding-bottom-small">
          <meta itemprop="name" content="Zhejiang University" />
          <span itemprop="address" class="office-address">
            <p>Zhejiang University, Yuquan Campus<br/>Zheda Road 38, 310027<br/>Hangzhou<br/>China</p>
          </span>

        </div>
        <div class="col-xs-5 col-md-12 col-lg-6">
          <p itemprop="telephone" class="hidden-xs office-telephone">Tel. (+86) 178-6666-6666</p>
          <div class="hidden-xs">
            <a href="https://www.google.com/maps/place/%E6%B5%99%E6%B1%9F%E5%A4%A7%E5%AD%A6%E7%8E%89%E6%B3%89%E6%A0%A1%E5%8C%BA/@30.263608,120.1212449,17z/data=!3m1!4b1!4m5!3m4!1s0x344b62e59347d573:0xc71a5f36936f81a0!8m2!3d30.263608!4d120.1234389" target="_blank" tabindex="0"><span class="directions small sans" style="font-size: 16px;">Directions</span></a> 
            <br>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xs-12 visible-xs footer-number-directions" aria-hidden="true">
      <div class="row">
        <div class="col-xs-7 padding-bottomx3">
          <button type="button" class="btn btn-primary" tabindex="-1">(+86) 178-6666-6666</button>
        </div>
        <div class="col-xs-5 col-md-12">
          <a href="https://www.google.com/maps/place/%E6%B5%99%E6%B1%9F%E5%A4%A7%E5%AD%A6%E7%8E%89%E6%B3%89%E6%A0%A1%E5%8C%BA/@30.263608,120.1212449,17z/data=!3m1!4b1!4m5!3m4!1s0x344b62e59347d573:0xc71a5f36936f81a0!8m2!3d30.263608!4d120.1234389" target="_blank" class="btn btn-primary" tabindex="-1">Directions</a>
        </div>
      </div>
    </div>


    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-xs-12 visible-xs clearfix">
      <div class="rule margin-topx3 margin-bottomx3">
      </div>
    </div>


    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-0 col-lg-3 padding-topx3 email-update">


      <div class="h4 white" style="font-size: 23px;">任何反馈意见，请联系我们</div>

      <form action="/umbraco/Surface/Email/ShortSignup" class="form-group" method="post">      
        <div class="footer-formpadding footer-fname">
          <input aria-label="Email signup enter first name" class="form-control" data-val="true" data-val-maxlength="The field FirstName must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="FirstNameFooter" name="Footer.FirstName" placeholder="First name" tabindex="0" type="text" value="" style="font-size: 18px;" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.FirstName" data-valmsg-replace="true"></span>
        </div>
        <div class="footer-formpadding footer-lname">
          <input aria-label="Email signup enter last name" class="form-control" data-val="true" data-val-maxlength="The field LastName must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="LastNameFooter" name="Footer.LastName" placeholder="Last name" tabindex="0" type="text" value="" style="font-size: 18px;" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.LastName" data-valmsg-replace="true"></span>
        </div>
        <div class="footer-formpadding footer-email">
          <input aria-label="Email signup enter email" class="form-control" data-val="true" data-val-email="Please enter a valid email address" data-val-maxlength="The field Email must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="EmailFooter" name="Footer.Email" placeholder="E-mail" tabindex="0" type="text" value="" style="font-size: 18px;" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.Email" data-valmsg-replace="true"></span>
        </div>
        <div class="subscription-slider col-xs-12 margin-bottom"> 
          <a href="/e-mail-updates/" tabindex="0">More Subscription Options</a>
        </div>
        <div class="row email-buttons">
          <div class="col-xs-5 col-sm-4">
            <button type="button" class="btn btn-default short-email-submit636335218235684242 email-submit" tabindex="0" aria-label="Submit email subscription form" style="font-size: 12.8px;letter-spacing: 1px;line-height: 2;padding-left: 15px;padding-right: 15px;text-transform: uppercase;">提交</button>
          </div>
          <div class="col-xs-7 col-sm-8">
            <button type="button" class="btn btn-default btn-block email-dont-show" tabindex="0" aria-label="Do not show email popup">Don't show<span class="hidden-xxs"> this</span> again</button>
          </div>
          <!-- <div class="col-xs-7 text-right footer-detail padding-top subscription-footer"> 
            <p>
              <a href="/e-mail-updates/" tabindex="0">Subscription options</a>
            </p>
          </div> -->
        </div>
      </form>    

      <script type="text/javascript">
        $(document).ready(function () {

          var emailSliderSelector = '.email-slider';
          var showingClass = 'slide-in';

        // Form submit
        $('.short-email-submit636335218235684242').click(function () {
          var $form = $('.short-email-submit636335218235684242').closest('form');
          if ($form.valid()) {
                //submit
                $.ajax({
                  url: '/umbraco/Surface/Email/ShortSignup',
                  type: 'POST',
                  cache: false,
                  data: $form.serialize(),
                  success: function (response, status, xhr) {
                    $form.parent().html(response);
                    // Success will have a short response, failure has the full error validation messaging and form
                    if (response.length < 200) {
                      // Wait 3s and then close slider
                      if ($(emailSliderSelector).length) {
                        setTimeout(function () {
                          $(emailSliderSelector).removeClass(showingClass);
                        }, 3000);
                      }
                    }

                  },
                  error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR + " " + textStatus + " " + errorThrown);
                  }
                });
                FordFoundation.logEvent(_gaq, 'emailSignup', 'shortForm', 'BlogPost');
              }
            });
      });
    </script>

  </div>
</div>

<div class="row footer-detail">
  <div class="col-xs-12">
    <div class="rule margin-topx3 margin-bottomx3"></div>
  </div>
  <div class="col-sm-7 col-md-6 col-lg-9">
    <p>- 以生活的静默抵抗世俗的粗糙，</p>
    <p>- 底色里有照见，有懂得，有地阔天高。</p>
  </div>

  <div class="col-sm-5 col-md-6 col-lg-3 text-right">
    <p>© 2017 25th-hour News</p>
    <p>by Yifang</p>
  </div>
</div>
</div>
</footer>

<script src="css/DependencyHandler.css" type="text/javascript"></script>
<script>
  $(function () { 
    $("[data-toggle='popover']").popover({
        html:true  //这样就可以在内容里面添加HTML代码了
      });
  });
</script>


</body>
</html>
