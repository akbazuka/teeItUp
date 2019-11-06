
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

/* JQuery Effects Examples pn Images (can use on any HTML element):-----------------------------------------------
 * 
$(document).ready(() => {
  $('.hide-button').on('click', () => { //.hide-button is class of button to be clicked; .first-image is class of image to be hidden
    $('.first-image').hide();
  });
  
  $('.show-button').on('click', () => {
    $('.first-image').show();
  });
  
  $('.toggle-button').on('click', () => {
    $('.first-image').toggle();
  });
  
  $('.fade-out-button').on('click', () => {
    $('.fade-image').fadeOut(500);
  });
  
  $('.fade-in-button').on('click', () => {
    $('.fade-image').fadeIn(4000);
  });
  
  $('.fade-toggle-button').on('click', () => {
    $('.fade-image').fadeToggle();
  });
  
  $('.up-button').on('click', () => {
    $('.slide-image').slideUp(100);
  });
  
  $('.down-button').on('click', () => {
    $('.slide-image').slideDown('slow')
  });
  
  $('.slide-toggle-button').on('click', () => {
    $('.slide-image').slideToggle(400)
  });
  
});
 */

/* Event Handlers:-----------------------------------------------------------------------------
 * 
 * $(document).ready(() => {

  $('.login-button').on('click', () => {
    $('.login-form').show();
  });
  
  $('.menu-button').on('mouseenter', () => { //When mouse is hovering over element
    $('.nav-menu').show()
  })
  
  $('.nav-menu').on('mouseleave', () => {
    $('.nav-menu').hide();
  })
  
  $('.product-photo').on('mouseenter', event => {
    $(event.currentTarget).addClass('photo-active') //.currentTarget only adds event listener to the particular element of a class being targeted
  }).on('mouseleave', event => {
    $(event.currentTarget).removeClass('photo-active')
  })
  
}); 

 */

/* JQuery Style methods (Can also use .css within JQuery to edit CSS properties from Javascript (look it up).)
 * 
 * $(document).ready(() => {
 
  $('.login-button').on('click', () => {
    $('.login-form').toggle();
  });
  
  $('.menu-button').on('mouseenter', () => {
    $('.nav-menu').show();
    $('.menu-button').addClass('button-active');
    $('.nav-menu').removeClass('hide');
    
    $('.menu-button').animate({
      fontSize: '24px'
    }, 200)
  })
  
  $('.nav-menu').on('mouseleave', () => {
    $('.menu-button').removeClass('button-active')
    $('.nav-menu').hide();
    
    $('.menu-button').animate({
      fontSize: '18px'
    }, 200)
  })
  
}); 

 * Toggle Class when clicked on element
 * $(document).ready(() => {
  $('.login-button').on('click', () => {
    $('.login-form').show();
  });
  
  $('.menu-button').on('click', () => {
    $('.nav-menu').toggleClass('hide')
    $('.menu-button').toggleClass('button-active')
  })
}); 
 */

/*
 * Traversing through DOM:--------------------------------------------------------------------------------------
 * 
 * $(document).ready(() => {
  
  $('.shoe-details').show();
  
  $('.more-details-button').on('click', event => {
    $(event.currentTarget).closest('.product-details').next().toggle() //The .next() method returns the immediate sibling following the element on which the method is called.
  });  
  
  $('.shoe-details li').on('click', event => {
    $(event.currentTarget).addClass('active');
    
    $(event.currentTarget).siblings().removeClass('active') //.siblings() selects all elements at the same DOM tree level (heirarchy in HTML file) as the jQuery selector’s element.
    
    $(event.currentTarget).closest('.shoe-details').children().removeClass('disabled')
    
    
  });
  
  
  
  ///////////////////////////////////////////
  $('.login-button').on('click', () => {
    $('.login-form').toggle();
    $('.login-button').toggleClass('button-active');
  });

  $('.product-photo').on('mouseenter', () => {
    $(this).addClass('photo-active');
  }).on('mouseleave', function() {
    $(this).removeClass('photo-active');
  });

  $('.menu-button').on('click', () => {
    $('.menu-button').toggleClass('button-active');
    $('.nav-menu').toggleClass('hide');
  });
})
 */


