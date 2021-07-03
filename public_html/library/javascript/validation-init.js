var Script = function () {

    $().ready(function() {
        
        // login form validation
        $("#login_form").validate({
            rules: {
                username: "required",
                password: "required"
            },
                
            messages: {  
                username: "Please enter your username",
                password: "Please enter your password"
            },
        });
        
        // newsletter box form validation
        $("#subform").validate({
            rules: {
                articlename: "required",
                articleemail: "required"
            },
                
            messages: {  
                articlename: "Please enter your fullname",
                articleemail: "Please enter your email"
            },
        });
        
        // validate signup form on keyup and submit
        $("#create_camp").validate({
            rules: {
                camp_title: "required",
                tour: "required",
                sdate: "required",
                edate: "required",
                camp_desc: {
                    required: true,
                    minlength: 10,
                },

                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                //topic: {
                   // required: "#newsletter:checked",
                   // minlength: 2
                //},
                agree: "required"
            },
            messages: {
                camp_title: "Please enter a campaign title",
                tour: "Please select a tournament",
                sdate: "Please select a starting date",
                edate: "Please select an ending date",
                camp_desc: {
                    required: "Please enter a description",
                    minlength: "Your description must consist of at least 10 characters"
                },
                
                /*username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy" */
            }
        });
        // form validation for adding content to your packaged item
        $("#add_pack").validate({
            rules: {
                element: "required",
                game: "required",
                //stadium: "required",
                cont_title: "required",
                adate: "required",
                ldate: "required",
                
                cont_desc: {
                    required: true,
                    minlength: 10,
                },
            },
            messages: { 
                element: "Please select an element",
                game: "Please select a game or event",
                //stadium: "Please select a stadium",
                cont_title: "Please enter a title",
                cont_desc: {
                    required: "Please enter a description or post message",
                    minlength: "Your description must consist of at least 10 characters"
                },
                adate: "Please select an approval date",
                ldate: "Please select a live date",
            }
        });
        
        // form to add content to your saru addtional items
        $("#add_saru").validate({
            rules: {
                saru_element: "required",
                cont_title: "required",
                cont_desc: "required",
                adate: "required",
                ldate: "required",
                
                cont_desc: {
                    required: true,
                    minlength: 10,
                },
            },
            messages: { 
                saru_element: "Please select an element",                
                cont_title: "Please enter a title",
                cont_desc: {
                    required: "Please enter a description or post message",
                    minlength: "Your description must consist of at least 10 characters"
                },
                adate: "Please select an approval date",
                ldate: "Please select a live date",
            }
        });


        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();