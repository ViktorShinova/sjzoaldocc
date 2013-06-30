var header_image;
var header_background_image;

var empSite = {
	start: function() {
		$('[rel=external]').attr('target','_blank');
		empSite.attachColorpicker();
		empSite.attachValidation();
		empSite.attachEmployerPostSelectChange();
		empSite.attachCustomTemplate();
		empSite.attachDeleteTemplate();
		empSite.attachPopup();
		empSite.attachToolTip();
		empSite.attachSelectTemplate();
		empSite.attachEasyTabs();
		empSite.uploadEmployerLogo();
		empSite.attachToolTip();
		empSite.attachApplyButton();
		empSite.attachSalaryChange();
		//empSite.populateSalaryRange();
		empSite.attachPopover();		
		empSite.attachCKEditor();
		empSite.attachPrint();
		empSite.attachBackButton();
		empSite.attachJobDelete();
	},
			
	attachCKEditor: function() {
		console.log($("input[name='summary']"));
		if( $("#summary").length) {
//			CKEDITOR.replace('summary', {
//				toolbar: 'Basic'
//			});
		}
		
		if( $("#desc").length) {
			CKEDITOR.replace('desc', {
				toolbar: 'Full'
			});
		}
		
		
	},
	attachPrint: function() {
		$("#print").click(function (e) {
			console.log('test');
			e.preventDefault();
			window.print();
		});
	},
	attachValidation: function() {

		if ($(".validate-form").length) {

			var form = $(".validate-form");
			form.validationEngine();
			//check for password field only meant for employer or applicant when they need to change password

			//profile
			if ($('#old-password').length) {
				var password_changing = false;

				var attach_password_validation = false;

				$("#old-password, #password, #password_confirmation").blur(function() {

					var old_password = $("#old-password");
					var password = $("#password");
					var password_confirmation = $("#password_confirmation");

					var attach_detach = function() {
						form.validationEngine('detach');
						form.validationEngine();
					}

					if (old_password.val() !== "" || password.val() !== "" || password_confirmation.val() !== "") {
						password_changing = true;
					}
					if (password_changing && !attach_password_validation) {
						old_password.addClass("validate[required]");
						password.addClass("validate[required]");
						password_confirmation.addClass("validate[required]");
						attach_detach();
						attach_password_validation = true;
					}

					if (old_password.val() === "" && password.val() === "" && password_confirmation.val() === "" && attach_password_validation) {
						old_password.removeClass("validate[required]");
						password.removeClass("validate[required]");
						password_confirmation.removeClass("validate[required]");

						if (password_changing && attach_password_validation) {
							attach_detach();
							attach_password_validation = false;
							password_changing = false;
						}
					}
				});
			}
		}
	},
	attachToolTip: function() {
		if ($(".tool-tip").length) {
			$(".tool-tip").tooltip();
		}
		
		if( $('[rel=tooltip]').length ) {
			 $('[rel=tooltip]').tooltip();
		}
	},
	uploadEmployerLogo: function() {
		if( $('#company-logo').length ) {
			
			var attach_event = function() {
				$('.logo').on('click', function(e) {
					e.preventDefault();
					$("#modal-image-target").attr("src", this);
					$('#modal-gallery').modal('show');
				});
			};
			var url = '/employer/upload_image/logo';
			
			$('#company-logo').fileupload({
				url: url,
				dataType: 'json',
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				maxFileSize: 5000000, // 5 MB	
				done: function (e, data) {
					console.log(data);
					if( !data.result.success ) {
						$('#logo-validation').html('<p>'+ data.result.message +'</p>')
						$('#logo-validation').show();
					} else {
						$('#logo-validation').hide();
						var string = "<td><img height='30px' id='logo' src='"+ data.result.src +"' /></td><td>"+ data.result.filename +"</td><td><a class='btn logo' href='"+data.result.src+"'>Preview full size</a></td>";
						var record = $('<tr/>').html(string);

						$('#files').html(record);
						attach_event();
					}
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .bar').css(
						'width',
						progress + '%'
					);
				}
			});
			
			attach_event();

		}
//		$("#company-logo").change(function() {
//
//			var type = 'logo';
//			$("#employer-profile").ajaxSubmit({
//				url: "/employer/upload_image/" + type,
//				type: "post",
//				dataType: "json",
//				enctype: 'multipart/form-data',
//				timeout: 30000,
//				success: function(data) {
//					console.log(data);
//					$('#logo').attr('src', data.src);
//				}
//			});
//		});
	},
	
	

	attachEmployerPostSelectChange: function() {
		//Job Category
		if ($("#job-category").length) {

			job_cat = $('#job-category');

			job_cat.on("change", function() {
				
				url = "/employer/sub_category/" + $("#job-category").val();

				$.ajax({
					url: url,
					type: "GET",
					datatype: 'html',
					async: true,
					timeout: 30000,
					success: function(data) {
						$("#sub-category").html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						console.log(errorThrown);
					}
				});
			});

			//job_cat.trigger('change');

		}
		if ($("#job-location").length) {
			//Location
			//
			job_loc = $("#job-location");
			job_loc.on("change", function() {
				url = "/employer/sub_location/" + $("#job-location").val();

				$.ajax({
					url: url,
					type: "GET",
					datatype: 'html',
					async: true,
					timeout: 30000,
					success: function(data) {
						$("#sub-location").html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						console.log(errorThrown);
					}
				});
			});

			
		}


	},
	attachCustomTemplate: function() {

		if ($("#custom-template").length) {
			
			
			$("#btn-align-right, #btn-align-center, #btn-align-left").click(function() {

				var alignment = $(this).data('value');

				$("#head-text-align").val(alignment);
				$(".notice-header").css({"text-align": alignment});

			});

			$("#head-bg a.btn").click( function() {
				$("#header-background").trigger('click');
			});
			$("#body-bg a.btn").click( function() {
				$("#body-background").trigger('click');
			});
			$("#footer-bg a.btn").click( function() {
				$("#footer-background").trigger('click');
			});
			
			$('#head-image a.btn').click( function() {
				$('#header-image').trigger('click');
			});

			$('#submit-template').click(function(e) {
				//manual check validation
				
				var trigger_error = function() {
					var msg = '<div class="template-nameformError parentFormcustom-templating formError" style="opacity: 0.87; position: absolute; top: 121px; left: 80px; margin-top: -41px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>';
					
					if ( $('.template-nameformError').length === 0 ) {
						$('#template-name').before(msg);
					}
				};
				
				if ($('#template-name').val().trim() === '') {
					
					$('#tab-container').easytabs('select', '#controlPaneBasics');
					trigger_error();
					return false;
				}
			});

			var types = ['header', 'body', 'footer'];
			
			$('#header-image').change( function() {
				empSite.upload('header-image');
			});

			$.each(types, function(index, item) {
				empSite.backgroundPosition(item);
				empSite.backgroundRepeat(item);
				
				$('#' + item + '-background').change(function() {
					empSite.upload(item);
				});
			});
			
			var type = $('input[name=title-type]');
			
			$('#text-title').click( function () {
				$('.title').show();
				$('.image-title').hide();
				$(".notice-header").html('<h1>Sample Heading</h1>');
				if( header_background_image ) {
					$(".notice-header").css({
						"background-image": "url(/" + header_background_image + ")",
					});
				}
				type.val('title');
			});
			
			$('#title-image-header').click( function() {
				$('.title').hide();
				$(".notice-header").remove('h1');
				
				$(".notice-header").css({
					"background-image": "none"
				});
				
				$('.image-title').show();
				if( $(".notice-header img").length ) {
					header_image = $(".notice-header img");
				}
				else if( header_image ) {
					$(".notice-header").html('');
					$(".notice-header").append(header_image);
				}
				type.val('image');
			});  
			
			if( $('#title-image-header').hasClass('active') ) {
				$('#title-image-header').trigger('click');
			}
			if( $('#text-title').hasClass('active') ) {
				$('#text-title').trigger('click');
			}
		}
	},
	upload: function(type) {
		$("#custom-templating").ajaxSubmit({
			url: "/employer/upload_image/" + type,
			type: "post",
			dataType: "json",
			enctype: 'multipart/form-data',
			timeout: 30000,
			beforeSubmit: function() {
				$("#template-" + type + " .loading").fadeIn();
			},
			success: function(data) {
				
				$("#template-" + type + " .loading").fadeOut();
				if(type != 'header-image') {
					
					$(".notice-header").html('<h1>Sample Heading</h1>');
					
					$(".notice-" + type).css({
						"background-image": "url(/" + data.src + ")",
						"background-repeat": "repeat"
					});
					
					if( type == 'header') {
						header_background_image = data.src;
					}
					$('#'+ type + '-background-file').val(data.filename);

				} else {
					
					var img = $('<img/>');
					img.attr('src', data.src);
					img.attr('alt', 'header image');
					
					header_image = img;
					
					$(".notice-header").html('');
					$(".notice-header").append(img);
					
					$('#header-image-file').val(data.filename);
				}
				

			}

		});
	},
	backgroundRepeat: function(type) {
		//header
		//
		if ($('#' + type + '-repeat-n').hasClass('active')) {
			$("#" + type + "-bg-position").css("display", "block");
		}

		$('#' + type + '-repeat').click(function() {
			// $("#" + type + "-bg-position").fadeOut();
			$(".notice-" + type).css({
				"background-repeat": "repeat"
			});
			$('#' + type + '-repeat-hidden-field').val($(this).data('value'));
		});

		$('#' + type + '-repeat-x').click(function() {
			//$("#" + type + "-bg-position").fadeOut();
			$(".notice-" + type).css({
				"background-repeat": "repeat-x"
			});
			$('#' + type + '-repeat-hidden-field').val($(this).data('value'));
		});

		$('#' + type + '-repeat-y').click(function() {
			// $("#" + type + "-bg-position").fadeOut();
			$(".notice-" + type).css({
				"background-repeat": "repeat-y"
			});
			$('#' + type + '-repeat-hidden-field').val($(this).data('value'));
		});

		$('#' + type + '-repeat-n').click(function() {
			//$("#" + type + "-bg-position").fadeIn();
			$(".notice-" + type).css({
				"background-repeat": "no-repeat"
			});
			$('#' + type + '-repeat-hidden-field').val($(this).data('value'));
		});
	},
	backgroundPosition: function(type) {
		//can only do this for no repeat
		$('#' + type + '-position').change( function () {
			$('.notice-' + type).css({
				"background-position": $(this).val()
			});
		});
	},
			
	attachColorpicker: function() {
		//header
		
		if( $('#title-colorpicker').length ) {
		
			$('#title-colorpicker').farbtastic(function(color) {
				$('#title-color').css('background-color', color);
				$('#title-color').val(color);
				$("#content .notice-header h1").css('color', color);
			});

			$('#hbg-colorpicker').farbtastic(function(color) {
				$('#hbg-color').css('background-color', color);
				$('#hbg-color').val(color);
				$("#content .notice-header").css('background-color', color);
			});

			$('#title-color').focusin(function() {
				$('#title-colorpicker').show();
			});
			$('#title-color').focusout(function() {
				$('#title-colorpicker').hide();
			});

			$('#hbg-color').focusin(function() {
				$('#hbg-colorpicker').show();
			});
			$('#hbg-color').focusout(function() {
				$('#hbg-colorpicker').hide();
			});


			//body

			$('#bbg-colorpicker').farbtastic(function(color) {
				$('#bbg-color').css('background-color', color);
				$('#bbg-color').val(color);
				$("#content .notice-body").css('background-color', color);
			});

			$('#bbg-color').focusin(function() {
				$('#bbg-colorpicker').show();
			});
			$('#bbg-color').focusout(function() {
				$('#bbg-colorpicker').hide();
			});

			$('#body-colorpicker').farbtastic(function(color) {
				$('#body-color').css('background-color', color);
				$('#body-color').val(color);
				$("#content .notice-body p").css('color', color);
			});

			$('#bbg-color').focusin(function() {
				$('#bbg-colorpicker').show();
			});
			$('#bbg-color').focusout(function() {
				$('#bbg-colorpicker').hide();
			});

			$('#body-color').focusin(function() {
				$('#body-colorpicker').show();
			});
			$('#body-color').focusout(function() {
				$('#body-colorpicker').hide();
			});

			//footer
			$('#fbg-colorpicker').farbtastic(function(color) {
				$('#fbg-color').css('background-color', color);
				$('#fbg-color').val(color);
				$("#content .notice-footer").css('background-color', color);
			});

			$('#fbg-color').focusin(function() {
				$('#fbg-colorpicker').show();
			});
			$('#fbg-color').focusout(function() {
				$('#fbg-colorpicker').hide();
			});

			$('#footer-colorpicker').farbtastic(function(color) {
				$('#footer-color').css('background-color', color);
				$('#footer-color').val(color);
				$("#content .notice-footer p").css('color', color);
			});

			$('#footer-color').focusin(function() {
				$('#footer-colorpicker').show();
			});
			$('#footer-color').focusout(function() {
				$('#footer-colorpicker').hide();
			});
		}
	},		
	
	attachDeleteTemplate: function() {
		if ($('.template-delete').length) {

			templateDelete = $('.template-delete');

			templateDelete.click(function(e) {
				e.preventDefault();

				$.ajax({
					url: $(this).attr("href"),
					type: "post",
					success: function() {

						location.reload();
					}
				});

			});

		}
	},
	attachPopup: function() {
		if ($('[rel=popup]').length) {
			$('[rel=popup]').click(function(e) {
				e.preventDefault();
				url = $(this).attr("href");
				window.open(url, 'popUpWindow', 'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
			});
		}
		
	},
	
	//For new job post or edit
	attachSelectTemplate: function() {

		if ($("#post-selected-template").length) {

			$(".template-item").click(function() {
				$(this).addClass("selected");
				$(this).siblings().removeClass("selected");
				$("#post-selected-template").val($(this).data('id'));
			});

		}
	},
	attachEasyTabs: function() {

		if ($(".tab-container").length) {
			$(".tab-container").easytabs({
				updateHash: false
			});
		}
	},
	attachApplyButton: function() {

		if ($('#custom-yes').length) {

			$('#custom-yes').click(function() {

				$("#apply-row").removeClass("hidden");

			});

			$('#custom-no').click(function() {
				$("#apply-row").addClass("hidden");
			});
			
			var value = $("input[name=custom-apply-select]:checked").val();
			
			if( value === 'Y' ) {
				$("#apply-row").removeClass("hidden");
			}
			else {
				$("#apply-row").addClass("hidden");
			}
		}

	},
	attachSalaryChange: function() {
		if ($('#min-salary').length) {

			$('#min-salary').change(function() {

				var multiply = 10000;
				var min_value = $(this).val();
				var factor = 2;

				if (min_value !== '0') {
					factor = min_value / multiply;
				}

				//do max value select box
				var options = "";
				for (i = factor + 1; i <= 20; i++) {
					if (i === 20) {
						if (min_value === 0) {

							options += "<option selected='selected' value='" + i * multiply + "'>" + i * 10 + "k+</option>";

						} else {
							options += "<option value='" + i * multiply + "'>" + i * 10 + "k+</option>";

						}
					} else {
						options += "<option value='" + i * multiply + "'>" + i * 10 + "k</option>";
					}
				}
				$('#max-salary').html(options);
				//empSite.populateSalaryRange();
			});

			$('#max-salary').change(function() {
				//empSite.populateSalaryRange();

			});

		}
	},
	populateSalaryRange: function() {

		if ($('#min-salary').length) {

			var min_salary = $('#min-salary').val();
			var max_salary = $('#max-salary').val();

			var range = '$' + min_salary + ' - ' + '$' + max_salary;

			$("#salary-range").val(range);


		}


	},
	attachPopover: function() {
		if($("[rel=popover]").length) {
			$("[rel=popover]").popover({html : true});
			
		}
	},
			
	attachBackButton: function() {
		
		if($("#back-btn").length) {
			$('#back-btn').click(function(e) {
				e.preventDefault();
				window.history.back();
			});
		}

	},
			
	attachJobDelete: function() {
	
		if( $('.job-delete').length ) {
			
			$('.job-delete').click( function(e) {

				e.preventDefault();
				
				var url = $(this).attr('href');

				$('#btn-job-delete').attr('href', '');
				$('#btn-job-delete').attr('href', url);
				$('#job-delete-modal').modal('show');
				
			});
			
		}

	},
	
			
	attachImageHeader: function() {
		
	}
	
}

function salaryMinCheck(field, rules, i, options) {
	var maxValue = $("#max-salary").val();
	if( maxValue === "") {
		return true;
	}
	
	if(parseInt(maxValue) < parseInt(field.val())) {
		return "Minimum value cannot be more than maximum value."
	} 
 	
	console.log(field.val());
}

function salaryMaxCheck(field, rules, i, options) {
	var minValue = $("#min-salary").val();
	if( minValue === "") {
		return true;
	}
	
	if(parseInt(minValue) > parseInt(field.val())) {
		return "Minimum value cannot be more than maximum value."
	} 
}



$('document').ready( function () {
	empSite.start();
});