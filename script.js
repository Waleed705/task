jQuery(document).ready(function($){

    $("#signup").click(function(e) {
        e.preventDefault();
        
        // Get input values
        let fname = $("#name").val();
        let email =  $("#email").val();
        let mpassword = $("#current-password").val();
        let checkbox = $("#checkbox");
        
        // Error message elements
        let nameerror = $("#name-error");
        let emailerror = $("#email-error");
        let passworderror = $("#password-error");
        let checkerror = $("#check-error");
        
        // Clear previous error messages
        nameerror.text('');
        emailerror.text('');
        passworderror.text('');
        checkerror.text('');
        
        // Clear error message when the user starts typing
        $("#name").on('input', function() {
            nameerror.text(''); // Corrected selector
        });
        $("#email").on('input', function() {
            emailerror.text('');
        });
        $("#current-password").on('input', function() {
            passworderror.text('');
        });
        $("#checkbox").on('change', function() {
            checkerror.text('');
        });
        
        // Validate inputs
        if(fname === '') {
            nameerror.text('Name is required').css('color', 'red');
        }
        if(email === '') {
            emailerror.text('Email is required').css('color', 'red');
        }
        if(mpassword === '') {
            passworderror.text('Password is required').css('color', 'red');
        } 
        if(!checkbox.is(':checked')) { // Check if checkbox is not checked
            checkerror.text('You must agree to the terms and conditions').css('color', 'red');
        }
        
        // Prevent form submission if there are errors
        if (nameerror.text() !== '' || emailerror.text() !== '' || passworderror.text() !== '' || checkerror.text() !== '') {
            return false;
        }
    
        let formData = {
            'name' : fname,
            'email' : email,
            'password': mpassword,
            'form' : 'signup',
        }
        $.ajax({
            url: 'db.php',
            type: 'POST',
            data : formData,
            success: function(response){
                response = JSON.parse(response);
                if(response.status == 'success'){
                    window.location.href = response.url;
                } else if( response.status == 'error' ){
                    $("#response").text(response.messages);
                } else {
                    $("#response").text(response);
                }
            },
            error: function(xhr){
                $("#response").text(responseText);
            }

        })
    })
    $("#login").click(function(e){
        e.preventDefault();
        let emailerror = $("#email-error");
        let passworderror = $("#password-error");
        let email = $("#email").val();
        let mpassword = $("#current-password").val();

        emailerror.text('');
        passworderror.text('');
        if(email == ''){
            emailerror.text('Email is required').css('color','red');
            return false;
        }
        if(mpassword === ''){
            passworderror.text('password is required').css('color','red');
            return false;
        }

        if(email == '' || mpassword == ''){
            return false;
        }

        formData = {
            'email' : email,
            'password': mpassword,
            'form' : 'login'
            };
            $.ajax({
                url: 'db.php',
                type: 'POST',
                data : formData,
                success: function(response){
                    response = JSON.parse(response);
                    if(response.status == 'success'){
                        window.location.href = response.url;
                    } else if( response.status == 'error' ){
                        $("#response").text(response.messages);
                    } else {
                        $("#response").text(response);
                    }
                }
        })
    })
    $("#signup2").click(function(e){
        e.preventDefault();
        window.location.href = "http://localhost/task/registration.php"
        
    });
});