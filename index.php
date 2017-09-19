<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home / 25th News</title>
  <!--Standard meta-->
  <meta http-equiv="cache-control" content="private">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge; chrome=1">

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
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      content: '';
      background-color: rgba(0,0,0,.55);
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

    .card-img2 
    {
      border-style:none;
      border-width:0;
      width:100%;
      height:230px;
      background-position:center;
      /*background-repeat: no-repeat;*/
    }
  </style>

  <link rel="search" type="application/opensearchdescription+xml" href="content-search.xml"/>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Anton|Bubbler+One|Indie+Flower|Oswald|Pangolin|Patrick+Hand+SC|Poppins|Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/4.3.2/sweetalert2.min.css">
  <link href="css/quill.snow.css" rel="stylesheet">
  <!--   <link rel="stylesheet" href="css/app-492c00a164.css"></link> -->
  <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
  <link href="css/DependencyHandler.css" type="text/css" rel="stylesheet"/>

</head>

<body class="transparent-dark">

  <!-- PHP连接MySql数据库 -->
  <?php

//  判断是否已经登陆
  if (!(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "")) {
    // echo "您没有登录！" . "<br>";
    $userid = "登录/注册";

  } else {
    // echo "您已经登录！";
    $userid = $_SESSION["user_id"];
    // echo $_SESSION["user_id"] . "<br>";
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

  $sql = "SELECT id, title, time_news, src, category, pic, content FROM news_news";
  $result = $conn->query($sql);

//创建数组逐条保存新闻
  $news_news_array =  array();
// $count = 0;

  if ($result->num_rows > 0) {

    // 将数据保存到多维数组中以便之后读取
    while($row = $result->fetch_assoc()) {
      // if($row["id"] == "4")
      // {
      //   // $count = $row["id"];
      //   $news_news_array[$row["id"]]["title"] = $row["title"];
      //   $news_news_array[$row["id"]]["time_news"] = $row["time_news"];
      //   $news_news_array[$row["id"]]["src"] = $row["src"];
      //   $news_news_array[$row["id"]]["category"] = $row["category"];
      //   $news_news_array[$row["id"]]["pic"] = $row["pic"];
      //   $news_news_array[$row["id"]]["content"] = $row["content"];

      //   echo "test: " . $news_news_array["4"]["title"];
      //   // echo $count;
      //   echo $row["id"];

        // echo "test: " . $news_news_array[$row["id"]]["title"] . "<br>" . $news_news_array[$row["id"]]["time_news"] . "<br>" . $news_news_array[$row["id"]]["src"] . "<br>" . $news_news_array[$row["id"]]["category"] . "<br>" . $news_news_array[$row["id"]]["pic"] . "<br>" . $news_news_array[$row["id"]]["content"];
      // }

      // $count = $row["id"];
      // echo $count;
      $news_news_array[$row["id"]]["title"] = $row["title"];
      $news_news_array[$row["id"]]["time_news"] = $row["time_news"];
      $news_news_array[$row["id"]]["src"] = $row["src"];
      $news_news_array[$row["id"]]["category"] = $row["category"];
      $news_news_array[$row["id"]]["pic"] = $row["pic"];
      $news_news_array[$row["id"]]["content"] = $row["content"];
      // echo $news_news_array["1"]["title"] . "<br>";

    }
  } else {
    // echo "0 结果";
  }
  $conn->close();

  ?>
  <!-- End of PHP连接数据库 -->

  <input type="hidden" value="ipaddress:" />
  <input type="hidden" value="Error:" />
  <header class="primary-nav">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" tabindex="1" aria-label="Home" href="index.php">
            <span class="sr-only">Home</span> <!-- 点击图片可以回到主页 -->
            <img src="img/logo_white.png"/>
          </a>
        </div>
        <!-- <a href="#maincontent" class="sr-only" tabindex="2">Skip to main content</a> -->
        <div class="navigation-items">
          <ul class="list-inline list-unstyled">
            <li class="dropdown-btn"><a href="transaction.php"><?php echo $userid ?></a></li>
            <li class="dropdown-btn"><a title="城市天气"  
              data-container="body" data-toggle="popover" data-placement="bottom" 
              data-content='<iframe width="700" scrolling="no" height="70" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=2&icon=1&py=hangzhou&num=1&site=12"></iframe>'>天气</a></li>
              <li class="dropdown-btn"><a href="#feedback">反馈</a></li>

              <li class="dropdown-btn"><a href="#feedback">关于我们</a></li>
              <li class="dropdown-btn"><a href="javascript:void(0)"  dropdown id="search" data-toggle="dropdown" data-target="#search-collapse" ng-click="closeMenu($event); openMenu($event)" class="" tabindex="500" ><i class="fa fa-search" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <!-- /.container-fluid -->
      </nav>


      <div class="absolute">
        <div class="container-fluid" id="menu-panels">


        <!-- <div class="collapse" id="work-collapse">
          <div class="backdrop" ng-click="closeMenu($event)">
          </div> -->
          <!-- <div class="row mega-menu"> -->
            <!-- <div class="col-sm-8 col-md-6">
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
            </div> -->
            <!-- <iframe width="700" scrolling="no" height="70" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=2&icon=1&py=hangzhou&num=3&site=12"></iframe> -->
            <!-- </div> -->
            <!-- </div> -->

            <div class="collapse" id="search-collapse">
              <div class="backdrop" ng-click="closeMenu($event)">
              </div>
              <div class="row padding-bottomx6 padding-topx6">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                  <div class="input-group search-bar" role="search">
                    <form method="GET" action="">
                      <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-9">
                          <input type="text" class="form-control" id="q" name="q" aria-label="Enter search terms" placeholder="输入搜索内容" tabindex="501"/>
                          <input type="hidden" id="p" name="p" value="0"/>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <span class="input-group-btn">
                            <button role="button" class="btn btn-primary " type="submit" tabindex="501" id="searchButton">搜索</button>
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

      <!-- 回到最上面 -->
      <a class="btn btn-primary back-to-top scrollspy hidden-xs" id="express-to-top" href="#top" alt="Back to Top"> 
        <i class="fa fa-chevron-up">
        </i> 
      </a>


      <section class="hero-carousel" tabindex="-1">
        <div id="carousel" class="carousel slide" data-interval="false" data-ride="carousel">
          <!-- 轮播（Carousel）指标 -->
          <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
            <li data-target="#carousel" data-slide-to="3"></li>
          </ol>  
          <!-- begin of 头条幻灯片 -->
          <div class="carousel-inner" role="listbox">
           <div class="item active">
             <a href="https://wangyifang.github.io/">
              <div class="hero-full-inner ie8 background2"  title="" style="background-image: url(img/1-6.jpg)">
              </div>
              <div class="carousel-caption hero-text"  title="Boston, Massachusetts. 2004. Photo credit: Getty Images">
               <h2 style="font-family: 'Roboto', monospace; text-align: left;">文艺：</h2>
               <h2 style="font-family: 'Roboto', monospace; text-align: left;">以生活的静默抵抗世俗的粗糙，</h2>
               <h2 style="font-family: 'Roboto', monospace; text-align: left;">底色里有照见，有懂得，有地阔天高。</h2>
             </div>
             <div class="hero-text-post padding-topx6"></div>
           </a>
         </div>
         <div class="item">
             <a href="http://www.ftchinese.com/story/001073099">
              <div class="hero-full-inner ie8 background2"  title="" style="background-image: url(img/haibao/military_朝核问题是如何变为“中国之患”的.jpg)">
              </div>
              <div class="carousel-caption hero-text"  title="Boston, Massachusetts. 2004. Photo credit: Getty Images">
               <h2 style="font-family: 'Roboto', monospace; text-align: left;">军事：</h2>
               <h2 style="font-family: 'Roboto', monospace; text-align: left;">朝核问题是如何变为“中国之患”的？</h2>
             </div>
             <div class="hero-text-post padding-topx6"></div>
           </a>
         </div>
         <div class="item">
          <a href="http://www.ftchinese.com/story/001073000">
            <div class="hero-full-inner ie8 background2"  style="background-image: url(img/haibao/stock_安邦系股票出现下跌.jpg)"></div>
            <div class="carousel-caption hero-text" >
             <h2 style="font-family: 'Roboto', monospace; text-align: left;">股票：</h2>
             <h2 style="font-family: 'Roboto', monospace; text-align: left;">安邦系股票出现下跌</h2>
           </div>
           <div class="hero-text-post padding-topx6"></div>
         </a>
       </div>
       <div class="item">
        <a href="http://www.ftchinese.com/story/001070484">
          <div class="hero-full-inner ie8 background2"  style="background-image: url(img/haibao/tech_微软亚洲研究院院长：AI取代人，大概还要500年.jpg)"></div>
          <div class="carousel-caption hero-text" >
           <h2 style="font-family: 'Roboto', monospace; text-align: left;">科技：</h2>
           <h2 style="font-family: 'Roboto', monospace; text-align: left;">微软亚洲研究院院长：AI取代人，大概还要500年</h2>
         </div>
         <div class="hero-text-post padding-topx6"></div>
       </a>
     </div>  
   </div>
   <!-- end of 头条幻灯片 -->
   <!-- Controls 头条幻灯片箭头切换 -->
   <a href="#carousel" role="button" data-slide="prev">
     <span class="left-arrow" aria-hidden="true">
       <i class="fa fa-chevron-left" aria-hidden="true"></i>
     </span> 
     <span class="sr-only">More to previous</span>
   </a>
   <a href="#carousel" role="button" data-slide="next">
    <span class="right-arrow" aria-hidden="true">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </span> 
    <span class="sr-only">Move to next</span>
  </a>
</div>
</section>


<!-- 开始“最新消息” -->
<section class="latest">
	<h2 class="hidden-xs text-center padding-topx5 padding-bottomx2 no-margin">最新消息</h2>
  <div class="latest-links hidden-xs text-center no-margin">
    <p>搜罗24小时新闻资讯，想你所想，看你想看</p>
  </div>

  <!-- 选择器，下拉选择新闻类别 -->
  <div class="filter shade"> 
   <div class="filter-btn dropdown-btn" id="filter-dropdown" href="#" data-toggle="dropdown" data-target="#filter-collapse" tabindex="1000" role="button" aria-label="Select filter dropdown">
    <span class="filter-text padding-bottom pull-left">后花园 <i class="fa fa-bars" aria-hidden="true"></i></span>
    <!-- <span aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></span>  -->
    <br>
  </div>
  <div id="filter-collapse" class="collapse">
    <ul class="list-unstyled" role="menu" aria-labelledby="filter-dropdown" >

      <li class="filter-item"><a href="ShowNewsHeadline.php" role="menuitem" tabindex="-1">头条</a></li>
      <li class="filter-item"><a href="index.php" role="menuitem" tabindex="-1">热点</a></li>
      <li class="filter-item"><a href="ShowNewsEconomy.php" role="menuitem" tabindex="-1">财经</a></li>
      <li class="filter-item"><a href="ShowNewsSports.php" role="menuitem" tabindex="-1">体育</a></li>
      <li class="filter-item"><a href="ShowNewsEntertainment.php" role="menuitem" tabindex="-1">娱乐</a></li>
      <li class="filter-item"><a href="ShowNewsMilitary.php" role="menuitem" tabindex="-1">军事</a></li>
      <li class="filter-item"><a href="ShowNewsEducation.php" role="menuitem" tabindex="-1">教育</a></li>
      <li class="filter-item"><a href="ShowNewsTech.php" role="menuitem" tabindex="-1">科技</a></li>
      <li class="filter-item"><a href="ShowNewsNBA.php" role="menuitem" tabindex="-1">NBA</a></li>
      <li class="filter-item"><a href="ShowNewsStock.php" role="menuitem" tabindex="-1">股票</a></li>
      <li class="filter-item"><a href="ShowNewsConstellation.php" role="menuitem" tabindex="-1">星座</a></li>
    </ul>
  </div>
</div>





<div class="container-fluid">
  <h2 class="visible-xs padding-topx5 padding-bottomx2 no-margin">最新消息</h2>
  <div class="latest-links visible-xs padding-bottomx5 no-margin">
    <p>搜罗24小时新闻资讯，想你所想，看你想看</p>
  </div>
  
  <!-- <div id="tile-container" class="row" data-columns="2"> -->
  <div class="row" data-columns="2">
    <!-- 添加 -->
    <div class="column col-sm-6">


     <div itemscope itemtype="http://schema.org/Article" class="card-latest forum shade">
      <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=1">
        <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[1]["pic"];?>);">
          <!-- <a href="/ideas/ford-forum/your-american-dream-score/"> -->
          <!-- <img itemprop="image" class="" alt="" src="<?php echo $news_news_array[1]["pic"];?>"  /> -->
          <!-- </a> -->
        </div>
        <div class="card-body">
          <div class="h6">
            <a itemprop="name">
              <?php echo $news_news_array[1]["src"];?>
            </a>
          </div>
          <div class="h7">
           <time itemprop="datePublished">&nbsp<?php echo $news_news_array[1]["time_news"];?></time>
         </div>
         <div itemprop="name headline" class="h3">
           <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=1"><?php echo $news_news_array[1]["title"];?></a>
         </div>
         <p itemprop="description"></p>
       </div>
     </a>
   </div>


   <div itemscope itemtype="http://schema.org/NewsArticle" class="card-latest news shade">
    <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=2">
      <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[2]["pic"];?>);">
        <!-- <img itemprop="image" class="" alt="" src="<?php echo $news_news_array[2]["pic"];?>"  /> -->
      </div>
      <div class="card-body">
        <div class="h6">
          <a itemprop="name">
            <?php echo $news_news_array[2]["src"];?>
          </a>
        </div>

        <div class="h7">
          <time itemprop="datePublished">&nbsp<?php echo $news_news_array[2]["time_news"];?></time>
        </div>

        <div itemprop="name headline" class="h3">
          <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=2"><?php echo $news_news_array[2]["title"];?></a>
        </div>
        <p itemprop="description"></p>
      </div>
    </a>
  </div>


  <div itemscope itemtype="http://schema.org/MediaObject" class="card-latest multimedia shade">
    <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=3">
      <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[3]["pic"];?>);">
      </div>
      <div class="card-body">
        <div class="h6">
          <a itemprop="name">
            <?php echo $news_news_array[3]["src"];?>
          </a>
        </div>
        <div class="h7">
          <time itemprop="datePublished">&nbsp<?php echo $news_news_array[3]["time_news"];?></time>
        </div>
        <div class="h3" itemprop="name">
         <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=3"><?php echo $news_news_array[3]["title"];?></a>
       </div>
     </div>
   </a>
 </div>

 <div itemscope itemtype="http://schema.org/BlogPosting" class="card-latest blog shade">
   <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=4">
    <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[4]["pic"];?>);">
    </div>
    <div class="card-body">
     <div class="h6">
      <a itemprop="name">
        <?php echo $news_news_array[4]["src"];?>
      </a>
    </div>

    <div class="h7">
      <time itemprop="datePublished">&nbsp<?php echo $news_news_array[4]["time_news"];?></time>
    </div>

    <div itemprop="name headline" class="h3">
      <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=4"><?php echo $news_news_array[4]["title"];?></a>
    </div>
  </div>
