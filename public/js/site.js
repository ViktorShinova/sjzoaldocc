var jSite = {
	start: function() {

		jSite.searchPullDown();

		jSite.attachPaymentChange();
		jSite.attachPopup();
		jSite.attachApplyJob();
		jSite.attachToggleShortList();
		jSite.attachValidation();
		jSite.attachApplicant();
		jSite.attachJobPostSelectChange();
		jSite.attachEasyTabs();
		jSite.attachSearchFilterCheckbox();
		jSite.attachToolTip();
		//jSite.attachRemoveItems();
		//jSite.attachPrivacySettings();
		//jSite.attachResumeVisibility();
		jSite.attachSalaryChange();
		jSite.attachSwitchToggle();
		jSite.attachAccordion();

		//jSite.attachGetShortlistTags();

		if ($("[rel=popover]").length) {
			$("[rel=popover]").popover();
		}


	},
			
	attachSwitchToggle: function() {
		if ($('#privacy-switch').length) {
			$('#privacy-switch').on('switch-change', function (e, data) {
				var value = data.value;
				var formData = 'privacy=' + value;
				$.ajax({
					url: '/applicant/privacy/',
					type: 'post',
					dataType: 'json',
					data: formData,
					success: function( data ) {
						
						if( data.success ) {
							console.log( value );
							if( value ) {
								
								$("#profile-switch .alert").fadeIn();
								
							} else {
								$("#profile-switch .alert").fadeOut();
							}
						}
						
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
	attachApplyJob: function() {


//		//Select coverletter

		$("#cover-write").click(function(e) {
			e.preventDefault();
			$('#write-coverletter').show();
			$("#drop-coverletter").html($(this).html() + ' <b class="caret"></b>');

		});

		$(".cover-btn").click(function(e) {
			e.preventDefault();
			$("#add-coverletter-to-account").hide();
			$('#write-coverletter').hide();
			$("#drop-coverletter").html($(this).html() + ' <b class="caret"></b>');

			$("#select-coverletter").val($(this).data('value'));

		});

		$("#upload-coverletter-link").click(function(e) {
			e.preventDefault();
			$("#add-coverletter-to-account").show();
			$("#upload-coverletter:hidden").trigger('click');
			$("#upload-coverletter:hidden").change(function() {
				var filename = $(this).val().split('\\').pop();
				$('#drop-coverletter').html(filename + ' <b class="caret"></b>');
			});
		});

		//Select Coverletter

		$(".resume-btn").click(function(e) {
			e.preventDefault();
			$("#add-resume-to-account").hide();
			$("#drop-resume").html($(this).html() + ' <b class="caret"></b>');
			$("#select-resume").val($(this).data('value'));

		});

		$("#upload-resume-link").click(function(e) {
			e.preventDefault();
			$("#add-resume-to-account").show();
			$("#upload-resume:hidden").trigger('click');
			$("#upload-resume:hidden").change(function() {
				var filename = $(this).val().split('\\').pop();
				$('#drop-resume').html(filename + ' <b class="caret"></b>');
			});
		});

	},
	attachToggleShortList: function() {

		$(".shortlist-btn").click(function(e) {
			//var t = this;
			e.preventDefault();

			is_active = false;
			if ($(this).hasClass('active')) {
				is_active = true;
			}
			var btn = $(this),
			shortlist_tags = $(this).parent().siblings('.shortlist-tag'),
			article_id = $(this).data('job-id');

			if (!is_active) {
				$.ajax({
					type: "POST",
					url: "/job/shortlist/" + article_id + "/" + "insert",
					success: function(data) {

						_data = $.parseJSON(data);
						if (_data.success) {
							
							if( btn.hasClass('apply')) {
								btn.html('<i class="icon-bookmark"></i> Shortlisted');
							} else {
								btn.html('Shortlisted<i class="icon-bookmark"></i>');
							}
							
							
							btn.addClass('active');
							shortlist_tags.addClass('active');
							

						} else {
							console.log(data);
							alert(data.message);
						}

					}
				});
			} else {
				$.ajax({
					type: "POST",
					url: "/job/shortlist/" + article_id + "/" + "delete",
					success: function(data) {
						_data = $.parseJSON(data);
						if (_data.success) {
							
								
							if( btn.hasClass('apply')) {
								btn.html('<i class="icon-bookmark"></i> Shortlist it!');
							} else {
								btn.html('Shortlist<i class="icon-bookmark"></i>');
							}
							
							
							btn.removeClass('active');
							shortlist_tags.removeClass('active');
						} else {
							console.log(data);
							alert(data.message);
						}
					}
				});
			}

		});
	},
//	attachInsertJobtoShortlist: function() {
//		// Why do you need this again? this can be done below...You are looping thru the DOM to get all the li input to stop propagation. Why not just do it onclick.
////		$('.dropdown-menu li input').click(function(e) {
////			e.stopPropagation();
////		});
//		//inserting job to shortlist tag
//		$("input[name='job_shortlist_category'], label[class='checkbox']").click(function(e) {
//
//			e.stopPropagation();
//			//You are clicking this input. So why do you need to check if that is checked? and again, why are u using input[name='job_shortlist_category'] again here? it references the whole DOM.. 
////			var seletedTag = $("input[name='job_shortlist_category']:checked").val();
//			//var articleID = $(".article-id").val();
//			
//			if ( $(this).prop('checked') ) {
//				
//				var radio = $(this);
//				var button = radio.closest('div').children('button');
//				$.ajax({
//					type: "POST",
//					url: "/job/shortlist",
//					daataType: 'json',
//					data: {
//						'chosenTag': radio.val(),
//						'articleID': radio.data('job-id')
//					},
//					success: function(data) { 
//						
//						_data = $.parseJSON(data);
//						
//						if( _data.success ) {
//							//do something
//						} else {
//							alert("Something has gone wrong. Please contact the site admin immediately at techsupport@careershire.com.au");
//						}
//					}
//				});
//				
//				
//			}
//			
//		});
//	},
// Your version
//	attachShortList: function() {
//
//		$(".shortlist-btn").click(function() {
//			var t = this;
//			var articleID = $(this).data('job-id');
//			$.ajax({
//				type: "POST",
//				url: "/job/load_shortlist_category",
//				data: {
//					'article-id': articleID
//				},
//				beforeSend: function() {
//					$(t).siblings(".dropdown-menu").html('<p style="text-align:center;">loading...</p>');
//				},
//				complete: function() {},
//				success: function(data) {
//					$(t).siblings(".dropdown-menu").html(data);
//					jSite.attachInsertJobtoShortlist(articleID);
//				}
//			});
//		});
//
//		if($("#ajaxget_tag_handler").length) {
//			jSite.attachGetShortlistTags();
//		}
//
//		jSite.attachInsertJobtoShortlist($(".article-id").val());
//		
//		if ($("#shortlistings li").size() > 0) {
//			$('.empty').remove();
//			$("#shortlistings").carouFredSel({
//				auto: false,
//				height: 55,
//				items: {
//					visible: 5,
//					height: 55,
//					width: 185
//				},
//				next: "#shortlistings-next",
//				prev: "#shortlistings-prev",
//				width: 930
//			});
//		} else {
//			$("#shortlistings, #shortlistings-prev, #shortlistings-next").remove();
//			$("#footer-toolbar .container").append('<div class="empty">You have no shortlisted jobs.</div>');
//		}
//
//		$("#toggler").toggle(
//				function() {
//					$("#footer-toolbar").animate({
//						width: "51px"
//					}, {
//						queue: false,
//						duration: 50
//					});
//					$(".toolbar-btn, #shortlistings, #shortlistings-prev, #shortlistings-next, #footer-toolbar .empty").hide();
//					$("#toggler").show();
//				},
//				function() {
//					$("#footer-toolbar").animate({
//						width: "100%"
//					}, {
//						queue: false,
//						duration: 50
//					});
//					$(".toolbar-btn, #shortlistings, #shortlistings-prev, #shortlistings-next, #footer-toolbar .empty").show();
//				}
//		);
//
//		if ($("body").height() < $(window).height()) {
//			$("#footer-toolbar").css("margin-bottom", "190px");
//		}
//
//		$(window).scroll(function() {
//			if (document.body.scrollHeight - $(this).scrollTop() <= $(this).height()) {
//				$("#footer-toolbar").css("margin-bottom", $("#footer").height() + 45);
//			} else {
//				$("#footer-toolbar").css("margin-bottom", "0px");
//			}
//		});
//	},
//	attachInsertJobtoShortlist: function(articleID) {
//
//		$('.dropdown-menu li input').click(function(e) {
//			e.stopPropagation();
//		});
//
//		//inserting job to shortlist tag
//		$("input[name='job_shortlist_category']").click(function() {
//
//			var seletedTag = $("input[name='job_shortlist_category']:checked").val();
//			//var articleID = $(".article-id").val();
//			$.ajax({
//				type: "POST",
//				url: "/job/set_shortlist",
//				data: {
//					'chosenTag': seletedTag,
//					'articleID': articleID
//				},
//				success: function(data) { alert('Saved to shortlist'); }
//			});
//		});
//	},
//	attachGetShortlistTags: function() {
//		
//		if($("#ajaxget_tag_handler").length) {
//			jSite.tags('ajaxget_tag_handler', '/job/shortlist_tag', '/job/update_shortlist_tag');
//		}
//	},
	// attachGetExpertiseTags: function() {
	// 	jSite.tags('ajaxget_tag_expertise_handler', '/applicant/expertise_tag', '/applicant/update_expertise_tag');
	// },
	// tags: function(handler, getUrl, updateUrl) {
	// 	var tag;
	// 	$.ajax({
	// 		type: "GET",
	// 		url: getUrl,
	// 		success: function(data) {
	// 			tags = $.parseJSON(data);
	// 			if (tags == null) { tags = []; }
	// 			$("#"+handler).tagHandler({
	// 				assignedTags: tags,
	// 				updateURL: updateUrl,
	// 				autoUpdate: true,
	// 				autoComplete: true,
	// 				msgError: "test"
	// 			});
	// 		}
	// 	});
	// },
	attachValidation: function() {

		if ($(".validate-form").length) {

			var form = $(".validate-form");
			form.validationEngine('attach', {scroll: false});
			//check for password field only meant for employer or applicant when they need to change password
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
	},
	attachRemoveQualification: function() {
		if ($('.qremove').length) {

			var remove_btn = $('.qremove');

			remove_btn.click(function() {
				var id = $(this).data('qid');

				$.ajax({
					type: 'GET',
					url: '/applicant/remove_item/' + id + '/' + 'q',
					dataType: 'json',
					success: function(data) {

						if (data.success) {
							$("#qualification-list").html(data.view);
							//We need to attach remove after every refresh of the list because the new list will unlink the click event
							jSite.resetQualificationOnAjaxChange();

							setTimeout(function() {
								$("#qualifications .validation.success").fadeOut();
							}, 3000);
						}
					}
				});

			});
		}
	},
	attachQualificationEdit: function() {

		if ($('.qedit').length) {

			var edit_btn = $('.qedit');
			var form = edit_btn.closest('form');

			edit_btn.click(function() {
				form.validationEngine('hideAll');
				var id = $(this).data('qid');

				$.ajax({
					type: 'GET',
					url: '/applicant/qualification/' + id + '/',
					dataType: 'json',
					success: function(data) {

						if (data.success) {

							$('#qualification-form #qualification-level').val(data.qualification.level);
							$('#qualification-form #qualification-title').val(data.qualification.title);
							$('#qualification-form #qualification-school').val(data.qualification.institude);
							$('#qualification-form #qualification-field-of-study').val(data.qualification.field_of_study);
							$('#qualification-form #qualification-achievement').val(data.qualification.achievements);
							$('#qualification-form #qualification-started').val(data.qualification.started);
							$('#qualification-form #qualification-ended').val(data.qualification.ended);
							$('#qualification-form #qualification-id').val(id);
							$('#qualification-form').modal('show');

						}
					}
				});

			});

		}

	},
	attachAddQualification: function() {

		$('#add-qualification').click(function(e) {
			$('#qualification-form #qualification-level').val('');
			$('#qualification-form #qualification-title').val('');
			$('#qualification-form #qualification-school').val('');
			$('#qualification-form #qualification-field-of-study').val('');
			$('#qualification-form #qualification-achievement').val('');
			$('#qualification-form #qualification-started').val('');
			$('#qualification-form #qualification-ended').val('');
		});

		$('#btn-qualification-save').click(function(e) {

			if (!$('#applicant-qualifications').validationEngine('validate')) {
				return false;
			}
			e.preventDefault();
			var form = $(this).closest('form');
			var formData = form.serialize();
			var url = form.attr('action');

			if ($('#qualification-form #qualification-id').val() != '') {
				url = url + '/' + $('#qualification-form #qualification-id').val();
				console.log(url);
			}

			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: formData,
				success: function(data) {
					if (data.success) {
						$("#qualification-list").html(data.view);
						$('#qualification-form').modal('hide');
						//We need to attach remove after every refresh of the list because the new list will unlink the click event
						jSite.resetQualificationOnAjaxChange();
					}
				}
			});
		});
	},
	attachRemoveExperience: function() {
		if ($('.eremove').length) {

			var remove_btn = $('.eremove');

			remove_btn.click(function() {
				var id = $(this).data('eid');

				$.ajax({
					type: 'GET',
					url: '/applicant/remove_item/' + id + '/' + 'e',
					dataType: 'json',
					success: function(data) {

						if (data.success) {
							$("#employment-list").html(data.view);
							//We need to attach remove after every refresh of the list because the new list will unlink the click event
							jSite.resetExperienceOnAjaxChange();

							setTimeout(function() {
								$("#employement .validation.success").fadeOut();
							}, 3000);
						}
					}
				});

			});
		}
	},
	attachExperienceEdit: function() {

		if ($('.eedit').length) {

			var edit_btn = $('.eedit');
			var form = edit_btn.closest('form');

			edit_btn.click(function() {
				var id = $(this).data('eid');
				form.validationEngine('hideAll');
				$.ajax({
					type: 'GET',
					url: '/applicant/experience/' + id + '/',
					dataType: 'json',
					success: function(data) {

						if (data.success) {

							$('#employment-form #employment-name').val(data.experience.company_name);
							$('#employment-form #employment-industry').val(data.experience.industry);
							$('#employment-form #employment-started-month').val(data.experience.started_month);
							$('#employment-form #employment-started-year').val(data.experience.started_year);
							$('#employment-form #employment-ended-month').val(data.experience.ended_month);
							$('#employment-form #employment-ended-year').val(data.experience.ended_year);
							$('#employment-form #employment-scope').val(data.experience.description);
							$('#employment-form #employment-position').val(data.experience.position);
							$('#employment-form #employment-id').val(id);
							$('#employment-form').modal('show');

						}
					}
				});

			});

		}

	},
	attachAddExperience: function() {
		$('#add-employment').click(function(e) {
			$('#employment-form #employment-name').val('');
			$('#employment-form #employment-industry').val('');
			$('#employment-form #employment-started').val('');
			$('#employment-form #employment-ended').val('');
			$('#employment-form #employment-scope').val('');
			$('#employment-form #employment-position').val('');

		});

		$('#btn-employment-save').click(function(e) {

			e.preventDefault();

			if (!$('#applicant-experience').validationEngine('validate')) {
				return false;
			}
			var form = $(this).closest('form');
			var formData = form.serialize();
			var url = form.attr('action');

			if ($('#employment-form #employment-id').val() != '') {
				url = url + '/' + $('#employment-form #employment-id').val();
				console.log(url);
			}

			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: formData,
				success: function(data) {
					if (data.success) {
						$("#employment-list").html(data.view);
						$('#employment-form').modal('hide');
						//We need to attach remove after every refresh of the list because the new list will unlink the click event
						jSite.resetExperienceOnAjaxChange();
					}
				}
			});
		});
	},
	attachAddExpertise: function() {

		if ($('#add-expertise').length) {
			$('#add-expertise').click(function(e) {


				e.preventDefault();
				if (!$('#expertise-add-form').validationEngine('validate')) {
					return false;
				}
				var form = $('#expertise-add-form');
				var formData = form.serialize();

				$.ajax({
					url: form.attr('action'),
					data: formData,
					dataType: 'json',
					type: 'POST',
					success: function(data) {
						if (data.success) {

							$('#expertise-list').html(data.view);
							jSite.resetExpertiseOnAjaxChange();

						} else {
							$("#expertise-list").html(data.view);
							jSite.resetExpertiseOnAjaxChange();

							setTimeout(function() {
								$("#expertise .validation.error").fadeOut();
							}, 3000);
						}
					}

				});

			});
		}
	},
	attachEditExpertise: function() {

		$('.exp-edit').click(function(e) {
			e.preventDefault();

			var value = $(this).data('value');

			$('#expertise-value').val(value);
			$('#prev-expertise-value').val(value);
			$('#expertise-form').modal('show');


			$('#btn-expertise-save').click(function(e) {
				e.preventDefault();
				var url = '/applicant/edit_expertise/';

				var formData = $("#applicant-expertise").serialize();
				console.log(formData);
				$.ajax({
					url: url,
					data: formData,
					type: 'POST',
					dataType: 'json',
					success: function(data) {
						if (data.success) {
							$('#expertise-list').html(data.view);
							$('#expertise-form').modal('hide');
							jSite.resetExpertiseOnAjaxChange();

							setTimeout(function() {
								$("#expertise .validation.success").fadeOut();
							}, 3000);
						}
					}
				});

			});
		});

	},
	attachRemoveExpertise: function() {

		$('.exp-remove').click(function(e) {
			e.preventDefault();

			var value = $(this).data('value');

			var url = '/applicant/delete_expertise/';

			var formData = 'expertise=' + value;

			$.ajax({
				url: url,
				data: formData,
				type: 'POST',
				dataType: 'json',
				success: function(data) {
					if (data.success) {

						console.log(data.view);
						$('#expertise-list').html(data.view);

						setTimeout(function() {
							$("#expertise .validation.success").fadeOut();
						}, 3000);

						jSite.resetExpertiseOnAjaxChange();
					}
				}
			});


		});

	},
	resetQualificationOnAjaxChange: function() {
		jSite.attachRemoveQualification();
		jSite.attachQualificationEdit();
		$('#qualification-form #qualification-id').val('');
	},
	resetExperienceOnAjaxChange: function() {
		jSite.attachRemoveExperience();
		jSite.attachExperienceEdit();
		$('#employment-form #employment-id').val('');

	},
	resetExpertiseOnAjaxChange: function() {

		jSite.attachEditExpertise();
		jSite.attachRemoveExpertise();

	},
	attachApplicant: function() {

		jSite.attachAddQualification();
		//attach all the other events belonging to applicant
		jSite.attachQualificationEdit();
		//Attach the remove click event for initial startup
		jSite.attachRemoveQualification();

		jSite.attachAddExperience();

		jSite.attachExperienceEdit();

		jSite.attachRemoveExperience();

		jSite.attachAddExpertise();

		jSite.attachEditExpertise();

		jSite.attachRemoveExpertise();
		
		if ($("#upload-profile-pic-link").length) {

			$("#upload-profile-pic-link").click(function(e) {
				e.preventDefault();
				$("#upload-profile-pic:hidden").trigger('click');
			});

			$("#upload-profile-pic:hidden").change(function() {
				jSite.uploadProfilePic();
				$("#edit-photo, #crop-profile-pic-btn").show();
			});

			$("#crop-profile-pic-btn").click(function() {
				jSite.croppedProfilePic();
			});
		}

		//upload resume
		if ($("#resume-file").length) {
			$("#add-resume").click(function(e) {
				e.preventDefault();
				$("#resume-file:hidden").trigger('click');
			});
			$("#resume-file:hidden").change(function() {
				jSite.uploadResumeCoverletter('resume');
			});
		}

		//upload coverletter
		if ($("#coverletter-file").length) {
			$("#add-coverletter").click(function(e) {
				e.preventDefault();
				$("#coverletter-file:hidden").trigger('click');
			});
			$("#coverletter-file:hidden").change(function() {
				jSite.uploadResumeCoverletter('coverletter');
			});
		}
		
		jSite.attachRemoveResumeCoverletter();

	},
	
	attachRemoveResumeCoverletter: function() {
		
		var removeFile = function( type ) {
			
			$('#' + type + ' .remove').click( function() {
				var value = $(this).attr('id');
				
				$.ajax( {
					
					type: 'get',
					url: '/applicant/remove/' + type + '/' + value,
					dataType: 'json',
					success: function(data) {
						if(data.success) {
							
							$('.' + type + '-listing').html(data.view);
							
							setTimeout(function() {
								$("#" + type + " .validation.success").fadeOut();
							}, 3000);
						}
					}
					
				});
				
			});
			
		};
				
		if( $('#resume .remove').length ) {
			removeFile('resume');
		}
		
		if ( $('#coverletter .remove').length ) {
			removeFile('coverletter');
		}
		
		
		
	},
//	attachPrivacySettings: function() {
//		$('div.btn-group button').click(function(){
//			//alert($(this).children('input[type="radio"]').val());
//			$(this).children('input[type="radio"]').attr('checked', 'true');
//			//$(this).siblings('input[type="button"]').children('input[type="radio"]').attr('checked', 'false');;
//		});
//	},
	// attachResumeVisibility: function() {
	// 	$('.visibility').click(function() {
	// 		//set to hide
	// 		var v = $(this).attr("id").substring(1);
	// 		var t = $(this).attr("id").charAt(0);
	// 		var setting = $(this).find("i").attr("class");

	// 		switch(setting) {
	// 			case 'icon-eye-open':
	// 				jSite.setVisibility(v, t, this, 1);
	// 				$(this).find('i').removeClass('icon-eye-open').addClass('icon-eye-close');
	// 			break;
	// 			case 'icon-eye-close':
	// 				jSite.setVisibility(v, t, this, 0);
	// 				$(this).find('i').removeClass('icon-eye-close').addClass('icon-eye-open');
	// 			break;
	// 		}

	// 	});
	// },
	// setVisibility: function(iid, type, t, setting) {
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "/applicant/resume_visibility",
	// 		data: {
	// 			'iid': iid,
	// 			'type': type,
	// 			'setting' : setting
	// 		},
	// 		dataType: "json",
	// 		beforeSend: function() {},
	// 		complete: function() {},
	// 		success: function(data) {}
	// 	});
	// },	
	attachToolTip: function() {
		if ($(".tool-tip").length) {
			$(".tool-tip").tooltip();
		}
	},
	uploadResumeCoverletter: function(type) {

		$("#applicant-" + type).ajaxSubmit({
			url: "/applicant/upload_resumecoverletter",
			type: "post",
			data: { 'type': type },
			dataType: "json",
			enctype: 'multipart/form-data',
			timeout: 30000,
			success: function(data) {
				if (data.success) {
					
					$('.' + type + '-listing').html(data.view);
					
					setTimeout(function() {
						$('#'+ type +' .validation.success').fadeOut();
					}, 3000);
					
				} else {
					$('.' + type + '-listing').html(data.view);
					
					setTimeout(function() {
						$('#'+ type + ' .validation.error').fadeOut();
					}, 3000);
				}
				
				jSite.attachRemoveResumeCoverletter();
			}
		});
	},
	uploadProfilePic: function() {

		$("#applicant-account").ajaxSubmit({
			url: "/applicant/upload_profile_pic",
			type: "post",
			dataType: "json",
			enctype: 'multipart/form-data',
			timeout: 30000,
			success: function(data) {
				if (!data.error) {
					$("#crop-profile-pic-btn").show();
					// #profilepic"
					$("#profilepic-preview").attr("src", data.filepath);
					startjcrop();
				} else {
					alert(data.error);
				}

			}
		});
	},
	croppedProfilePic: function() {
		$("#applicant-account").ajaxSubmit({
			url: "/applicant/cropped_profile_pic",
			type: "post",
			dataType: "json",
			enctype: 'multipart/form-data',
			timeout: 30000,
			success: function(data) {
				$("#edit-photo, #crop-profile-pic-btn").hide();
				location.reload();
			}
		});
	},

	attachJobPostSelectChange: function() {
		//Job Category
		if ($("#job-category").length) {

			var job_cat = $('#job-category');

			job_cat.on("change", function() {
				var url = "/home/sub_category/" + $("#job-category").val();

				$.ajax({
					url: url,
					type: "GET",
					datatype: 'html',
					async: true,
					timeout: 30000,
					success: function(data) {
						if (data !== '') {
							$("#job-sub-category").prop('disabled', false);
							$("#job-sub-category").html(data);
						} else {
							var option = "<option value=''>Choose a sub category</option>";
							$("#job-sub-category").html(option);
							$("#job-sub-category").prop('disabled', 'disabled');
						}
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
			var job_loc = $("#job-location");
			job_loc.on("change", function() {
				url = "/home/sub_location/" + $("#job-location").val();

				$.ajax({
					url: url,
					type: "GET",
					datatype: 'html',
					async: true,
					timeout: 30000,
					success: function(data) {
						if (data !== '') {
							$("#job-sub-location").prop('disabled', false);
							$("#job-sub-location").html(data);
						} else {

							var option = "<option value=''>Choose a sub location</option>";
							$("#job-sub-location").html(option);
							$("#job-sub-location").prop('disabled', 'disabled');
						}

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
			});

		}
	},
	
	attachEasyTabs: function() {

		if ($(".tab-container").length) {

			$(".tab-container").easytabs();
			console.log($(".tab-container"));
		}
	},
	attachSearchFilterCheckbox: function() {
		if ($('#cbx-all-work').length) {

			$('#cbx-all-work').click(function() {
				if ($(this).prop('checked'))
					$(this).closest('ul').find('input[type="checkbox"]').prop('checked', true);
				else
					$(this).closest('ul').find('input[type="checkbox"]').prop('checked', false);
			});

		}
	},
	attachPaymentChange: function() {
		if ($('#pay-hourly').length) {

		}
	},
	searchPullDown: function() {
		if ($("#pull-down").length) {

			var openState = "-100px";
			var closeState = "-404px";
			var container = $("#search-wrapper");
			$("#pull-down").click(function() {


				if (container.css('top') == openState) {

					container.animate({'top': closeState});

				}
				else {

					container.animate({'top': openState});
				}

			});

		}
	},
	attachAccordion: function() {
		$('#account-edit').collapse({
			toggle: false
		}).on('show',function (e) {
			$(e.target).parent().find(".icon-chevron-down").removeClass("icon-chevron-down").addClass("icon-chevron-up");
		}).on('hide', function (e) {
			$(e.target).parent().find(".icon-chevron-up").removeClass("icon-chevron-up").addClass("icon-chevron-down");
		});
	}
}


function startjcrop() {
	$('#profilepic-preview').Jcrop({
		setSelect: [0, 0, 150, 150],
		aspectRatio: 1,
		bgColor: 'black',
		bgOpacity: .4,
		//allowResize: false,
		//onChange: showPreview,
		//onSelect: showPreview,
		onSelect: updateCoords
	});
}
function updateCoords(c)
{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}
;

function checkCoords()
{
	if (parseInt($('#w').val()))
		return true;
	alert('Please select a crop region then press submit.');
	return false;
}
;

// function showPreview(coords)
// {
// 	if (parseInt(coords.w) > 0)
// 	{
// 		$('.preview').each(function() {

// 			$(this).parent().width(coords.w * $(this).parent().attr('factor'));
// 			$(this).parent().height(coords.h * $(this).parent().attr('factor'));

// 			var rx = $(this).parent().width() / coords.w;
// 			var ry = $(this).parent().height() / coords.h;

// 			$(this).css({
// 				width: Math.round(rx * $("#edit-photo").width()) + 'px',
// 				height: Math.round(ry * $("#edit-photo").height()) + 'px',
// 				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
// 				marginTop: '-' + Math.round(ry * coords.y) + 'px'
// 			});

// 		});


// 	}
// }

$(document).ready(function() {
	jSite.start();
});