
// **********************************************  custom js file  **************************************************** //

$(document).ready( function () {

    $('#users-table').dataTable( {
	    "aLengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
	    "pageLength": 200,
	    "searching": false, 
	    "info": false
    });
});


$('#login-email, #login-password').keyup(myFunction).keydown(myFunction).focusout(myFunction);

$('.reset-emailfield').keyup(resetField).keydown(resetField).focusout(resetField);

$('.createpass-emailfield, .createpass-passfield, .createpass-cpassfield').keyup(resetPasswordField).keydown(resetPasswordField).focusout(resetPasswordField);

$('#search-user').keyup(searchUser).keyup(searchUser)

$(document).on('click', '#edit-admin', function() {
	var name = $('#admin-name').val(),
	email = $('#admin-email').val(),
	pass = $('#admin-pass').val(),
	cpass = $('#admin-confirm').val(),
	valEmail = false, valPass = false;

	if(pass == "" && cpass == "") {
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
			$(".error-messages").removeClass('hide');
		} else {
			valEmail = true;
			$(".err-icon").html('');
			$(".error-messages").addClass('hide');
		}

		// hit submit button
		if(valEmail) {
			var submit = $("button[type=submit]");
			submit.att('disabled', false);
			submit.click();
		} else {
			$("button[type=submit]").attr('disabled', true);
		}
	} else {
		if(pass == "" || cpass == "") {
			$(".error-messages").removeClass('hide');
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		} else {
			$(".error-messages").addClass('hide');
			// validate email
			if(!validateEmail(email)) {
				valEmail = false;
				$(".error-messages").removeClass('hide');
				$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
			} else {
				valEmail = true;
				$(".error-messages").addClass('hide');
				$(".err-icon").html('');
			}

			// validate password
			if(pass === cpass) {
				$(".err-pass").html('');
				$(".err-cpass").html('');
				if(!validatePassword(pass)) {
					valPass = false;
					$(".error-messages").removeClass('hide');
					$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
				} else {
					$(".error-messages").addClass('hide');
					valPass = true;
					$(".err-pass").html('');
				}
			} else {
				$(".error-messages").removeClass('hide');
				$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
				$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			}

			// hit submit button
			if(valEmail && valPass) {
				$(".error-messages").addClass('hide');
				var submit = $("button[type=submit]");
				submit.attr('disabled', false);
				submit.click();
			} else {
				$(".error-messages").removeClass('hide');
				$("button[type=submit]").attr('disabled', true);
			}
		}
	}
});

$(document).on("click", "#register-btn", function() {
	// create user function validation
	var form = $(".create-userForm"),
	name = $('#create-name').val(),
	email = $('#create-email').val(),
	pass = $('#create-pass').val(),
	cpass = $('#create-confirm').val(),
	url = $('#create-url').val(),
	valEmail = false, valPass = false, valUrl = false;

	form.find('input').each(function() { 
		var val = $(this).val(); 
		if(val == "") { 
			$(".error-messages").removeClass('hide');
			$(this).next().next().html('<i class="fas fa-info-circle" title="This field is required."></i>'); 
		} else {
			$(".error-messages").addClass('hide');
			$(this).next().next().html('');
		}
	}); $('#register-btn').html('Create');

	if(name != "" && email != "" && pass != "" && cpass != "" && url != "") {
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".error-messages").removeClass('hide');
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".error-messages").addClass('hide');
			$(".err-icon").html('');
		}

		// validate password
		if(pass === cpass) {
			$(".error-messages").addClass('hide');
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$(".error-messages").removeClass('hide');
				$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
			} else {
				valPass = true;
				$(".error-messages").addClass('hide');
				$(".err-pass").html('');
			}
		} else {
			$(".error-messages").removeClass('hide');
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		}

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".error-messages").removeClass('hide');
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".error-messages").addClass('hide');
			$(".err-url").html('');
		}

		// hit submit button
		if(valEmail && valPass && valUrl) {
			$(".error-messages").addClass('hide');
			var submit = $("button[type=submit]");
			submit.attr('disabled', false);
			submit.click();
		} else {
			$(".error-messages").removeClass('hide');
			$("button[type=submit]").attr('disabled', true);
		}
	} else {
		if(name == "") {
			$(".error-messages").removeClass('hide');
			$(".err-name").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-name").html('');
			$(".error-messages").addClass('hide');
		}

		if(email == "") {
			$(".error-messages").removeClass('hide');
			$(".err-icon").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-icon").html('');
			$(".error-messages").addClass('hide');
		}

		if(pass == "") {
			$(".error-messages").removeClass('hide');
			$(".err-pass").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-pass").html('');
			$(".error-messages").addClass('hide');
		}

		if(cpass == "") {
			$(".error-messages").removeClass('hide');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-cpass").html('');
			$(".error-messages").addClass('hide');
		}

		if(url == "") {
			$(".error-messages").removeClass('hide');
			$(".err-url").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-url").html('');
			$(".error-messages").addClass('hide');
		}
	}
});

