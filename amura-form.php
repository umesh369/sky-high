<script async type="text/javascript" data-tag="selldo">
	var formatMoney = function(string, fa_symbol,readable) {
		readable = readable || true;
		fa_symbol = fa_symbol || "fa-rupee";
		regex = /(\d)((\d)(\d{2}?)+)$/;
		var split_at_decimal = string.split(".");
		var s = split_at_decimal[0];
		while (regex.test(s)){
			s = s.replace(regex, '$1' + ',' + '$2');
		}
		if(split_at_decimal.length > 1){
			s = s + "." + split_at_decimal[1];
		}
		if(!readable){
			return '<i class="fa ' + fa_symbol + '"></i> ' + s;
		}
		var split_at_comma = s.split(",");
		var english = "";
		if(split_at_comma.length == 1){ // 123
			english = s;
		}else if(split_at_comma.length == 2){ // 12,345
			english = s;
		}else if(split_at_comma.length == 3){ // 12,34,567
			if(parseInt(split_at_comma[0]) != 0){
				english += split_at_comma[0] + "." + split_at_comma[1] + " lacs";
			}
		}else if(split_at_comma.length == 4){ // 12,34,56,789
			if(parseInt(split_at_comma[0]) != 0){
				english += split_at_comma[0] + "." + split_at_comma[1] + " Cr";
			}
		}else if(split_at_comma.length > 4){ // x,xx,xx,12,34,56,789
			tmp = split_at_comma.slice(0, split_at_comma.length-3);
			if(parseInt(tmp) != 0){
				english += (tmp + "").replace(",", "") + "." + split_at_comma[1] + " Cr";
			}
		}
		return '<i class="fa ' + fa_symbol + '"></i> ' + english;
	}
	var _selldo = [{_async:true}];
	var _selldo = _selldo || [];
	_selldo.push({client_id : "55223a423bb2f8fbd70000e2"});
	_selldo.push({enable_ga_ecommerce : false});
	_selldo.push({api_key : "1428306504"});
	_selldo.push({ctc_api_key : "1428306505"});
	_selldo.push({enable_sell_do_form : true});
	_selldo.push({disable_selldo_tracking : true});
	_selldo.push({form_div_ids : ["form_container"]});

	(function() {
		var selldo = document.createElement('script'); selldo.type = 'text/javascript'; selldo.async = true;
		selldo.src = 'http://cdn.sell.do/assets/tracker.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(selldo, s);
		// console.log(selldo+'dineshselldo');
		// console.log(s+'dineshs');
	})();
	window.sell_do_form_rendered = function(){
		<?php 
		$json = @file_get_contents('http://selldocdn.amura.in/hiranandani_units.json');
		$array = (json_decode($json, true));	
		?>
		var units_url = '<?php echo $array; ?>';
		// console.log(units_url);
		var units_url = '/hiranandani_units.json';
		// var units_url = "http://1.sell.do/hiranandani_units.json";
		var units_data = {};

		function setup_all_fields(){
			// $('[name="sell_do[form][lead][project_id]"]').parent().after("<div class='form-group'><label>Address</label><textarea rows='4' cols='50' name='sell_do[form][address][address1]' class='form-control'></textarea></div>");
			// $('[name="sell_do[form][address][address1]"]').parent().after("<div class='form-group'><div >Occupation</div><br/><input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='company-employee'> Salaried &nbsp; <input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='self-employed'> Self Employed &nbsp; <input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='other'> Professional &nbsp; <input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='retired'> Retired &nbsp;<input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='housewife'> Housewife &nbsp;<input type='radio' name='sell_do[form][lead_profile][professional_details][type]' value='student'> Students &nbsp;</div>");
			// $('[name="sell_do[form][lead_profile][professional_details][type]"]').parent().after("<div class='form-group'><label>Name of Organization</label><input type='text' name='sell_do[form][lead_profile][professional_details][name]' class='form-control'></div>");
			// $('[name="sell_do[form][lead_profile][professional_details][type]"]').parent().after("<div class='form-group'><label>Name of Organization</label><input type='text' name='sell_do[form][lead_profile][professional_details][name]' class='form-control'></div>");
		}
		
	// };
	$.ajax({
			url: units_url,
			dataType: "json",
			type: "GET",
			success: function(one, two, three){
				// remove Project dropdown and add as a hidden field
				$('div.form-group').find('label').each(function(){
					if($(this).text()=='Project'){
						$(this).after("<input type='hidden' name='sell_do[form][lead][project_id]' class='form-control' value='552f7f3c3bb2f824b3000177' />");
					}
					$(this).hide();
				});

				units_data = one;
				setup_all_fields();
				var select_field = "<select class='form-control' name='sell_do[form][lead][unit_configuration_id]'></select>";
				
				$('[name="sell_do[form][lead][project_id]"]').parent().after('<div class="form-group">' +  select_field + '<span class="cost unit_configuration_cost" style="display:none;"></span></div>');
				// $('[name="sell_do[form][lead][project_id]"]').change(function(){
					var html = "<option value=''>Select Unit configuration</option>";

					// project value is added manually for property specific page
					// var data = units_data[$(this).val()];
					// var propertyName = 'Bayview';
					var tower_id = '';
					var data = units_data['552f7f3c3bb2f824b3000177'];

					if(typeof data !== "undefined"){
						for(i=0;i<data.length;i++){
							// filter unwanted properties from dropdown
							var str = data[i].tower_id;
							if(str == tower_id){
								html += "<option data-cost='" + data[i].cost + "' value='" + data[i].id + "'>" + data[i].name + "</option>";
							}
							
						}
						$('[name="sell_do[form][lead][unit_configuration_id]"]').html(html);
						$('[name="sell_do[form][lead][unit_configuration_id]"]').val("");
						$('[name="sell_do[form][lead][unit_configuration_id]"]').removeAttr("required");
						if($('[name="sell_do[form][lead][project_id]"]').val() == ""){
							$('[name="sell_do[form][lead][unit_configuration_id]"]').closest(".form-group").hide();
						}else{
							// $('[name="sell_do[form][lead][unit_configuration_id]"]').closest(".form-group").show();
							// $('[name="sell_do[form][lead][unit_configuration_id]"]').attr("required", "required");
						}
					}else{
						$('[name="sell_do[form][lead][unit_configuration_id]"]').closest(".form-group").hide();
					}
				// });
				$('[name="sell_do[form][lead][unit_configuration_id]"]').change(function(){
					if($(this).val() != ""){
						$(".unit_configuration_cost").show();
						$(".unit_configuration_cost").html("Cost: Rs. " + formatMoney($(this).find("option:selected").attr("data-cost")));
					}else{
						$(".unit_configuration_cost").hide();
					}
				});

				$('[name="sell_do[form][lead][unit_configuration_id]"]').hide();
				// form UI changes
				jQuery('input[type="text"][name="sell_do[form][lead][name]"]').attr("placeholder", "Name*");
				jQuery('input[type="text"][name="sell_do[form][lead][email]"]').attr("placeholder", "Email*");
				jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').attr("placeholder", "Mobile No.*");
				jQuery('textarea[name="sell_do[form][note][content]"]').attr("placeholder", "Query");

				jQuery(".sell_do_form_container .title").text("");
				jQuery(".sell_do_form_container .title").append("<h3>Enquiry Form</h3>");
				// jQuery(".btn").val("ENQUIRE NOW");
			},
			error: function(one, two, three){
				console.log(two);
			}
		});
	};
	window.sell_do_form_submitted = function(data, event){
		// console.log(data+'sell_do_form_submitted_data');
		// console.log(event+'sell_do_form_submitted_event');
		// This function is called after sell.do form has been submitted and validations done. 
		// Its called just before the data is sent to sell.do servers
		// form-data is available at event.data. for example {sell_do[form][budget]: "10000000-12500000", sell_do[form][comments]: "Test", sell_do[form][email]: "foo@sell.do", sell_do[form][name]: "John Doe", sell_do[form][phone]: "1234567890", sell_do[form][project_id]: "some-sell-do-random-number-you-need-not-worry"}
		try{
			dataLayer.push({
				'event' : 'selldo_form_submitted'
			});
		}catch(err){}
	};
	window.sell_do_form_successfully_submitted = function(data, event){

		// fetch values from data object, get the page URL with UTM parameters
		console.log(data);
		var arr = Object.keys(data).map(function (key) {return data[key]});
		// console.log(arr+'sell_do_form_successfully_submitted_arr');
		var url = '<?php echo $destUrl;  ?>'; 
		data.pageURL = url;
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			var device = 'mobile_landing_amura';
		}else{
			var device = 'landing_amura';	
		}
		
		data.uniqueDevice = device;
		var project_id_custom = '552f7f3c3bb2f824b3000177';
		data.project_id = project_id_custom;
		var countryClass = jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').attr('class');
		if(countryClass === undefined){
			//Class is not found
		}else{
			// class is found
			var country = countryClass.split(' ')[1];
			data.countryCode = country;
		}
		// post data and insert into database 
		jQuery.post('../shared/amura-1.php',data,function(response){
			// console.log('test'+'sell_do_form_successfully_submitted');
			// redirect to thank you page
			console.log(response);
			if(response){
				jQuery('.sell_do_verify_btn').click(function(){
					setTimeout(function(){console.log("Do seconds"); myFun(response);}, 2000);
				});
				if(jQuery('div.thankyou').hasClass('thankyou')){
					// console.log("Waahhh Bete");
					window.location.replace(response);
				}else{
					// console.log("Dimag laga");
				}

			}
			function myFun(response){
				if(jQuery('div.thankyou').hasClass('thankyou')){
					// console.log("Waahhh Bete");
					window.location.replace(response);
				}else{
					// console.log("Dimag laga");
				}
				
				/*var htmlValue = jQuery('div.thankyou').html();
				alert(htmlValue);*/
			    // do something
			// });
			}
		});
		// This function is called after sell.do has done its magic - all your data is captured and saved for your sales teams.
		// This is a safe place to write your redirects, thankyou messages, pixel tracking codes in here.
		// IMPORTANT: the only difference in this function is that event.data.lead_id is present and it equals the sell.do lead_id
	};
	
