


/*
 * ================================================================
 * Form validation and submit actions
 *
 * @param form_object - objects -  if set, validate and submit this form only. Otherwise search for all forms with class .validate-form
 */
function validate_and_submit_forms(form_object)
{
    var forms = (form_object !== undefined && form_object.length > 0) ? form_object : $("form.validate-form");

    // for each form 
    forms.each(function(){

        var this_form = $(this);

        // -------------- onChange of each form field with validation enabled (with class .validate) --------------
        this_form.find(".validate-field").each(function()
        {
            $(this).change(function()
            {
                // first empty any error containers
                $(this).siblings(".alert").fadeOut("fast", function(){ $(this).remove(); });

                // value is not empty, validate it
                if ($(this).val().trim() != "")
                {
                    var validation_message = validate_fields(this_form, $(this));
                    if (validation_message.length > 0)
                    {
                        // if there are errors (not successfull)
                        if (validation_message[0]["message"] !== undefined && validation_message[0]["message"] != "" && validation_message[0]["message"] != "success")
                        {
                            // create error field
                            var error_field_html = '<div class="alert">'+validation_message[0]["message"]+'</div>';
                            $(this).after(error_field_html);
                            $(this).siblings(".alert").fadeIn("fast");
                        }
                        // end: if there are errors
                    }
                }
                // end: if value is not empty
            });
        });
        // -------------- end: onChange of each form field --------------

        // -------------- reload captcha --------------
        this_form.find("#form-captcha-refresh").click(function() {
            reset_captcha(this_form);
        });

        // -------------- on Submit of form --------------
        this_form.submit(function(event)
        {
            event.preventDefault ? event.preventDefault() : event.returnValue = false; // stop default action (will be handled via AJAX below)

            // show form loader
            $(this).find(".form-loader").fadeIn("fast");

            var form_action = $(this).attr("action");
            // if action is not set (URL to mail.php), stop form action
            if (form_action === undefined && form_action == "") return false;

            // clear all errors
            $(this).find(".alert").fadeOut("fast", function(){ $(this).remove(); });
            $(this).find(".form-general-error-container").fadeOut("fast", function(){ $(this).empty(); });

            var errors_found = false;

            // for each field with validation enabled (with class .validate)
            $(this).find(".validate-field").each(function()
            {
                var validation_message = validate_fields(this_form, $(this));
                if (validation_message.length > 0)
                {
                    // if there are errors (not successfull)
                    if (validation_message[0]["message"] !== undefined && validation_message[0]["message"] != "" && validation_message[0]["message"] != "success")
                    {
                        // create error field
                        var error_field_html = '<div class="alert">'+validation_message[0]["message"]+'</div>';
                        $(this).after(error_field_html);
                        $(this).siblings(".alert").fadeIn("fast");

                        errors_found = true;
                    }
                    // end: if there are errors
                }               
            });
            // end: for each field

            // if errors were found, stop form from being submitted
            if (errors_found == true) 
            {
                // hide loader
                $(this).find(".form-loader").fadeOut("fast");
                return false;
            }

            // submit form
            $.ajax({
                type: 'POST',
                url: form_action,
                data: $(this).serialize(),
                dataType: 'html',
                success: function (data) 
                {
                    // if form submission was processed (successfully or not)

                    // hide loader
                    this_form.find(".form-loader").fadeOut("fast");

                    var submission_successful = (data == "success") ? true : false;
                    var captcha_success = (data == "captcha") ? false : true;

                    var message = "";
                    switch(data) {
                        case "success":
                            message = "Form submitted successfully.";
                            break;
                        case "captcha":
                            message = "Incorrect text entered. (Case-sensitive)";
                            break;
                        case "incomplete":
                            message = "Please fill in all required fields.";
                            break;
                        case "error":
                            message = "An error occured. Please try again later.";
                            break;
                    }

                    // prepare message to show after form processed
                    var message_field_html = '<div class="alert ';
                    message_field_html += (submission_successful == true) ? 'success' : 'error';
                    message_field_html += '">'+message+'</div>';

                    // incorrect captcha
                    if (!captcha_success) {
                        this_form.find("#form-captcha").parent(".form-group").append(message_field_html);
                        this_form.find("#form-captcha").siblings(".alert").fadeIn("fast");
                    }
                    // general message
                    else {
                        this_form.find(".form-general-error-container").html(message_field_html).fadeIn("fast", function(){
                            // if submission was successful, hide message after some time
                            $(this).delay(10000).fadeOut("fast", function(){ $(this).html(""); });
                        });
                    }

                    // refresh captcha
                    reset_captcha(this_form);

                    // if form submitted successfully, empty fields
                    if (submission_successful == true) this_form.find(".form-control").val("");
                },
                error: function (data) 
                {
                    // if form submission wasn't processed

                    // hide loader
                    this_form.find(".form-loader").fadeOut("fast");

                    // show error message
                    var error_field_html = '<div class="alert">An error occured. Please try again later.</div>';
                    this_form.find(".form-general-error-container").html(error_field_html).fadeIn("fast");

                }
            }); 
            // end: submit form           
        });
        // -------------- end: on Submit of form --------------

    })
    // end: for each form
}

