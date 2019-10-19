
//Event Listener to remove popups when clicking anywhere but info button
document.addEventListener(`click`, function (event) {
    //Runs only when class is NOT 'popup'
    if (!event.target.closest('.popup')) {
        var showItems = document.getElementsByClassName("popuptext");
        for (i = 0; i < showItems.length; i++)
        {
            //Removes previous CSS 'active' class every time new item is clicked
            showItems[i].classList.remove("show");
        }
    }
});

//Changes color of golf course container borders when hovering over link   
function boxHover(n, x) {
    document.getElementById(n).style.borderColor = x;
}

//When the user clicks on div, open the popup
function popUp(x) {
    var popup = document.getElementById(x);
    var showItems = document.getElementsByClassName("popuptext");
    for (i = 0; i < showItems.length; i++)
    {
        //Removes previous CSS 'active' class every time new item is clicked
        showItems[i].classList.remove("show");
    }
    popup.classList.add("show");
}



