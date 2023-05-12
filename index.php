<?php
include_once('user/includes/dbconnection.php');
?>

<!doctype html>
<html>
<head>

<!--Copied links -->
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/custom.css">
 <!--COPY ENDS-->


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<title>Rift Valley University</title>
<!--this link was here..<link rel="stylesheet" href="css/style.css"/>-->
<!--fav-icon-->
<link rel="shortcut icon" href="images/favicon.png"/>

</head>

<body>
    
<div class="probootstrap-search" id="probootstrap-search">
      <a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
      <form action="#">
        <input type="search" name="s" id="search" placeholder="Search a keyword and hit enter...">
      </form>
    </div>
    
    <div class="probootstrap-page-wrapper">
      <!-- Fixed navbar -->
      
      <div class="probootstrap-header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
              <span><i class="icon-location2"></i>Gotera, AA 000, Ethiopia</span>
              <span><i class="icon-phone2"></i>+251-11-111-1111</span>
              <span><i class="icon-mail"></i>info@rvu.com</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
              <ul>
                <li><a href="#"><i class="icon-twitter"></i></a></li>
                <li><a href="#"><i class="icon-facebook2"></i></a></li>
                <li><a href="#"><i class="icon-instagram2"></i></a></li>
                <li><a href="#"><i class="icon-youtube"></i></a></li>
                <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i class="icon-search"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-default probootstrap-navbar">
        <div class="container">
          <div class="navbar-header">
            <div class="btn-more js-btn-more visible-xs">
              <a href="#"><i class="icon-dots-three-vertical "></i></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <img src="rvulogo.jpeg" alt="rvulogo" class="img-sm-responsive img-rounded img-fluid" style="width: auto; height: 100px;">
            <!--This link was here..<a class="navbar-brand" href="index.html" title="uiCookies:Enlight">Enlight</a>-->
            

          </div>

          <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="index.html">Home</a></li>

              <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admissions</a>
                <ul class="dropdown-menu">
                  <li><a href="about.html">Graduate</a></li>
                  <li><a href="courses.html">Undergraduate</a></li>
                  <li><a href="course-single.html">Course Single</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                  <li class="dropdown-submenu dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Departments</span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Computer Science</a></li>
                      <li><a href="#">Business Adminstration</a></li>
                      <li><a href="#">Software Engineering</a></li>
                      <li><a href="#">Leadership and management</a></li>
                    </ul>
                  </li>
                  <li><a href="news.html">News</a></li>
                </ul>
              </li>


              <li><a href="courses.html">Programs</a></li>
              <li><a href="teachers.html">Faculty</a></li>
              <li><a href="events.html">About us</a></li>
              
              <li><a href="contact.html">Contact us</a></li>
              <li><a href="user/login.php"><button type="button" class="btn btn-primary">sign in</button></a></li>
            </ul>
          </div>
        </div>
      </nav>

      <section class="flexslider">
        <ul class="slides">
          <li style="background-image: url(img/gradmen.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">Your Bright Future is Our Mission</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li style="background-image: url(img/bg2.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">Leading Liberal arts, research and Science Institution</h1>
                  </div>
                </div>
              </div>
            </div>
            
          </li>
          <li style="background-image: url(img/gradwoman.jpg)" class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="probootstrap-slider-text text-center">
                    <h1 class="probootstrap-heading probootstrap-animate">Helping Each of Our Students to discover their full Potential</h1>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </section>
      
      <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-left section-heading probootstrap-animate">
              <h2>Welcome To Home Of Excellence</h2>
            </div>
          </div>
        </div>
      </section>

      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="probootstrap-flex-block">
                <div class="probootstrap-text probootstrap-animate">
                  <h3>About School</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis explicabo veniam labore ratione illo vero voluptate a deserunt incidunt odio aliquam commodi blanditiis voluptas error non rerum temporibus optio accusantium!</p>
                  <p><a href="#" class="btn btn-primary">Learn More</a></p>
                </div>
                <div class="probootstrap-image probootstrap-animate" style="background-image: url(img/slider_3.jpg)">
                  <a href="https://vimeo.com/45830194" class="btn-video popup-vimeo"><i class="icon-play3"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="probootstrap-section" id="probootstrap-counter">
        <div class="container">
          
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
              <div class="probootstrap-counter-wrap">
                <div class="probootstrap-icon">
                  <i class="icon-users2"></i>
                </div>
                <div class="probootstrap-text">
                  <span class="probootstrap-counter">
                    <span class="js-counter" data-from="0" data-to="20203" data-speed="5000" data-refresh-interval="50">1</span>
                  </span>
                  <span class="probootstrap-counter-label">Students Enrolled</span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
              <div class="probootstrap-counter-wrap">
                <div class="probootstrap-icon">
                  <i class="icon-user-tie"></i>
                </div>
                <div class="probootstrap-text">
                  <span class="probootstrap-counter">
                    <span class="js-counter" data-from="0" data-to="139" data-speed="5000" data-refresh-interval="50">1</span>
                  </span>
                  <span class="probootstrap-counter-label">Certified Teachers</span>
                </div>
              </div>
            </div>
            <div class="clearfix visible-sm-block visible-xs-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
              <div class="probootstrap-counter-wrap">
                <div class="probootstrap-icon">
                  <i class="icon-library"></i>
                </div>
                <div class="probootstrap-text">
                  <span class="probootstrap-counter">
                    <span class="js-counter" data-from="0" data-to="99" data-speed="5000" data-refresh-interval="50">1</span>%
                  </span>
                  <span class="probootstrap-counter-label">Passing to Universities</span>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
               
               <div class="probootstrap-counter-wrap">
                <div class="probootstrap-icon">
                  <i class="icon-smile2"></i>
                </div>
                <div class="probootstrap-text">
                  <span class="probootstrap-counter">
                    <span class="js-counter" data-from="0" data-to="100" data-speed="5000" data-refresh-interval="50">1</span>%
                  </span>
                  <span class="probootstrap-counter-label">Parents Satisfaction</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="probootstrap-section probootstrap-section-colored probootstrap-bg probootstrap-custom-heading probootstrap-tab-section" style="background-image: url(img/slider_2.jpg)">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center section-heading probootstrap-animate">
              <h2 class="mb0">Highlights</h2>
            </div>
          </div>
        </div>
        <div class="probootstrap-tab-style-1">
          <ul class="nav nav-tabs probootstrap-center probootstrap-tabs no-border">
            <li class="active"><a data-toggle="tab" href="#featured-news">Featured News</a></li>
            <li><a data-toggle="tab" href="#upcoming-events">Upcoming Events</a></li>
          </ul>
        </div>
      </section>

      <section class="probootstrap-section probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              
              <div class="tab-content">

                <div id="featured-news" class="tab-pane fade in active">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="owl-carousel" id="owl1">
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, ut.</p>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_1.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, officia.</p>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_2.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, dolores.</p>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, earum.</p>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              
                              
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                      </div>
                    </div>
                  </div>
                  <!-- END row -->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <p><a href="#" class="btn btn-primary">View all news</a></p>  
                    </div>
                  </div>
                </div>
                <div id="upcoming-events" class="tab-pane fade">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="owl-carousel" id="owl2">
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              <span class="probootstrap-location"><i class="icon-location2"></i>White Palace, Brooklyn, NYC</span>
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_1.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              <span class="probootstrap-location"><i class="icon-location2"></i>White Palace, Brooklyn, NYC</span>
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_2.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              <span class="probootstrap-location"><i class="icon-location2"></i>White Palace, Brooklyn, NYC</span>
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                        <div class="item">
                          <a href="#" class="probootstrap-featured-news-box">
                            <figure class="probootstrap-media"><img src="img/img_sm_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive"></figure>
                            <div class="probootstrap-text">
                              <h3>Tempora consectetur unde nisi</h3>
                              <span class="probootstrap-date"><i class="icon-calendar"></i>July 9, 2017</span>
                              <span class="probootstrap-location"><i class="icon-location2"></i>White Palace, Brooklyn, NYC</span>
                            </div>
                          </a>
                        </div>
                        <!-- END item -->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <p><a href="#" class="btn btn-primary">View all events</a></p>  
                    </div>
                  </div>
                </div>

              </div>
            
            </div>
          </div>
        </div>
      </section>

      <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2>Our Featured Programs</h2>
              <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p>
            </div>
          </div>
          <!-- END row -->
          <div class="row">
            <div class="col-md-6">
              <div class="probootstrap-service-2 probootstrap-animate">
                <div class="image">
                  <div class="image-bg">
                    <img src="img/CS.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </div>
                </div>
                <div class="text">
                  <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                  <h3>Computer Science</h3>
                  <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi voluptatum architecto rerum error.</p>
                  <p><a href="#" class="btn btn-primary">Enroll now</a> <span class="enrolled-count">2,928 students enrolled</span></p>
                </div>
              </div>

              <div class="probootstrap-service-2 probootstrap-animate">
                <div class="image">
                  <div class="image-bg">
                    <img src="img/SE.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </div>
                </div>
                <div class="text">
                  <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                  <h3>Software Engineering</h3>
                  <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi voluptatum architecto rerum error.</p>
                  <p><a href="#" class="btn btn-primary">Enroll now</a> <span class="enrolled-count">7,202 students enrolled</span></p>
                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="probootstrap-service-2 probootstrap-animate">
                <div class="image">
                  <div class="image-bg">
                    <img src="img/leadership.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </div>
                </div>
                <div class="text">
                  <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                  <h3>Leadership and management</h3>
                  <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi voluptatum architecto rerum error.</p>
                  <p><a href="#" class="btn btn-primary">Enroll now</a> <span class="enrolled-count">12,582 students enrolled</span></p>
                </div>
              </div>

              <div class="probootstrap-service-2 probootstrap-animate">
                <div class="image">
                  <div class="image-bg image-link">
                    <img src="img/BA.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </div>
                </div>
                <div class="text">
                  <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                  <h3>Business Adminstration</h3>
                  <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi voluptatum architecto rerum error.</p>
                  <p><a href="#" class="btn btn-primary">Enroll now</a> <span class="enrolled-count">9,582 students enrolled</span></p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

      
      
      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2>Meet Our Qualified Faculty</h2>
              <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p>
            </div>
          </div>
          <!-- END row -->

          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="probootstrap-teacher text-center probootstrap-animate">
                <figure class="media">
                  <img src="img/person_1.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive">
                </figure>
                <div class="text">
                  <h3>Tijani Hussein</h3>
                  <p>Computer Scientist and HO Quality Assurance</p>
                  <ul class="probootstrap-footer-social">
                    <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                    <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                    <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="probootstrap-teacher text-center probootstrap-animate">
                <figure class="media">
                  <img src="img/person_5.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive">
                </figure>
                <div class="text">
                  <h3>Arega H.</h3>
                  <p>Software Engineer and Head of Cs Department</p>
                  <ul class="probootstrap-footer-social">
                    <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                    <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                    <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="clearfix visible-sm-block visible-xs-block"></div>
            <div class="col-md-3 col-sm-6">
              <div class="probootstrap-teacher text-center probootstrap-animate">
                <figure class="media">
                  <img src="img/person_6.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive">
                </figure>
                <div class="text">
                  <h3>Abebe Mengistu</h3>
                  <p>Leadership and management consultant</p>
                  <ul class="probootstrap-footer-social">
                    <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                    <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                    <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="probootstrap-teacher text-center probootstrap-animate">
                <figure class="media">
                  <img src="img/person_7.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive">
                </figure>
                <div class="text">
                  <h3>Hana Robel</h3>
                  <p>Business consultant and Financial analyst</p>
                  <ul class="probootstrap-footer-social">
                    <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                    <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                    <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial" style="background-image: url(img/slider_4.jpg);">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2>Alumni Testimonial</h2>
              <p class="lead">Sed a repudiandae impedit voluptate nam Deleniti dignissimos perspiciatis nostrum porro nesciunt</p>
            </div>
          </div>
          <!-- END row -->
          <div class="row">
            <div class="col-md-12 probootstrap-animate">
              <div class="owl-carousel owl-carousel-testimony owl-carousel-fullwidth">
                <div class="item">

                  <div class="probootstrap-testimony-wrap text-center">
                    <figure>
                      <img src="img/person_1.jpg" alt="Free Bootstrap Template by uicookies.com">
                    </figure>
                    <blockquote class="quote">&ldquo;Design must be functional and functionality must be translated into visual aesthetics, without any reliance on gimmicks that have to be explained.&rdquo; <cite class="author"> &mdash; <span>Mike Fisher</span></cite></blockquote>
                  </div>

                </div>
                <div class="item">
                  <div class="probootstrap-testimony-wrap text-center">
                    <figure>
                      <img src="img/person_2.jpg" alt="Free Bootstrap Template by uicookies.com">
                    </figure>
                    <blockquote class="quote">&ldquo;Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn’t really do it, they just saw something. It seemed obvious to them after a while.&rdquo; <cite class="author"> &mdash;<span>Jorge Smith</span></cite></blockquote>
                  </div>
                </div>
                <div class="item">
                  <div class="probootstrap-testimony-wrap text-center">
                    <figure>
                      <img src="img/person_3.jpg" alt="Free Bootstrap Template by uicookies.com">
                    </figure>
                    <blockquote class="quote">&ldquo;I think design would be better if designers were much more skeptical about its applications. If you believe in the potency of your craft, where you choose to dole it out is not something to take lightly.&rdquo; <cite class="author">&mdash; <span>Brandon White</span></cite></blockquote>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- END row -->
        </div>
      </section>

      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
              <h2>Why Choose Enlight School</h2>
              <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Consectetur Adipisicing</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>  
              </div>
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Aliquid Dolorum Saepe</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>
              </div>
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Eveniet Tempora Anisi</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Laboriosam Quod Dignissimos</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>  
              </div>
              
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Asperiores Maxime Modi</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>
              </div>
              
              <div class="service left-icon probootstrap-animate">
                <div class="icon"><i class="icon-checkmark"></i></div>
                <div class="text">
                  <h3>Libero Maxime Molestiae</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
                </div>
              </div>

            </div>
          </div>
          <!-- END row -->
        </div>
      </section>
      
      <section class="probootstrap-cta">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Get your admission now!</h2>
              <a href="#" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft">Enroll</a>
            </div>
          </div>
        </div>
      </section>
      <footer class="probootstrap-footer probootstrap-bg">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>About The School</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro provident suscipit natus a cupiditate ab minus illum quaerat maxime inventore Ea consequatur consectetur hic provident dolor ab aliquam eveniet alias</p>
                <h3>Social</h3>
                <ul class="probootstrap-footer-social">
                  <li><a href="#"><i class="icon-twitter"></i></a></li>
                  <li><a href="#"><i class="icon-facebook"></i></a></li>
                  <li><a href="#"><i class="icon-github"></i></a></li>
                  <li><a href="#"><i class="icon-dribbble"></i></a></li>
                  <li><a href="#"><i class="icon-linkedin"></i></a></li>
                  <li><a href="#"><i class="icon-youtube"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-md-push-1">
              <div class="probootstrap-footer-widget">
                <h3>Links</h3>
                <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Courses</a></li>
                  <li><a href="#">Teachers</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>Contact Info</h3>
                <ul class="probootstrap-contact-info">
                  <li><i class="icon-location2"></i> <span>198 West 21th Street, Suite 721 New York NY 10016</span></li>
                  <li><i class="icon-mail"></i><span>info@domain.com</span></li>
                  <li><i class="icon-phone2"></i><span>+123 456 7890</span></li>
                </ul>
              </div>
            </div>
           
          </div>
          <!-- END row -->
          
        </div>

        <div class="probootstrap-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8 text-left">
                <p>&copy; 2017 <a href="https://uicookies.com/">uiCookies:Enlight</a>. All Rights Reserved. Designed &amp; Developed with <i class="icon icon-heart"></i> by <a href="https://uicookies.com/">uicookies.com</a></p>
              </div>
              <div class="col-md-4 probootstrap-back-to-top">
                <p><a href="#" class="js-backtotop">Back to top <i class="icon-arrow-long-up"></i></a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
    <!-- END wrapper -->
    

    <script src="js/scripts.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/custom.js"></script>

   
    <!--footer------------->
    <footer>
        <p>Copyright (C) - 2021 | Developed By <a href="https://codingcush.blogspot.com/">Coding Cush </a> </p>
    </footer>
</body>

</html>