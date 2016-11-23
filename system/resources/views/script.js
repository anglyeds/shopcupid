// JavaScript Document




    function animDown(id) {
        var fav = $('#fav_'+id).offset(); 

		// if ( $("#Banner img").attr("src") == "http://test.gif") ){
		//       $(".top").addClass("right");
		// }

		if ($('#fav_'+id).attr("src") == 'http://localhost/SC4/resources/views/style/fav_gray.png'){

			var bouncetime = 1000;
		    var ballheight = 280;
		    var ballsize = 80;

			$('#fav_'+id).animate({
			    top: $(window).height() - fav.top - '50' + ($(window).scrollTop()),
			    left: $(window).width() - fav.left - '110',
			}, "slow", "easeOutQuad");

			// $('#fav_'+id).css({'width':ballsize, 'height':ballsize, 'margin-left':-(ballsize/2),'display':'block', 'bottom':ballheight});

			// $('#fav_'+id).animate({'bottom':20}, bouncetime, 'easeInQuad', function() {
	  //           $('#fav_'+id).animate({'bottom':ballheight}, bouncetime, 'easeOutQuad', function() {
	  //               ballbounce();
	  //           });
	  //       });


			// $('#fav_'+id).show().animate({ top: 305 }, {duration: 1000, easing: 'easeOutBounce'});

			// $('#fav_'+id).animate({
			//     top: '42',
			//     left: '-38',
			// }, "fast", "swing");
			// $('#fav_'+id).offset({ top: '42', left: '-38'});

			// $('#fav_'+id).fadeTo(1000,0.30, function() {
		 //      	$('#fav_'+id).attr("src",'http://localhost/SC4/resources/views/style/fav_red.png');
		 // 	}).fadeTo(500,1);

		 } else if($('#fav_'+id).attr("src") == 'http://localhost/SC4/resources/views/style/fav_red.png'){

		 // 	$('#fav_'+id).animate({
			//     top: $(window).height() - fav.top - '50' + ($(window).scrollTop()),
			//     left: $(window).width() - fav.left - '110',
			// }, "slow", "swing");

			// $('#fav_'+id).animate({
			//     top: '42',
			//     left: '-38',
			// }, "fast", "swing");
			// $('#fav_'+id).offset({ top: '42', left: '-38'});

			// $('#fav_'+id).fadeTo(1000,0.10, function() {
		 //      	$('#fav_'+id).attr("src",'http://localhost/SC4/resources/views/style/fav_gray.png');
		 // 	}).fadeTo(500,1);

		 }

    }

    function fav_red(id) {

    	var fav = $('#fav_'+id).offset(); 

	 // 	$('#fav_'+id).animate({
		//     top: $(window).height() - fav.top - '50' + ($(window).scrollTop()),
		//     left: $(window).width() - fav.left - '110',
		// }, "slow", "swing");

		// $('#fav_'+id).animate({
		//     top: '42',
		//     left: '-38',
		// }, "fast", "swing");
		// $('#fav_'+id).offset({ top: '42', left: '-38'});

		$('#fav_'+id).fadeTo(1000,0.30, function() {
	      	$('#fav_'+id).attr("src",'http://localhost/SC4/resources/views/style/fav_gray.png');
	 	}).fadeTo(500,1);

    }

    function fav_gray(id) {

    	var fav = $('#fav_'+id).offset(); 

		// $('#fav_'+id).animate({
		//     top: $(window).height() - fav.top - '50' + ($(window).scrollTop()),
		//     left: $(window).width() - fav.left - '110',
		// }, "slow", "swing");

		
			// $('#fav_'+id).show().animate({ top: 305 }, {duration: 1000, easing: 'easeOutBounce'});

			// $('#fav_'+id).animate({
			//     top: '42',
			//     left: '-38',
			// }, "fast", "swing");
			// $('#fav_'+id).offset({ top: '42', left: '-38'});

			$('#fav_'+id).fadeTo(1000,0.30, function() {
		      	$('#fav_'+id).attr("src",'http://localhost/SC4/resources/views/style/fav_red.png');
		 	}).fadeTo(500,1);


    }

    // function no_fav(id) {
         
    //     $('#fav_'+id).attr('src','http://localhost/SC4/resources/views/style/fav_red.png');
    //     $('#no_fav_'+id).attr('src','http://localhost/SC4/resources/views/style/fav_gray.png');
    // }

    // function badDeal(id) {
                
    //     $('#good_'+id).attr('src','style/good_gray.png');
    //     $('#bad_'+id).attr('src','style/bad.png');
    // }


   //  function isNumberKey(evt) {
   //   var charCode = (evt.which) ? evt.which : event.keyCode
   //   if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
   //       return false;
   //   else {
   //       var len = document.getElementById("txtChar").value.length;
   //       var index = document.getElementById("txtChar").value.indexOf('.');
         
   //       if (index > 0 && charCode == 46) {
   //           return false;
   //       }
   //       if (index > 0) {
   //           var CharAfterdot = (len + 1) - index;
   //           if (CharAfterdot > 3) {
   //               return false;
   //           }
   //       }

   //   }
   //   return true;
  	// }

  	function isNumberKey(evt,id) {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
         return false;
     else {
         var len = document.getElementById(id).value.length;
         var index = document.getElementById(id).value.indexOf('.');
         
         if (index > 0 && charCode == 46) {
             return false;
         }
         if (index > 0) {
             var CharAfterdot = (len + 1) - index;
             if (CharAfterdot > 3) {
                 return false;
             }
         }

     }
     return true;
  	}
  	
	function ellipsify (str) {
	    if (str.length > 10) {
	        return (str.substring(0, 10) + "...");
	    }
	    else {
	        return str;
	    }
	}

	jQuery(document).ready(function($) {

		var stickyHeaderTop = $('#ul').offset().top;
		$(window).scroll(function(){
			if( $(window).scrollTop() > stickyHeaderTop ) {
				$('#ul').css({position: 'fixed', top: '0px', width: '100%'});
		    } else {
		        $('#ul').css({position: 'static', top: '0px'});
		    }
		});

	});



