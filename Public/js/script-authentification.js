$(function(){
var textfield = $("input[name=nom]");
            $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                //little validation just to check username
                if (textfield.val() != "") {
                    //$("body").scrollTo("#output");
                    $("#output").addClass("alert alert-success animated fadeInUp").html("Bienvenue : " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
                    $("#output").removeClass('alert-danger');
                    $("input").css({
                    "height":"0",
                    "padding":"0",
                    "margin":"0",
                    "opacity":"0"
                    });
                    //change button text 
                    $('button[type="submit"]').html("continue")
                    .removeClass("btn-info")
                    .addClass("btn-default").click(function(){
                    $("input").css({
                    "height":"auto",
                    "padding":"10px",
                    "opacity":"1"
                    }).val("");
                    });
                    
                    //show avatar
                    $(".avatar").css({
                        "background-image": "url('https://picsum.photos/200/300/?random')"
                    });
                } else {
                    //remove success mesage replaced with error message
                    $("#output").removeClass('alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Veuillez saisir votre nom d'utilisateur !");
                }
                //console.log(textfield.val());

            });
});

$("#motDePasse").on("keyup",function(){
    if($(this).val())
        $(".glyphicons-eye-open").show();
    else
        $(".glyphicons-eye-open").hide();
    });
$(".glyphicons-eye-open").mousedown(function(){
                $("#motDePasse").attr('type','text');
            }).mouseup(function(){
            	$("#motDePasse").attr('type','password');
            }).mouseout(function(){
            	$("#motDePasse").attr('type','password');
            });