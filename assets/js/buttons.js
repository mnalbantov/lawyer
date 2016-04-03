$(document).ready(function () {
    $(".button").hover(function () {
        $(this).stop().animate({
            backgroundColor: "#f4645f",
            color: "#fff"
        }, 500);
    }, function () {
        $(this).stop().animate({
            backgroundColor: "#1B9772",
            color: "#fff"
        }, 500);
    });
    $("#menu li a").hover(function () {
        $(this).stop().animate({
            color: "#f4645f"
        }, 300);
    }, function () {
        $(this).stop().animate({
            color: "#2C383B"
        }, 500);
    });
    $("#logo a").hover(function () {
        $(this).stop().animate({
            color: "#f4645f",
            fontSize: "1.2em",
            opacity: "0.7"
        }, 500);
    }, function () {
        $(this).stop().animate({
            color: "#197d62",
            fontSize: "1em",
            opacity: "1"
        }, 500);
    });
    $('.article_img').hover(function () { 
        $(this).stop().animate({
            'zoom': 1.2,
            'opacity': 1
        }, 400);
    },
            function () {
                $(this).stop().animate({
                    'zoom': 1,
                    'opacity': 0.8
                }
                , 500);
                
            }
    );
    $('.last a').hover(function () {
        $(this).stop().animate({
            color: "#428bca"
        }, 500);
    },
            function () {
                $(this).stop().animate({
                    color: '#A2A2A2'
                }, 500);
            }
    );
    $("#btn").click(function () {
        $("#myModal").modal('show');
    });

    $('#profile_pic').click(function () {
        $('#image-gallery').modal('show');
    });
    
   

});
 