</script>
<script type="text/javascript">
jQuery(window).load(function(){
	// alert();
		var btnVal = jQuery('.btn').val();
		if(btnVal=="Register"){
			jQuery('.btn').val('ENQUIRE NOW');
		}

	var dropDownName = 'sell_do[form][lead][project_id]';
	var value0 = '552f7f3c3bb2f824b3000177';
	var value1 = '552f72ef541385e5530004e7';
	var value2 = '552f96573bb2f8e5580000f1';
	var value3 = '552f6b3d3bb2f8951400043c';
	var value4 = '552f641b3bb2f86d1f000406';
	jQuery('select[name="'+dropDownName+'"]').remove();
	// jQuery('select[name="'+dropDownName+'"] option[value="'+value0+'"]').remove();
	jQuery('select[name="'+dropDownName+'"] option[value="'+value1+'"]').remove();
	jQuery('select[name="'+dropDownName+'"] option[value="'+value2+'"]').remove();
	jQuery('select[name="'+dropDownName+'"] option[value="'+value3+'"]').remove();
	jQuery('select[name="'+dropDownName+'"] option[value="'+value4+'"]').remove();

	var propertyValue = jQuery('select[name="sell_do[form][lead][unit_configuration_id]"]')
	
	setTimeout(function(){
		jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').removeAttr("placeholder");
	}, 1500);

	jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focusout(function(){
		setTimeout(function(){
			jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').removeAttr("placeholder");
		}, 100);
	});
	jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').keyup(function(){
	if(jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val()==''){
	jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').removeAttr("placeholder");
	}
	});
	// Disclaimer
	jQuery('.selldo-intl-tel-input').append('<p><strong>Country code should not be deleted</strong></p>');
	jQuery('.selldo-intl-tel-input p').addClass('tel-HvrTxt');
	jQuery('.selldo-intl-tel-input p').hide();
	jQuery('.selldo-intl-tel-input input').mouseenter(function(){
		jQuery('.selldo-intl-tel-input p.tel-HvrTxt').show();
	});
	jQuery('.selldo-intl-tel-input input').mouseleave(function(){
		jQuery('.selldo-intl-tel-input p.tel-HvrTxt').hide();
	});
	jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focus(function(){
		jQuery('.selldo-intl-tel-input').find('p').removeClass('tel-HvrTxt');
		jQuery('.selldo-intl-tel-input').find('p').addClass('tel-HvrTxt2');
		jQuery('.tel-HvrTxt2').show();
	});
	jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focusout(function(){
		jQuery('.tel-HvrTxt2').hide();
		jQuery('.selldo-intl-tel-input').find('p').removeClass('tel-HvrTxt2');
		jQuery('.selldo-intl-tel-input').find('p').addClass('tel-HvrTxt');
	});
	//Disclaimer



