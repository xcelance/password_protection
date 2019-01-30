// $(document).ready(function() { 

// 	setInterval(function() {
// 		var url = $('.main-url').html();
// 		jQuery.ajax({
// 	        type: "GET",
// 	        url: url+"/getnotification",
// 	        success: function(response) {
// 	        	var noti = $('.get-notification');
// 	        	noti.html('');
// 	        	if(response > 0) { 
// 	        		noti.addClass('reset-notification');
// 	        		noti.html('<h4>'+response+'</h4>')
// 	        	} else { 
// 	        		if(noti.hasClass('reset-notification')) {
// 	        			noti.removeClass('reset-notification');
// 	        		}
// 	        		noti.html('<h4></h4>')
// 	        	}
// 	        }
// 	    });
// 	}, 1500);
// });