</a>
</div>


<div itemscope itemtype="http://schema.org/NewsArticle" class="card-latest news shade">
 <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=5">
  <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[5]["pic"];?>);">
  </div>
  <div class="card-body">
    <div class="h6">
      <a itemprop="name">
        <?php echo $news_news_array[5]["src"];?>
      </a>
    </div>

    <div class="h7">
      <time itemprop="datePublished">&nbsp<?php echo $news_news_array[5]["time_news"];?></time>
    </div>

    <div itemprop="name headline" class="h3">
     <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=5"><?php echo $news_news_array[5]["title"];?></a>
   </div>
   <p itemprop="description">
   </p>
 </div>
</a>
</div>


<div itemscope itemtype="http://schema.org/BlogPosting" class="card-latest blog shade">
 <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=6">
  <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[6]["pic"];?>);">
  </div>
  <div class="card-body">
    <div class="h6">
      <a itemprop="name">
        <?php echo $news_news_array[6]["src"];?>
      </a>
    </div>

    <div class="h7">
      <time itemprop="datePublished">&nbsp<?php echo $news_news_array[6]["time_news"];?></time>
    </div>

    <div itemprop="name headline" class="h3">
      <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=6"><?php echo $news_news_array[6]["title"];?></a>
    </div>
  </div>
