  $(document).ready(function() {
    (function() {
        [].slice.call(document.querySelectorAll('.tabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    $('#main-nav').sidr();
    $('#fullpage').fullpage({
        'verticalCentered': true,
        'easing': 'easeInOutCirc',
        'css3': false,
        'scrollingSpeed': 900,
        'slidesNavigation': true,
        'slidesNavPosition': 'bottom',
        'easingcss3': 'ease',
        'navigation': true,
        //'anchors': ['Home', 'Features', 'About', 'Video', 'Clients', 'Screenshots', 'Pricing', 'Download', 'Contact'],
        'anchors': ['Home', 'Features', 'About', 'Download', 'Contact', 'Register'],
        'navigationPosition': 'left'
    });
    $('.screenshots-content, .clients-content').css('height', $(window).height());

    // CONTACT FORM

  
       $(document).mouseup(function (e) {
    if ($(".sidr-open ")[0]){
    var container = $("#sidr");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
      $(".sidr-open #main-nav").click();
    }}
});
 
 
/*$('#submit').click(function(){
 
$.post("contact.php", $("#contact-form").serialize(),  function(response) {
$('#success').fadeIn().html(response);
$('#success').delay(2000).fadeOut();
});
return false;
 
});*/

//Script Contactanos
      $("#contact-form").submit(function(){
          //$("#submit").value='Please wait...';
          $("#submit").attr("disabled", true);

          //$.post("process.php?send=contact", $("#contact-form").serialize(),
          $.post("index.php/site/Contact", $("#contact-form").serialize(),
              function(data){
                  if(data.frm_check == 'error'){
                      $("#success").html("<div class='alert-danger'>ERROR: " + data.msg + "!</div>");
                      document.ContactForm.submit.value='Resend >>';
                      document.ContactForm.submit.disabled=false;
                  } else {
                      $("#success").html("<div class='alert-success'>Tu mensaje ha sido enviado con exito!</div>");
                      $("#submit").value='Send >>';
                      $('#contact-form')[0].reset();

                  }
              }, "json");

          return false;

      });
//</Script Contactanos


  });
  jQuery(window).load(function() {
    jQuery('#preloader').fadeOut();
  });
