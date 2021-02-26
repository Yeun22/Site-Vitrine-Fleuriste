$(function(){



    $('.navbar-nav a').on('click', function(event){

        event.preventDefault();
        let cible = this.hash;
        let windowWidht = document.body.clientWidth;

           
        $('body,html').animate({scrollTop: $(cible).offset().top}, 900, function(){window.location.cible = cible;});
        if(windowWidht<990){
            $(".navbar-collapse").collapse("toggle");
        }
        
    });

    $('#remonte').on('click', function(event){

        event.preventDefault();
        let cible = this.hash;
        $('body,html').animate({scrollTop: $(cible).offset().top}, 900, function(){window.location.cible = cible;});
    });
    
    

    $('#contact-form').submit(function(e) {
        e.preventDefault();
        $('.thank-you').empty();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'PHP/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                    $('#contact-form').append("<p class='text-center'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");
                    $('#contact-form')[0].reset();
                }
                else
                {
                    $('#firstname + .comments').html(json.firstnameError);
                    $('#name + .comments').html(json.nameError);
                    $('#email + .comments').html(json.emailError);
                    $('#phone + .comments').html(json.phoneError);
                    $('#choix + .comments').html(json.choixError);
                    $('#message + .comments').html(json.messageError);
                }                
            }
        });
    });


});