</div>
</div>


<!-- 第二列 -->
<div class="column col-sm-6">
  <div itemscope itemtype="http://schema.org/JobPosting" class="card-latest openings shade">
   <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=7">
    <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[7]["pic"];?>);">
    </div>
    <div class="card-body">
      <span class="hidden jobid" aria-hidden="true">0</span>
      <div class="h6">
        <a itemprop="name">
          <?php echo $news_news_array[7]["src"];?>
        </a>
      </div>

      <div class="h7">
        <time itemprop="datePosted">&nbsp<?php echo $news_news_array[7]["time_news"];?></time>
      </div>
      <div itemprop="title" class="h3">
       <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=7"><?php echo $news_news_array[7]["title"];?></a>
     </div>
     <div itemprop="description" class="h4"></div>
     <p></p>
   </div>
 </a>
</div>

<div itemscope itemtype="http://schema.org/Article" class="card-latest twitter shade" style="text-align: left;">
 <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=8">
  <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[8]["pic"];?>);">
  </div>

  <div class="card-body">
    <div class="h6">
      <a itemprop="name">
        <?php echo $news_news_array[8]["src"];?>
      </a>
    </div>
    <div class="h7">
      <time itemprop="datePublished">&nbsp<?php echo $news_news_array[8]["time_news"];?></time>
    </div>
    <div itemprop="title" class="h3">
     <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=8"><?php echo $news_news_array[8]["title"];?></a>
   </div>
   <div itemprop="description" class="h4"></div>
 </div>
