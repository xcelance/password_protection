
// **********************************************  custom js file  **************************************************** //

$('#login-email, #login-password').keyup(myFunction).keydown(myFunction).focusout(myFunction);

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
		} else {
			valEmail = true;
			$(".err-icon").html('');
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
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		} else {
			// validate email
			if(!validateEmail(email)) {
				valEmail = false;
				$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
			} else {
				valEmail = true;
				$(".err-icon").html('');
			}

			// validate password
			if(pass === cpass) {
				$(".err-pass").html('');
				$(".err-cpass").html('');
				if(!validatePassword(pass)) {
					valPass = false;
					$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
				} else {
					valPass = true;
					$(".err-pass").html('');
				}
			} else {
				$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
				$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			}

			// hit submit button
			if(valEmail && valPass) {
				var submit = $("button[type=submit]");
				submit.attr('disabled', false);
				submit.click();
			} else {
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
			$(this).next().next().html('<i class="fas fa-info-circle" title="This field is required."></i>'); 
		} else {
			$(this).next().next().html('');
		}
	}); $('#register-btn').html('Create');

	if(name != "" && email != "" && pass != "" && cpass != "" && url != "") {
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".err-icon").html('');
		}

		// validate password
		if(pass === cpass) {
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
			} else {
				valPass = true;
				$(".err-pass").html('');
			}
		} else {
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		}

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".err-url").html('');
		}

		// hit submit button
		if(valEmail && valPass && valUrl) {
			var submit = $("button[type=submit]");
			submit.attr('disabled', false);
			submit.click();
		} else {
			$("button[type=submit]").attr('disabled', true);
		}
	} else {
		if(name == "") {
			$(".err-name").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-name").html('');
		}

		if(email == "") {
			$(".err-icon").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-icon").html('');
		}

		if(pass == "") {
			$(".err-pass").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-pass").html('');
		}

		if(cpass == "") {
			$(".err-cpass").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-cpass").html('');
		}

		if(url == "") {
			$(".err-url").html('<i class="fas fa-info-circle" title="This field is required."></i>');
		} else {
			$(".err-url").html('');
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
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".err-icon").html('');
		}

		if(pass == cpass) {
			// if passwords are same
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
			} else {
				valPass = true;
				$(".err-pass").html('');
			} 
		} else { 
			valPass = false;
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		}

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".err-url").html('');
		}
		
		// hit submit button
		if(valEmail && valPass && valUrl) {
			submit.attr('disabled', false);
			submit.click();
		} else {
			submit.attr('disabled', true);
		}
		
	} else { 

		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".err-icon").html('');
		} 

		// validate url
		if(!validateUrl(url)) {
			valUrl = false;
			$(".err-url").html('<i class="fas fa-info-circle" title="Not a valid url."></i>');
		} else {
			valUrl = true;
			$(".err-url").html('');
		}

		// hit submit button
		if(valEmail && valUrl) {
			submit.attr('disabled', false);
			submit.click();
		} else {
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
	} else {
		$(".err-icon").html('');
		$("button[type=submit]").attr('disabled', false);
		$("button[type=submit]").click();
	}
});

$(document).on('click', '#newr-pass', function() {
	var email = $('#email').val(),
	pass = $('#password').val(),
	cpass = $('#password_confirmation').val(),
	valEmail = false, valPass = false;

	if(pass == "" || cpass == "") { 
		$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
	} else { 
		// validate email
		if(!validateEmail(email)) {
			valEmail = false;
			$(".err-icon").html('<i class="fas fa-info-circle" title="Not a valid e-mail format."></i>');
		} else {
			valEmail = true;
			$(".err-icon").html('');
		}

		// validate password
		if(pass == cpass) { 
			$(".err-pass").html('');
			$(".err-cpass").html('');
			if(!validatePassword(pass)) {
				valPass = false;
				$(".err-pass").html('<i class="fas fa-info-circle" title="Minimum 8 characters with one upper, one lower, one special character and one number."></i>');
			} else {
				valPass = true;
				$(".err-pass").html('');
			}
		} else { 
			$(".err-pass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
			$(".err-cpass").html('<i class="fas fa-info-circle" title="Password does not match."></i>');
		}

		// hit submit button
		if(valEmail && valPass) { 
			var submit = $("button[type=submit]");
			$("button[type=submit]").attr('disabled', false);
			submit.click();
		} else {
			$("button[type=submit]").attr('disabled', true);
		}
	}
});



// *************************** Basic Functions ****************************** //

function searchUser() { 
	var input, filter, found, table, tr, td, i, j;
  	input = this.value;
  	filter = input.toUpperCase();
  	table = $('.users-table-body');
  	tr = table.find('tr');
  	
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
	} else {
		button.attr('disabled', true);
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