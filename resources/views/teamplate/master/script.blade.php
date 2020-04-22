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