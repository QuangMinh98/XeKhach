<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
  <meta name="apple-mobile-web-app-title" content="CodePen">
  <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
  <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <title>CodePen - Admin Panel Concept</title>
  <link href="https://fonts.googleapis.com/css?family=Assistant:400,600,700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      height: 100%;
      width: 100%;
      padding: 20px;
      margin: 0;
      display: -webkit-box;
      display: flex;
      font-family: 'Assistant', sans-serif;
    }

    .menu {
      border-radius: 7.5px;
      background: -webkit-linear-gradient(-45deg, #dc2430 0%, #ea4774 100%);
      min-height: calc(100vh - 40px);
      padding: 15px 15px 0;
      width: 50px;
      -webkit-transition: width 0.25s;
      transition: width 0.25s;
      overflow: hidden;
      display: inline-block;
    }
    .menu.active {
      width: 200px;
    }
    .menu.active .heading p {
      opacity: 1;
    }
    .menu.active .wrap {
      opacity: 1;
    }
    .menu.active .menu-icon span {
      -webkit-transform: rotateY(90deg);
      transform: rotateY(90deg);
    }
    .menu.active .menu-icon span:first-child {
      -webkit-transform: rotate(-45deg);
      transform: rotate(-45deg);
    }
    .menu.active .menu-icon span:last-child {
      -webkit-transform: rotate(45deg);
      transform: rotate(45deg);
    }
    .menu.active .menu-icon span:first-child {
      top: 0;
    }
    .menu.active .menu-icon span:last-child {
      top: 2px;
    }
    .menu .wrap {
      min-width: calc(200px - 30px);
      opacity: 0;
      -webkit-transition: width 0.25s, opacity 0.25s;
      transition: width 0.25s, opacity 0.25s;
    }
    .menu .heading {
      padding: 0 0 15px;
      margin-bottom: 10px;
      position: relative;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: justify;
      justify-content: space-between;
      overflow: hidden;
      border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    }
    .menu .heading p {
      -webkit-transition: opacity 0.25s;
      transition: opacity 0.25s;
      opacity: 0;
      padding: 0;
      margin: 0;
      width: 100%;
    }
    .menu .heading .menu-icon {
      position: absolute;
      right: 0;
      top: 0;
      cursor: pointer;
      height: 14px;
      width: 20px;
    }
    .menu .heading .menu-icon span {
      -webkit-transition: right 0.25s, -webkit-transform 0.25s;
      transition: right 0.25s, -webkit-transform 0.25s;
      transition: transform 0.25s, right 0.25s;
      transition: transform 0.25s, right 0.25s, -webkit-transform 0.25s;
    }
    .menu .heading .menu-icon span:first-child {
      -webkit-transform-origin: top right;
      transform-origin: top right;
    }
    .menu .heading .menu-icon span:last-child {
      -webkit-transform-origin: bottom right;
      transform-origin: bottom right;
    }
    .menu .heading .menu-icon span:first-child, .menu .heading .menu-icon span:last-child {
      position: relative;
      right: 3px;
    }
    .menu .heading .menu-icon p {
      margin: 0;
      padding: 0;
    }
    .menu .heading .menu-icon span {
      width: 100%;
      height: 2px;
      display: block;
      margin-bottom: 4px;
      background-color: white;
    }
    .menu .dropdown {
      position: relative;
    }
    .menu .dropdown:before {
      position: absolute;
      top: 8px;
      right: 0;
      height: 0;
      width: 0;
      border-top: 5px solid transparent;
      border-left: 8px solid white;
      border-bottom: 5px solid transparent;
      content: '';
      -webkit-transition: -webkit-transform 0.25s;
      transition: -webkit-transform 0.25s;
      transition: transform 0.25s;
      transition: transform 0.25s, -webkit-transform 0.25s;
    }
    .menu .dropdown.js-opened:before {
      -webkit-transform: rotate(90deg);
      transform: rotate(90deg);
    }
    .menu .dropdown a {
      margin-left: 10px;
    }
    .menu .dropdown + a {
      margin-top: 0;
    }
    .menu .dropdown + .title {
      margin-top: 5px;
    }
    .menu .dropdown .links {
      overflow: hidden;
    }
    .menu .dropdown .links a {
      position: relative;
      padding-left: 10px;
      z-index: 1;
    }
    .menu .dropdown .links a:before {
      z-index: -1;
      position: absolute;
      left: 0;
      top: calc(50% - 2px);
      content: '';
      display: inline-block;
      vertical-align: middle;
      width: 4px;
      height: 4px;
      background-color: white;
      border-radius: 4px;
      -webkit-transition: background-color 0.25s, border-radius 0.25s, width 0.25s, height 0.25s, top 0.25s;
      transition: background-color 0.25s, border-radius 0.25s, width 0.25s, height 0.25s, top 0.25s;
    }
    .menu .dropdown .links a:hover:before {
      background-color: rgba(255, 255, 255, 0.25);
      border-radius: 15px;
      width: 100%;
      height: 100%;
      top: 0;
    }
    .menu .title {
      color: rgba(255, 255, 255, 0.75);
      border-top: 1px solid rgba(255, 255, 255, 0.5);
      padding-top: 10px;
      margin-top: 10px;
    }
    .menu a {
      text-decoration: none;
    }
    .menu p {
      cursor: default;
    }
    .menu a, .menu p {
      margin: 5px 0;
      padding: 5px 0;
      display: block;
      color: white;
      font-size: 14px;
      line-height: 16px;
    }

    .content {
      border: 1px solid rgba(0, 0, 0, 0.15);
      display: -webkit-box;
      display: flex;
      flex-wrap: wrap;
      -webkit-box-flex: 1;
      flex-grow: 1;
      margin-left: 20px;
      border-radius: 7.5px;
      overflow: hidden;
    }
    .content .header {
      width: 100%;
      min-height: 50px;
      display: -webkit-box;
      display: flex;
      flex-wrap: wrap;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: justify;
      justify-content: space-between;
      border-bottom: 1px solid rgba(255, 255, 255, 0.5);
      padding: 10px 20px;
      background: -webkit-linear-gradient(-45deg, rgba(0, 0, 0, 0.01) 0%, rgba(0, 0, 0, 0.1) 100%);
    }
    .content .header p, .content .header a {
      margin: 5px 0;
      color: #dc2430;
    }
    .content .header p {
      margin-right: 10px;
    }
    .content .header a {
      color: #dc2430;
    }
    .content .body {
      padding: 20px;
      display: -webkit-box;
      display: flex;
      width: 100%;
      background: -webkit-linear-gradient(-45deg, rgba(0, 0, 0, 0.01) 0%, rgba(0, 0, 0, 0.1) 100%);
      height: 100%;
    }
  </style>
  <script>
    window.console = window.console || function(t) {};
  </script>
  <script>
    if (document.location.search.match(/type=embed/gi)) {
      window.parent.postMessage("resize", "*");
    }
  </script> 
</head>

<body translate="no">
  <div class="menu active">
    <div class="heading">
      <p>Cefar</p>
      <div class="menu-icon js-toggle-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="wrap">
      <a href="">Dashboard</a>
      <a href="">Account</a>

      <p class="title">Line Break</p>

      <a href="">Dashboard</a>
      <a href="">Dashboard</a>

      <div class="dropdown js-opened">
        <p>Dropdown</p>
        <div class="links" style="height: 253px;">
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
          <a href="">Dropdown Item</a>
        </div>
      </div>

      <a href="">Dashboard</a>

      <div class="dropdown">
        <p>Dropdown</p>
        <div class="links" style="height: 0px;">
          <a href="">Dashboard</a>
          <a href="">Dashboard</a>
        </div>
      </div>

      <p class="title">Legal Section</p>

      <div class="dropdown">
        <p>Documents</p>
        <div class="links" style="height: 0px;">
          <a href="">Contract</a>
          <a href="">Employee Handbook</a>
        </div>
      </div>
      <a href="">Terms &amp; Conditions</a>
      <a href="">Copyright Details</a>
    </div>
  </div>
  
  <div class="content">
    <div class="header">
      <p><span id="time">Good Morning,</span> Stefan Hibbitt</p>
      <a href="#">Logout</a>
    </div>
    <div class="body">

    </div>
  </div>
  <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script id="rendered-js">
    dateTime = function () {
      var now = new Date();
      var hours = now.getHours();
      var greet;

      if (hours < 12) {
        greet = "Good Morning,";
      } else if (hours < 16) {
        greet = "Good Afternoon,";
      } else {
        greet = "Good Evening,";
      }

      $('#time').html(greet);
    };

    menuDropdowns = function () {
      $('.dropdown').each(function () {
        const links = $(this).find('.links');
        const h = links.height();

        links.css('height', '0');

        $(this).click(function () {
          if ($(this).toggleClass('js-opened').hasClass('js-opened')) {
            links.css('height', h);
          } else {
            links.css('height', 0);
          };

        });
      });
    };

    $(document).ready(function () {

      menuDropdowns();
      dateTime();

      $('.js-toggle-menu').click(function () {
        $('.menu').toggleClass('active');
      });
    });
  //# sourceURL=pen.js
</script>
</body>
</html>