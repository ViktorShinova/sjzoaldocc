var empSite = {
	start: function() {
		$('[rel=external]').attr('target','_blank');
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
	},
			
	attachCKEditor: function() {
		console.log($("input[name='summary']"));
		if( $("#summary").length) {
			CKEDITOR.replace('summary', {
				toolbar: 'Basic'
			});
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

		$("#company-logo").change(function() {

			var type = 'logo';
			$("#employer-profile").ajaxSubmit({
				url: "/employer/upload_image/" + type,
				type: "post",
				dataType: "json",
				enctype: 'multipart/form-data',
				timeout: 30000,
				success: function(data) {
					console.log(data);
					$('#logo').attr('src', data.src);
				}
			});
		});


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

			job_cat.trigger('change');

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

			job_loc.trigger('change');
		}


	},
	attachCustomTemplate: function() {

		if ($("#custom-template").length) {

			$("#btn-align-right, #btn-align-center, #btn-align-left").click(function() {

				var alignment = $(this).data('value');

				$("#head-text-align").val(alignment);
				$(".notice-header").css({"text-align": alignment});

			});

			$("#head-bg a.btn").click(function() {
				$("#header-background").trigger('click');
			});
			$("#body-bg a.btn").click(function() {
				$("#body-background").trigger('click');
			});
			$("#footer-bg a.btn").click(function() {
				$("#footer-background").trigger('click');
			});

			$('#submit-template').click(function(e) {
				//manual check validation
				
				var trigger_error = function() {
					var msg = '<div class="template-nameformError parentFormcustom-templating formError" style="opacity: 0.87; position: absolute; top: 121px; left: 80px; margin-top: -41px;"><div class="formErrorContent">* This field is required<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>';
					
					if ( $('.template-nameformError').length === 0 ) {
						$('#template-name').before(msg);
					}
					
				}
				
				if ($('#template-name').val().trim() === '') {
					
					$('#tab-container').easytabs('select', '#controlPaneBasics');
					trigger_error();
					return false;
				}
				
				
				
			});

			var types = ['header', 'body', 'footer'];

			$("#header-background").change(function() {
				empSite.upload("header");
			});

			$("#body-background").change(function() {
				empSite.upload("body");
			});

			$("#footer-background").change(function() {
				empSite.upload("footer");
			});


			$.each(types, function(index, item) {
				empSite.backgroundPosition(item);
				empSite.backgroundRepeat(item);
			});


			//$("#toolbar").animate({width: "75px"}, {queue: false, duration: 50});

//            $("#toolbar").mouseenter(function(){
//                $(this).animate({width: "375px"}, {queue: false, duration: 50});
//            }).mouseleave(function(){
//                $(this).animate({width: "75px"}, {queue: false, duration: 50});
//            });                       
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
				//console.log($(this).next());
				$("#" + type + "-background").next("img").fadeIn();
			},
			success: function(data) {
				//console.log(data);
				$("#" + type + "-background").next().fadeOut();

				$(".notice-" + type).css({
					"background-image": "url(/" + data.src + ")",
					"background-repeat": "repeat"
				});

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

		$("#" + type + "-position-tl").click(function() {
			$('.notice-' + type).css({
				"background-position": "top left"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-tr").click(function() {
			$('.notice-' + type).css({
				"background-position": "top right"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-tc").click(function() {
			$('.notice-' + type).css({
				"background-position": "top center"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-bl").click(function() {
			$('.notice-' + type).css({
				"background-position": "bottom left"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-br").click(function() {
			$('.notice-' + type).css({
				"background-position": "bottom right"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-bc").click(function() {
			$('.notice-' + type).css({
				"background-position": "bottom center"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-l").click(function() {
			$('.notice-' + type).css({
				"background-position": "left"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-r").click(function() {
			$('.notice-' + type).css({
				"background-position": "right"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});

		$("#" + type + "-position-c").click(function() {
			$('.notice-' + type).css({
				"background-position": "center"
			});
			$('#' + type + '-position-hidden-field').val($(this).data('value'));
		});
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