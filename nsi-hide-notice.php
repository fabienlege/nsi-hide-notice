<?php
/*
Plugin Name: NSI Hide Notice
Plugin URI: https://agenceho5.com
Description: Masque les notices d'information considérés comme innutiles
Version: 1.0
Author: Fabien LEGE | NSI - Agence ho5
Author URI: https://agenceho5.com
*/

/*add_action( 'admin_notices', function() {
	echo '<a href="#" class="show-hidden-notices">Voir toutes les notifications masquées</a>';
});*/

add_action( 'admin_notices',function() { ?>
  <div class="nsi-hide-notices notice" style="display: none">
      <div id="all-notices" class="postbox-container">
          <div class="meta-box-sortables ui-sortable">
              <div class="postbox closed">
                  <div class="notice-block"><span class="text-notice"><?php _e( 'Voir les notifications masquées', 'nsi-hide-notices' ); ?> (<span class="counter-bg"><span class="pending-count"></span></span>)</span></div>
                  <div class="inside">
                      <div class="notices"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php
});

add_action( 'admin_footer', function() { ?>
  <script>
      (function ($) {
          $(function () {
              $(window).load(function () {
                  var html = [];
                  $(".wrap").children('.error').each(function () {
                    if(!$(this).hasClass('nsi-hide-notices') && !$(this).hasClass('acf-admin-notice') && $(this).attr('id') != 'message'){
                      html.push($(this).prop('outerHTML'));
                    }
                  });

                  $(".wrap").children('.updated').each(function () {
                    if(!$(this).hasClass('nsi-hide-notices') && !$(this).hasClass('acf-admin-notice') && $(this).attr('id') != 'message'){
                      html.push($(this).prop('outerHTML'));
                    }
                  });

                  $(".wrap").children('.notice').each(function () {
                    console.log($(this).attr('id'));
                    if(!$(this).hasClass('nsi-hide-notices') && !$(this).hasClass('acf-admin-notice') && $(this).attr('id') != 'message'){
                      html.push($(this).prop('outerHTML'));
                    }
                  });

                  var goodhtml = [];
                  $.each(html, function (index, value) {
                      if (goodhtml.indexOf(value) === -1) {
                          goodhtml.push(value);
                      }
                  });

                  $.each(goodhtml, function (index, value) {
                      $(value).appendTo($(".notices"));
                  });

                  $('#all-notices').find('.pending-count').text(goodhtml.length);

                  if( goodhtml.length > 1 ) {
                      $('.nsi-hide-notices').show();
                  }

                  $( document ).ajaxComplete(function () {
                      $('#all-notices').find('.pending-count').text($('.nsi-hide-notices').find('.notices').children('div').length);
                  });


                  $('.postbox.closed > .notice-block').toggle(
                      function () {
                          $(this).parent().removeClass('closed');
                          $(this).attr( 'aria-expanded', 'true' );
                      }, function() {
                          $(this).parent().addClass('closed');
                          $(this).attr( 'aria-expanded', 'false' );
                      }
                  );

                  $( '.notice.is-dismissible' ).on('click', '.notice-dismiss', function ( event ) {
                      var container = $(this).closest('div');
                      if ( ! container.hasClass('grr') ) {
                          container.addClass('grr');
                          container.remove();
                          $( '.notice.is-dismissible' ).not(".grr").find('.notice-dismiss').trigger('click');
                      }
                  });

                  $( '.connection-banner-dismiss' ).on( 'click', function() {
                      var container = $(this).parent().parent();
                      if ( ! container.hasClass('grr') ) {
                          container.addClass('grr');
                          container.remove();
                          $( '.jp-wpcom-connect__container' ).not(".grr").find('.connection-banner-dismiss').trigger('click');
                      }
                  });
              });

          });
      })(jQuery);
  </script>
  <style>
      .notice, .error, .updated {
          display: none;
      }
      #all-notices, #all-notices .notice, #all-notices .error, #all-notices .updated, #message, .acf-admin-notice {
          display: block;
          float: none;
      }
      #all-notices .hidden, #setting-error-tgmpa {
          display: none;
      }
      .clearfix:after {
          visibility: hidden;
          display: block;
          font-size: 0;
          content: " ";
          clear: both;
          height: 0;
      }
      .clearfix { display: inline-block; }
      /* start commented backslash hack */
      * html .clearfix { height: 1%; }
      .clearfix { display: block; }
      /* close commented backslash hack */

      .nsi-hide-notices{
        background: transparent;
        border: none;
        padding: 0;
        box-shadow: none;
      }
      .nsi-hide-notices .postbox .notice-block{
        color: #0073aa;
        cursor: pointer;
      }
      .nsi-hide-notices .postbox .inside{
        padding: 0;
      }
      .nsi-hide-notices .postbox{
        background: transparent;
        box-shadow: none;
        border: none;
        margin: 0;
        color
      }
  </style>
<?php
},999);