$(function () {
    // Date Validation
    $.validator.addMethod('above18', function (value, element) {
        var myDate = document.regForm.dob.value;
        var d = new Date();
        var date = d.getTime();
        var msec = Date.parse(myDate);
        var substraction = date - msec;
        var eighteen = 18 * 365 * 24 * 60 * 60 * 1000;
        return substraction >= eighteen;
    }, "<i class='fa fa-ban' aria-hidden='true'> Age must be above 18 years.</i>");


    $.validator.addMethod('strongPassword', function (value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-zA-Z]).{6,20}$/.test(value);
    }, "<i class='fa fa-ban' aria-hidden='true'> Password must contain the following:<ul> <li>Between 6 to 20 characters long;</li><li>At least one numeric digit;</li><li>At least one alphabet.</li></ul></i>");

    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "<i class='fa fa-ban' aria-hidden='true'> Letters Only please</i>");

    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "<i class='fa fa-ban' aria-hidden='true'> No white space</i>");
    //------------------------ Log In Start------------------------//

    $("form[name='myForm']").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Email Address required</i>",
                email: "<i class='fa fa-ban' aria-hidden='true'> Invalid email address</i>"
            },
            password: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Password required</i>"
            }

        },
        submitHandler: function (form) {
            form.submit();
        }

    });



    //------------------------ Log In End ------------------------//





    //------------------------ Registration Start------------------------//

    $("form[name='regForm']").validate({
        rules: {
            firstname: {
                required: true,
                nowhitespace: true,
                lettersonly: true
            },
            lastname: {
                required: true,
                nowhitespace: true,
                lettersonly: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                strongPassword: true
            },
            confpass: {
                required: true,
                equalTo: "#reg_pass"
            },
            country: {
                required: true
            },
            gender: {
                required: true
            },
            dob: {
                required: true,
                above18: true
            }
        },
        messages: {
            firstname: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Firstname required</i>"
            },
            lastname: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Lastname required</i>"
            },
            email: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Email address required</i>",
                email: "<i class='fa fa-ban' aria-hidden='true'> Invalid email address</i>"
            },
            password: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Password required</i>"
            },
            confpass: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Please confirm password</i>"
            },
            dob: {
                required: "<i class='fa fa-ban' aria-hidden='true'> Date is required</i>"
            }

        },
        submitHandler: function (form) {
            form.submit();
        }

    });




    //------------------------ Registration End ------------------------//



});