/*
 * ================================================================
 * Reset forms
 *
 * @param form_object - object - required - the form which will be reset
 */
 function reset_forms(form_object)
 {
    // if form exists
    if (form_object !== undefined && form_object.length > 0)
    {
        var form = form_object;
        form.find("input").val('');
        form.find(".alert").remove();
        form.find(".form-general-error-container").empty().hide();
        reset_captcha(form_object);
    }    
 }

/*
 * ================================================================
 * Reset form captchas
 *
 * @param form_object - object - required - the form which will be reset
 */
 function reset_captcha(form_object)
 {
    var forms = (form_object !== undefined && form_object.length > 0) ? form_object : $("form.validate-form");
    // for each form 
    forms.each(function(){
        var this_form = $(this);
        var captcha = this_form.find("#form-captcha-img");
        if (captcha.length > 0 && this_form.is(":visible")) {
            var d = new Date().getTime();
            captcha.replaceWith('<img id="form-captcha-img" src="mail/form_captcha/captcha_img.php?t='+d+'" style="display:none">');
            this_form.find("#form-captcha").val("");
            setTimeout(function() { this_form.find("#form-captcha-img").show(); }, 500);
        }
    });  
 }

/*
 * ================================================================
 * Form validation - separate fields
 *
 * @param form_object - object - required - the form in which the fields relate to
 * @param single_field - object - if set, the function will validate only that particular field. Otherwise the function will validate all the fields with class .validate
 */
 function validate_fields(form_object, single_field)
 {
    // if form exists
    if (form_object !== undefined && form_object.length > 0)
    {
        var form_fields_to_validate = (single_field !== undefined && single_field.length > 0) ? single_field : form_object.find(".validate"); // if single field is set, the function will validate only that particular field. Otherwise the function will validate all the fields with class .validate

        var validation_messages = new Array();

        // for each field to validate
        form_fields_to_validate.each(function()
        {
            var validation_type = $(this).attr("data-validation-type");
            var field_required = $(this).hasClass("required");
            var field_value = $(this).val().trim();

            var single_field_error_details = new Array(); // will contain this field and its error
            single_field_error_details["field_object"] = $(this);
            
            single_field_error_details["message"] = "success"; // default is success. If the above tests fail, replace message with error

            // if field is required and value is empty
            if (field_required == true && (field_value == "" || field_value === null || field_value === undefined)) single_field_error_details["message"] = "This field is required";

            // string validation
            if (validation_type == "string" && (field_value != "" && field_value !== null && field_value !== undefined))
            {
                if (field_value.match(/^[a-z0-9 .\-]+$/i) == null) single_field_error_details["message"] = "Invalid characters found.";
            }

            // email validation
            else if (validation_type == "email" && (field_value != "" && field_value !== null && field_value !== undefined))
            {
                if (field_value.match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/) == null) single_field_error_details["message"] = "Please enter a valid email address";
            }

            // phone validation
            else if (validation_type == "phone" && (field_value != "" && field_value !== null && field_value !== undefined))
            {
                if (field_value.match(/^\(?\+?[\d\(\-\s\)]+$/) == null) single_field_error_details["message"] = "Invalid characters found.";
            }

            validation_messages.push(single_field_error_details); // if none of the above fail, return validation successfull

        });
        // end: for each field to validate

        return validation_messages;
    }
    // end: if form exists
 }

/*
 * ================================================================
 * IE9: Contact Form Fields Placeholders

 *
 * Since IE9 or less browsers do not support "placeholders" for form input fields, set replace "placeholder" value inside the field value.
 */
 function contact_form_IE9_placeholder_fix()
 {
    var forms = $("form");

    // for each form 
    forms.each(function()
    {
        var this_form = $(this); 

        // for each input field
        $(this).find(".form-control").each(function()
        {
            var field_placeholder = $(this).attr("placeholder");
            // if a placeholder is set
            if (field_placeholder !== undefined && field_placeholder != "")
            {
                // set default value to input field
                $(this).val(field_placeholder);

                // set an onfocus event to clear input field
                $(this).focus(function() {
                    if ($(this).val() == field_placeholder) $(this).val("");
                });

                // set an onblur event to insert placeholder if field is empty
                $(this).blur(function() {
                    if ($(this).val() == "") $(this).val(field_placeholder);
                });
            }
        });
        // end: for each input field
    });   
 }

$(document).ready(function()
{
    validate_and_submit_forms();
	//reset_forms();
	//reset_captcha();
});

