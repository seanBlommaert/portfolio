(function ($, Drupal) {

  Drupal.behaviors.main = {
    attach: function (context) {

      // Scroll animation for anchors.
      var $page = $('html, body', context);
      var navigationHeight = $('div.navigation').height();
      $('a[href*=\\#]', context).on('click', function (event) {
        event.preventDefault();
        $page.animate({ scrollTop: $(this.hash).offset().top - navigationHeight }, 500);
      });

      // Add class to items in viewport for loading animation.
      $('section, .skill, footer nav', context).css('opacity', '0').bind('inview', function (event, visible) {
        if (visible === true) {
          $(this).addClass('view-fade-in');
        }
      });

    },
  };

})(jQuery, Drupal);
