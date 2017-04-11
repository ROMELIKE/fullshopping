/**
 * Created by ROME on 4/6/2017.
 */
$(document).ready(function () {
   $("div.message-box").delay(3500).fadeOut(2000);
   $("div.close").click(function () {
      $("div.message-box").delay(2500).fadeOut(1000);
   })
});
