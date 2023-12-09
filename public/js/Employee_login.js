$(document).ready(function() {
    setTimeout(function() {
        $(".err-msg").fadeOut();
    }, 2000);
    if ($("#register_employee_form").length > 0) {
        $("#register_employee_form").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                contact: {
                    required: true,
                    digits: true,
                },

                address: {
                    required: true
                },
            }
        });
    }
    $("#register_employee_form").submit(function(e) {
        e.preventDefault();
    
        if ($("#register_employee_form").valid()) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('employee.register')}}",
                type:"post",
                data: $("#register_employee_form").serialize(),
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $("#msg").append('<div class="alert alert-success">Registered Successfully.<br> Wait For the HR approval you will be notified by email with <b>Login Credentials</b> .</div>');
                        $("#register_employee_form")[0].reset();
                    }
                },
                error: function(error) {
                    console.log(error);
                    if (error) {
                        // $("#msg").append('<div class="err-msg animate__animated  animate__fadeInUp alert alert-danger">' +  +
                        //     '</div>');
                    }
                }
            });
        }

    });


});