</a>
</div>

<div itemscope itemtype="http://schema.org/NewsArticle" class="card-latest news shade">
  <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=9">
    <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[9]["pic"];?>);">
    </div>
    <div class="card-body">
      <div class="h6">
        <a itemprop="name">
          <?php echo $news_news_array[9]["src"];?>
        </a>
      </div>
      <div class="h7">
        <time itemprop="datePublished">&nbsp<?php echo $news_news_array[9]["time_news"];?></time>
      </div>
      <div itemprop="name headline" class="h3">
        <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=9"><?php echo $news_news_array[9]["title"];?></a>
      </div>
      <p itemprop="description"></p>
    </div>
  </a>
</div>

<div itemscope itemtype="http://schema.org/BlogPosting" class="card-latest blog shade">
 <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=10">
  <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[10]["pic"];?>);">
  </div>
  <div class="card-body">
    <div class="h6">
      <a itemprop="name">
        <?php echo $news_news_array[10]["src"];?>
      </a>
    </div>

    <div class="h7">
      <time itemprop="datePublished">&nbsp<?php echo $news_news_array[10]["time_news"];?></time>
    </div>

    <div itemprop="name headline" class="h3">
     <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=10"><?php echo $news_news_array[10]["title"];?></a>
   </div>
 </div>
