$(document).ready(function() {
    $('#signInForm').validate({
        debug: false,
        onsubmit: true,
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
        ignore: ".ignore",
        submitHandler: function(form) {
            if ($(form).valid())
                form.submit();
            return false;
        },
    });


    $('#signUpForm').validate({
        debug: false,
        onsubmit: true,
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
            fax : {
                required : true,
            },
            wilaya: {
                required : true,
            },
            commune : {
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
            wilaya: {
                required : "Veuillez entrer votre Wilaya.",
            },
            commune : {
                required : "Veuillez entrer votre Commune.",
            },
            adresse : {
                required : "Veuillez entrer votre adresse.",
            }
        },
        ignore: ".ignore"
    });

    $('#modifierClientForm').validate({
        debug: false,
        onsubmit: true,
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
            numero : {
                required : true,
            },
            fax : {
                required : true,
            },
            wilaya: {
                required : true,
            },
            commune : {
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
            wilaya: {
                required : "Veuillez entrer votre Wilaya.",
            },
            commune : {
                required : "Veuillez entrer votre Commune.",
            },
            adresse : {
                required : "Veuillez entrer votre adresse.",
            }
        },
        ignore: ".ignore"
    });

    $('#modifierTraducteurForm').validate({
        debug: false,
        onsubmit: true,
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
            numero : {
                required : true,
            },
            fax : {
                required : true,
            },
            wilaya: {
                required : true,
            },
            commune : {
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
            wilaya: {
                required : "Veuillez entrer votre Wilaya.",
            },
            commune : {
                required : "Veuillez entrer votre Commune.",
            },
            adresse : {
                required : "Veuillez entrer votre adresse.",
            }
        },
        ignore: ".ignore"
    });

    $('#recruitmentForm').validate({
        debug: false,
        onsubmit: true,
        errorClass: "text-danger invalid",
        rules : {
            cv : {
                required : true,
            },
            ass: {
                required : function (element) {
                    if( $("#checkTraducteur").is(':checked') ) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            },
            langues : {
                required : true,
            }
        },
        messages : {
            cv : {
                required : "Veuillez entrer votre CV.",
            },
            ass: {
                required : "Veuillez entrer votre assermentation.",
            },
            langues: {
                required : "Veuillez entrer vos langues.",
            }
        },
        ignore: ".ignore",
        submitHandler: function(form) {
            if ($(form).valid())
                form.submit();
            return false;
        },
    });

    $('#sendDevisForm').validator();

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    $('#fichier').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('#fichier')[0].files[0].name;
        $(this).next('label').text(file);
    });

    $(window).scroll(() => {
        if($(window).scrollTop() < $(document).height() - 880) {
            $('#sideSocialMediaIcons').fadeIn("slow");
        } else {
            $('#sideSocialMediaIcons').fadeOut("slow");
        }
    });

    $(document).ready(function () {

        $(".item").on("click", function () {
            let item = $( this );
            let hidden = $("#selectedTranslator");
            let checkMark = $('#'+item.attr("data-id"));

            $(".item").each(function (index) {
                $(this).removeClass('checked');
            });

            $(".display-i").each(function (index) {
                $(this).removeClass('display-i');
                $(this).addClass('not-display-i');
            });

            if (! (hidden.attr("value") === item.attr("data-id"))) {
                item.addClass('checked');
                hidden.attr("value", item.attr("data-id"));
                checkMark.removeClass('not-display-i');
                checkMark.addClass('display-i');
            } else {
                item.removeClass('checked');
                hidden.attr("value", "");
                checkMark.removeClass('display-i');
                checkMark.addClass('not-display-i');
            }

            terminer.disabled = hidden.attr("value") === "";
        })
    });

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

});
