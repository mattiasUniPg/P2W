animating = false;

$("#menuButton").click(function() {
    if(!animating)
    {
        animating = true;
        $('html, body').animate({
            scrollTop: $("#menuMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
    else
    {
        $('html, body').stop();
        
        animating = true;
        $('html, body').animate({
            scrollTop: $("#menuMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
});

$("#missionButton").click(function() {
    if(!animating)
    {
        animating = true;
        $('html, body').animate({
            scrollTop: $("#missionMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
    else
    {
        $('html, body').stop();
        
        animating = true;
        $('html, body').animate({
            scrollTop: $("#missionMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
});

$("#contactusButton").click(function() {
    if(!animating)
    {
        animating = true;
        $('html, body').animate({
            scrollTop: $("#contactusMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
    else
    {
        $('html, body').stop();
        
        animating = true;
        $('html, body').animate({
            scrollTop: $("#contactusMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
});

$("#whereweareButton").click(function() {
    if(!animating)
    {
        animating = true;
        $('html, body').animate({
            scrollTop: $("#whereweareMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
    else
    {
        $('html, body').stop();
        
        animating = true;
        $('html, body').animate({
            scrollTop: $("#whereweareMark").offset().top - 60
        }, 'slow', function() {
            animating = false;
        });
    }
});