</a>
</div>

<div itemscope itemtype="http://schema.org/NewsArticle" class="card-latest headline shade">
  <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=11">
    <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[11]["pic"];?>);">
    </div>
    <div class="card-body">
      <div class="h6">
        <a itemprop="name">
          <?php echo $news_news_array[11]["src"];?>
        </a>
      </div>

      <div class="h7">
        <time itemprop="datePublished">&nbsp<?php echo $news_news_array[11]["time_news"];?></time>
      </div>

      <div itemprop="name headline" class="h3">
        <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=11"><?php echo $news_news_array[11]["title"];?></a>
      </div>
      <p itemprop="description"></p>
    </div>
  </a>
</div>

<div itemscope itemtype="http://schema.org/BlogPosting" class="card-latest blog shade">
  <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=12">
    <div class="card-img card-img2" style="background-image:url(<?php echo $news_news_array[12]["pic"];?>);">
    </div>
    <div class="card-body">
      <div class="h6">
        <a itemprop="name">
          <?php echo $news_news_array[12]["src"];?>
        </a>
      </div>
      <div class="h7">
        <time itemprop="datePublished">&nbsp<?php echo $news_news_array[12]["time_news"];?></time>
      </div>
      <div itemprop="name headline" class="h3">
       <a href="ShowNewsDetail_unlogin.php?news_column=news_news&newsid=12"><?php echo $news_news_array[12]["title"];?></a>
     </div>
   </div>
 </a>