$(document).on("click", "#edit-user-btn", function() {
	// edit user function validation
	var name = $('#edit-name').val(),
	email = $('#edit-email').val(),
	pass = $('#edit-pass').val(),
	cpass = $('#edit-confirm').val(),
	url = $('#edit-url').val(),
	submit = $("#edit-submit"),
	valEmail = false, valPass = false, valUrl = false;

	if(pass != "" && cpass !="") { 
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".error-messages").removeClass('hide');
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".error-messages").addClass('hide');
			$(".err-icon").html('');
		}

		if(pass == cpass) {
			// if passwords are same
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$(".error-messages").removeClass('hide');
				$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
			} else {
				valPass = true;
				$(".error-messages").addClass('hide');
				$(".err-pass").html('');
			} 
		} else { 
			valPass = false;
			$(".error-messages").removeClass('hide');
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		}

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".error-messages").removeClass('hide');
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".error-messages").addClass('hide');
			$(".err-url").html('');
		}
		
		// hit submit button
		if(valEmail && valPass && valUrl) {
			$(".error-messages").addClass('hide');
			submit.attr('disabled', false);
			submit.click();
		} else {
			$(".error-messages").removeClass('hide');
			submit.attr('disabled', true);
		}
		
	} else { 

		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".error-messages").removeClass('hide');
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".error-messages").addClass('hide');
			$(".err-icon").html('');
		} 

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".error-messages").removeClass('hide');
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".error-messages").addClass('hide');
			$(".err-url").html('');
		}

		// hit submit button
		if(valEmail && valUrl) {
			$(".error-messages").addClass('hide');
			submit.attr('disabled', false);
			submit.click();
		} else {
			$(".error-messages").removeClass('hide');
			submit.attr('disabled', true);
		}

	}
});

$(document).on('click', '#add-urlBtn', function() {
	var url = $('#add-url').val();

	// check url
	if(!validateUrl(url)) {
		$('#submit-url').attr('disabled', true);
		$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
	} else {
		$(".err-url").html('');
		$('#submit-url').attr('disabled', false);
		$('#submit-url').click();
	}
});

$(document).on('click', '#reset-pass', function() {
	var email = $('#email').val();

	// check email
	if(!validateEmail(email) || email == "") {
		$("button[type=submit]").attr('disabled', true);
		$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid email."></i>');
		$(".error-messages").removeClass('hide');
	} else {
		$(".err-icon").html('');
		$(".error-messages").addClass('hide');
		$("button[type=submit]").attr('disabled', false);
		$("button[type=submit]").click();
	}
});

$(document).on('click', '#newr-pass', function() {
	var email = $('#email').val(),
	pass = $('#password').val(),
	cpass = $('#password_confirmation').val(),
	valEmail = false, valPass = false;

	if(pass == "" || cpass == "" || email == "") { 
		$(".error-messages").removeClass('hide');
	} else { 
		$(".error-messages").addClass('hide');
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
		} else {
			valEmail = true;
		}

		// validate password
		if(pass == cpass) { 
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$('#password').val('');
				$('#password_confirmation').val('');
			} else {
				valPass = true;
			}
		} else { 
			$('#password').val('');
			$('#password_confirmation').val('');
		}

		// hit submit button
		if(valEmail && valPass) { 
			var submit = $("button[type=submit]");
			$("button[type=submit]").attr('disabled', false);
			submit.click();
		} else {
			if(!valEmail && !valPass) {
				$(".error-messages").removeClass('hide');
				$(".passerror-messages").addClass('hide');
			} else {
				if(!valEmail) {
					$(".error-messages").removeClass('hide');
				} else {
					$(".error-messages").addClass('hide');
				}
				if(!valPass) {
					$(".passerror-messages").removeClass('hide');
				} else {
					$(".passerror-messages").addClass('hide');
				}
			}
			$('#password').val('');
			$('#password_confirmation').val('');
			$("button[type=submit]").attr('disabled', true);
		}
	}
});



// *************************** Basic Functions ****************************** //

function searchUser() { 
	var input, filter, found, table, tbody, tr, td, i, j;
  	input = this.value;
  	filter = input.toUpperCase();
  	table = $('.users-table-body');
  	tbody = table.find('tbody')
  	tr = tbody.find('tr');
  	
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}

function resetField() {
	if($('#email').val() == "") {
		$('#reset-pass').attr('disabled', true);
		$('#reset-pass').addClass('disabled');
	} else {
		$('#reset-pass').attr('disabled', false);
		$('#reset-pass').removeClass('disabled');
	}
}

function resetPasswordField() {
	if($('#email').val() == "" || $('#password').val() == "" || $('#password_confirmation').val() == "") {
		$('#newr-pass').attr('disabled', true);
		$('#newr-pass').addClass('disabled');
	} else {
		$('#newr-pass').attr('disabled', false);
		$('#newr-pass').removeClass('disabled');
	}
}

function myFunction() {
	// login user validation function
	var email = $('#login-email').val(), 
	password = $('#login-password').val(),
	button = $(".btn-login"),
	error = $(".err-icon"),
	errorP = $(".err-pass"),
	valEmail = false, valPass = false;

	if(email != "") {
		if(!validateEmail(email)) {
			valEmail = false;
			error.html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			error.html('');
		}
	} else { error.html(''); }
	if(password != "") {
		if(!validatePassword(password)) {
			valPass = false;
			errorP.html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
		} else {
			valPass = true;
			errorP.html('');
		}
	} else { errorP.html(''); }
	// remove/add disabled property of button
	if(valEmail && valPass) {
		button.attr('disabled', false);
		button.removeClass('disabled');
	} else {
		button.attr('disabled', true);
		button.addClass('disabled');
	}
}

function validateEmail(email) {
	// validate email
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
	// validate weather password has one upper case, lower case, special character and one number inside it and must have minimum length of 8
	var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$&+,:;=?@#|'<>.^*()%!-])[A-Za-z\d$&+,:;=?@#|'<>.^*()%!-]{8,}$/;
    return re.test(password);
}

function validateUrl(url) {
	// validate url 
	var regexp = /((https?\:\/\/)|(www\.))(\S+)(\w{2,4})(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/g;
	if(url.match(regexp)) {
		// is a valid url
		return true;
	} else {
		// not an url
		return false;
	}
}