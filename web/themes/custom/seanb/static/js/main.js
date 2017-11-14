(function ($, Drupal, window, document, undefined) {

  Drupal.behaviors.main = {
    attach: function (context, settings) {
      constants = Drupal.behaviors.fortytwoMain.constants;

      // Store responsive type
      var $body = $('body');
      if ($body.hasClass('layout-adaptive')) {
        constants.LAYOUT = {
          fluid: false,
          adaptive: true,
        };
      }
      else if ($body.hasClass('layout-fluid')) {
        constants.LAYOUT = {
          fluid: true,
          adaptive: false,
        };
      }

      $(window).once().on('scroll', function() {
        var windowTop = $(window).scrollTop();
        $('header .hero-image').css({'top': (((windowTop * 0.4) * -1) - 130) + 'px'});
      });

      // Scroll animation for anchors.
      var $html = $('html', context);
      var navigation_height = $('div.navigation').height();
      $('a[href*=\\#]', context).on('click', function (event) {
        event.preventDefault();
        $html.animate({ scrollTop: $(this.hash).offset().top - navigation_height }, 500);
      });

      // Add class to items in viewport for loading animation.
      $('section, .skill, footer nav', context).css('opacity', '0').bind('inview', function (event, visible) {
        if (visible === true) {
          $(this).addClass('view-fade-in');
        }
      });
    }
  };

})(jQuery, Drupal, this, this.document);