</div>


</div>
<!-- end of 添加 -->
</div>


<div class="col-xs-12 col-xs-offset-0 col-sm-4 col-sm-offset-4">
 <!--   <div id="load-more-spinner" class="col-xs-12 text-center margin-bottomx2">
        <img alt="" src="/assets/img/spinner_transparent.gif" />
      </div> -->
      <button class="btn btn-primary btn-block margin-topx2 margin-bottomx6 load-more shade" data-filter="" data-position="12" data-count="12" data-url="/Umbraco/Surface/HomeSurface/LoadMore">加载更多</button>
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
       <span class="small sans grey-light">有关作者的更多信息，请移步<a href="https://wangyifang.github.io/">yifang的博客。</a></span>
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
            <a href="https://www.google.com/maps/place/%E6%B5%99%E6%B1%9F%E5%A4%A7%E5%AD%A6%E7%8E%89%E6%B3%89%E6%A0%A1%E5%8C%BA/@30.263608,120.1212449,17z/data=!3m1!4b1!4m5!3m4!1s0x344b62e59347d573:0xc71a5f36936f81a0!8m2!3d30.263608!4d120.1234389" target="_blank" tabindex="0"><span class="directions small sans">Directions</span></a> 
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


      <div class="h4 white" style="font-size: 23px;"><a name="feedback">任何反馈意见，请联系我们</a></div>

      <form action="/umbraco/Surface/Email/ShortSignup" class="form-group" method="post">      
        <div class="footer-formpadding footer-fname">
          <input aria-label="Email signup enter first name" class="form-control" data-val="true" data-val-maxlength="The field FirstName must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="FirstNameFooter" name="Footer.FirstName" placeholder="First name" tabindex="0" type="text" value="" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.FirstName" data-valmsg-replace="true"></span>
        </div>
        <div class="footer-formpadding footer-lname">
          <input aria-label="Email signup enter last name" class="form-control" data-val="true" data-val-maxlength="The field LastName must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="LastNameFooter" name="Footer.LastName" placeholder="Last name" tabindex="0" type="text" value="" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.LastName" data-valmsg-replace="true"></span>
        </div>
        <div class="footer-formpadding footer-email">
          <input aria-label="Email signup enter email" class="form-control" data-val="true" data-val-email="Please enter a valid email address" data-val-maxlength="The field Email must be a string or array type with a maximum length of &#39;500&#39;." data-val-maxlength-max="500" data-val-required="*" id="EmailFooter" name="Footer.Email" placeholder="E-mail" tabindex="0" type="text" value="" />
          <span class="field-validation-valid red" data-valmsg-for="Footer.Email" data-valmsg-replace="true"></span>
        </div>
        <div class="subscription-slider col-xs-12 margin-bottom"> 
          <a href="/e-mail-updates/" tabindex="0">More Subscription Options</a>
        </div>
        <div class="row email-buttons">
          <div class="col-xs-5 col-sm-4">
            <button type="button" class="btn btn-default short-email-submit636335218235684242 email-submit" tabindex="0" aria-label="Submit email subscription form">提交</button>
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
<script charset="utf-8" src="js/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>

<script>
  $(function () { 
    $("[data-toggle='popover']").popover({
        html:true  //这样就可以在内容里面添加HTML代码了
      });
  });
</script>

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



</body>
</html>