/*Mobile No. Place Holder */
  jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val('+91');
  jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focusout(function(){
    if(jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val()=='+91'){
      // jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').removeAttr("placeholder");
      jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val('+91');
    }
  });
  jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focus(function(){
    console.log(jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val());
  });
  jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').focusout(function(){
    setTimeout(function(){
      console.log(jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val());
      if(jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val()==''){
        // jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').removeAttr("placeholder");
        jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val('+1');
        var getClass = jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').attr('class');
        console.log(getClass);
        var country = getClass.split(' ')[1];
        console.log(country);
        jQuery('.form-group .selldo-intl-tel-input .flag-container ul.country-list').find('li').each(function(){
          var getAttr = jQuery(this).attr('data-country-code');
          if(getAttr==country){
            // alert(getAttr);
            var getDialCode = jQuery(this).attr('data-dial-code');
            jQuery('input[type="text"][name="sell_do[form][lead][phone]"]').val('+'+getDialCode);
          }
        });
        // data.countryCode = country;  
      }
    }, 100);
  });
/*Mobile No. Place Holder */


});
function get_country(a,b,c){

	// alert(c);

	jQuery(".country-list").find("li").each(function(){
		if(jQuery(this).attr("data-dial-code") == a){
		   jQuery(this).addClass("active"); 
		   jQuery(this).trigger("click");
		   jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag').attr('title', c);
			jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').removeClass('in');
			jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').addClass(b);
			return;
		}else{
		  jQuery(this).removeClass("active"); 
		}

		});
	// jQuery('.selldo-intl-tel-input input').focus(function(){
	// 	if(jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').hasClass(b)){
	// 		jQuery(this).val('+'+a);
	// 	}
	// });
	jQuery('.selldo-intl-tel-input input').focusout(function(){
		if(jQuery('.form-group .selldo-intl-tel-input .flag-container .selected-flag .selldo-iti-flag').hasClass(b)){

			var max_length = a.length + 1;
			
			var ip_len = jQuery(this).val();

			if(ip_len.length <= max_length){
				jQuery(this).val('');
			}
		}
	});
}
</script>