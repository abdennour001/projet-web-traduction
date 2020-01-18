$(document).ready(function() {
    $('#signInForm').validate({
        debug: true,
        onsubmit: false,
        submitHandler: function(form) {
            if ($(form).valid())
                form.submit();
            return false;
        },
        errorClass: "text-danger invalid",
        rules : {
            email : {
                required : true,
                email: true,
            },
            password : "required",
        },
        messages : {
            email : {
                required : "Veuillez entrer votre adresse email",
                email : "Votre adresse e-mail doit être au format nom@domaine.com",
            },
            password : "Veuillez entrer votre mot de passe",
        },
        ignore: ".ignore"
    });

    $('#signUpForm').validate({
        debug: true,
        onsubmit: false,
        submitHandler: function(form) {
            if ($(form).valid())
                form.submit();
            return false;
        },
        errorClass: "text-danger invalid",
        rules : {
            nom : "required",
            prenom : "required",
            email : {
                required : true,
                email: true,
            },
            password : {
                required : true,
            },
            passwordRepeat : {
                required : true,
                equalTo : "#password",
            },
            numero : {
                required : true,
            },
            adresse : {
                required : true,
            }
        },
        messages : {
            nom : {
                required : "Veuillez entrer votre nom.",
            },
            prenom : {
                required : "Veuillez entrer votre prenom.",
            },
            email : {
                required : "Veuillez entrer votre adresse email.",
                email : "Votre adresse e-mail doit être au format nom@domaine.com",
            },
            password : {
                required : "Veuillez entrer votre mot de passe.",
            },
            adresse : {
                required : "Veuillez entrer votre adresse.",
            }
        },
        ignore: ".ignore"
    });

    $(window).scroll(() => {
        if($(window).scrollTop() < $(document).height() - 880) {
            $('#sideSocialMediaIcons').fadeIn("slow");
        } else {
            $('#sideSocialMediaIcons').fadeOut("slow");
        }
    });
});
