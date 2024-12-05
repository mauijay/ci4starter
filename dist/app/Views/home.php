<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jay Lamping and other contributors">
    <meta name="generator" content="Hugo 0.112.5">
    <title><?=$title?> · CI4 Starter App</title>
    
    <style>
      *{
          margin: 0;
          padding: 0;
        }
      body{
        font-family:poppins;
        background: #005762;
      }
      .wrapper{
        width: 1170px;
        margin: 0 auto;
      }
      .logo{
        width: 20%;
        float: left;
        padding: 30px 0 0;
        font-size: 25px;
        font-weight: 700;
        color: #fff;
      }
      nav{
        width: 75%;
        float: right;
        text-align: right;
        padding: 30px 0 0;
      }
      nav a{
        text-decoration: none;
        color: #fff;
        padding: 15px 20px;
      }
      .navigation{
        height: 60px;
      }
      .banner-area{
        animation-name: animate;
        animation-duration: 7s;
        animation-iteration-count: ;
        animation-timing-function: ease-in-out;
        height: 100vh;
      }
      .text-area{
        text-align: center;
        width: 75%;
        margin: 0 auto;
      }
      .text-area h2{
        font-size: 75px;
        color: #fff;
        margin: 10% 0 0;
      }
      .text-area h3{
        color: #fff;
        text-transform: uppercase;
        margin: 0 0 15px;
        font-size: 35px;
      }
      .text-area a{
        text-decoration: none;
        background: #262626;
        color: #fff;
        padding: 15px 60px;
        font-size: 18px;
        display: inline-block;
        margin-top: 5%;
        border-radius: 50px;
      }
      .text-area p{
        font-size: 18px;
        color: #fff;
        width: 70%;
        margin: 0 auto;
        line-height:1.9;
      }
      @keyframes animate {
        0%{
          background: #4c9ab6;
        }
        25%{
          background: #005762;
        }
        50%{
          background: #005762;
        }
        75%{
          background: #005762;
        }
        100%{
          background: #005762;
        }
      }


      /* ignore the code below */

      .link-area
      {
        position:fixed;
        bottom:20px;
        left:20px;  
        padding:15px;
        border-radius:40px;
        background:tomato;
      }
      .link-area a
      {
        text-decoration:none;
        color:#fff;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-bg-dark">        
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">      
      <main class="px-3">
        <div class="banner-area">
          <div class="wrapper">
            <div class="navigation">
              <div class="logo">
              <?=$title?>
              </div>
              <nav>
                <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="/">Home</a>
                <a class="nav-link fw-bold py-1 px-0" href="/admin">Admin</a>
                <a class="nav-link fw-bold py-1 px-0" href="/tests">Tests</a>
                <a class="nav-link fw-bold py-1 px-0" href="/news">Blog</a>
                <a class="nav-link fw-bold py-1 px-0" href="/peanut-butter">Peanut Butter</a>
                <a class="nav-link fw-bold py-1 px-0" href="/jelly">Jelly</a>
              </nav>
            </div>

            <div class="banner-text">
              <div class="text-area">
                <h2><?= setting()->get('AppJay.companyName'); ?></h2>
                <h3><?= setting()->get('AppJay.slogan'); ?></h3>
                <p><?= setting()->get('AppJay.about'); ?></p>
                <a href="#">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
        <!--- ignore the code below-->
        <div class="link-area">
          <a href="https://www.youtube.com/channel/UCki4IDK86E6_pDtptmsslow" target="_blank">Click for More</a>
        </div>
      </main>
      <footer class="mt-auto text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
      </footer>
    </div>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
