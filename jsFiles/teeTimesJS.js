    var selectedTime = "";

    function refreshTime(x)
    {
        selectedTime = x;
    }

    function clickedBookButton()
    {
        //alert('You booked a tee time at ' +  selectedTime + ' on 10/01/19');
        swal("Congrats!", "You booked a tee time at " + selectedTime + " on 10/01/19", "success");
    }

    function changeBook(x, y, z, a)
    {
        document.getElementById("book").style.color = x;
        document.getElementById("book").style.fontSize = y;
        document.getElementById("book").style.backgroundColor = z;
        document.getElementById("book").style.fontWeight = a;
    }

    //For jumping book button
    var $button = document.querySelector('.bttn');
    $button.addEventListener('click', function () {
        var duration = 0.3,
                delay = 0.08;
        TweenMax.to($button, duration, {scaleY: 1.6, ease: Expo.easeOut});
        TweenMax.to($button, duration, {scaleX: 1.2, scaleY: 1, ease: Back.easeOut, easeParams: [3], delay: delay});
        TweenMax.to($button, duration * 1.25, {scaleX: 1, scaleY: 1, ease: Back.easeOut, easeParams: [6], delay: delay * 3});
    });