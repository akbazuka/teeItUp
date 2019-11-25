
        //To validate tee time buttons; check if time has been passed already
        var hawaiiTimeZone = new Date().toLocaleString("en-US", {timezone: "America/Hawaii"});
        hawaiiTimeZone = new Date(hawaiiTimeZone);
//        console.log("This is Hawaiian Time: "+hawaiiTimeZone.toLocaleString());
    
        //Create date picker object
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            startDate: '0d',
            endDate: '+6d',
            language: "en",
            autoclose: true
        });

        var selectedTime = "";
        var selectedDate = "";
        var selectedTimeID = ""; //Takes care of time and date
        var selectedGolfCourseID = <?php echo $courseID; ?>; //Get golf course ID from php
        //console.log("Selected golf course ID: "+selectedGolfCourseID);

        function refreshTime(x, y)
        {
            selectedTime = x;
            selectedTimeID = y;
//            console.log(selectedTime);
//            console.log(selectedTimeID);
        }

        $(".datepicker").on('change', function (event) {
            event.preventDefault();
            //alert(this.value);
            selectedDate = this.value;
            //alert(selectedDate);
            getTimes(refreshDate); //Callback to refreshDate with getTimes
            //refreshDate();
        });

        function getTimes(callback) {
            $.ajax({
            type: "POST",
            url: "getTeeTimes.php",
            data: {selectedDate: selectedDate, selectedGolfCourseID: selectedGolfCourseID},
            success: function (result)
            {
                //console.log(result);
                $('#tt').html(result);
            }
        });
            setTimeout(function() {callback();},500); //Call function after a 300 milliseconds of time to give ajax time to process result; get tee proper times for refreshDate()
        }

        function refreshDate() {           
            //console.log("The selected date is: " + selectedDate);
            
            //Save elements of class and length in Variables to be used in for loop
            var count = $('.btnOn').length;
            var classArray = $('.btnOn');
            //console.log(classArray);

            dateYear = selectedDate.split("-")[0];
            dateMonth = selectedDate.split("-")[1];
//            console.log("Date Month: "+dateMonth); //Current month shows correctly
            dateDay = selectedDate.split("-")[2];

            for (var i = 0; i < count; i++) {
                //console.log(count);
                //console.log("This is i: " + i);
                //console.log($('.btnOn').length); //check no of items left in array
                //console.log("These are the elements: " + classArray[i].id);
                buttonHour = classArray[i].id.split(":")[0];
                buttonMinute = classArray[i].id.split(":")[1];

                buttonTime = new Date(dateYear, (dateMonth - 1), dateDay, buttonHour, buttonMinute); //For some reason, date month appears as next month after the current so had to do (month-1)
                //console.log(buttonTime.toLocaleString());
                //console.log(hawaiiTimeZone.toLocaleString());

//             console.log(buttonTime.toLocaleString());
             //console.log(testTime.toLocaleString());

//                testTime = new Date(2019, 10, 24, 14, 16);
//                if (buttonTime <= testTime) {

                    relevantButton = classArray[i].id;
                    //console.log("This is the relavant button: "+relevantButton);
                    
                    //console.log(document.getElementById(relevantButton));
                    thisID = document.getElementById(relevantButton);
                    
                if (buttonTime.valueOf() <= hawaiiTimeZone.valueOf()) { //Check if current time is Hawaii is past tee time and turn button off if so
                    //console.log("True");

                    //console.log("This is the time selected: "+$('.btnOn').get(i).id);
                    //console.log("This is the current time: "+hawaiiTimeZone);

                    thisID.classList.remove("btnOn");
                    thisID.classList.add("btn_off");
                    //thisID.setAttribute("onclick", ""); removes onclick event for button but apparently is not needed here
//                $('#10:15').addClass('btnOff').removeClass('btnOn'); //not working for some reason 
                } else if (buttonTime > hawaiiTimeZone && thisID.classList.contains("btn_off")){
                    thisID.classList.remove("btn_off");
                    thisID.classList.add("btnOn");
                }
            }
        }

        //console.log($('.btnOn').get(0).id);

        //Event Listener to reset selectedTime to empty when user clicks anywhere outside a tee time button
        document.addEventListener(`click`, function (event) {
            //Runs only when class is NOT 'btnOn'
            if (!event.target.closest('.btnOn')) {
                refreshTime('', '', '');
            }
        });

        function clickedBookButton()
        {
            //Ajax method to insert into booked table in database and update tee times table
            $.ajax({
                type: "POST",
                url: "pushBookingsAjax.php",
                data: {selectedTimeID: selectedTimeID},
                success: function (data) {
                    //                console.log(data);
                }
            });

            Swal.fire({
                icon: 'success',
                title: 'Congrats!',
                text: 'You booked a tee time at ' + selectedTime + ' on 10/01/19'
            });
            $(Swal.getConfirmButton()).click(function () {
                window.location.replace("viewBookings.php"); //Automatically navigate to view bookings page when okay button is clicked
            });
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
            var duration = 0.3, delay = 0.08;
            TweenMax.to($button, duration, {scaleY: 1.6, ease: Expo.easeOut});
            TweenMax.to($button, duration, {scaleX: 1.2, scaleY: 1, ease: Back.easeOut, easeParams: [3], delay: delay});
            TweenMax.to($button, duration * 1.25, {scaleX: 1, scaleY: 1, ease: Back.easeOut, easeParams: [6], delay: delay * 3});
        });