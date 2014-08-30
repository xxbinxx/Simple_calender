$( function() {
     hideAllMessages();
     var myMessages = ['info','warning','error','success'];

   $('.message').click(function(){
            $(this).animate({top: -$(this).outerHeight()}, 500);
    });   


$('table:last-child td').not('.blank, .weekday').on({
    click: function(){
            if($(this).attr("data-text") === undefined){ //if holiday description of clicked tag is not defined.
                $(this).attr("data-text",""); // add a blank data-text attribute.
            }
            $(this).toggleClass("clicked");
            $dataValue = prompt('Enter the details', $(this).attr("data-text"));
            if($dataValue){
                $(this).attr("data-text",$dataValue);
                var data_text = $(this).attr("data-text");
                var data_date = $(this).attr("data-date");
                console.log(data_date);
                console.log(data_text);
                $(this).removeClass("clicked").addClass("selected holiday");
                // add the entered detail along with date number in the flash message
                $('.info').find('p').html("date: "+data_date+"    detail: "+ data_text);
                flashMessage('info');
            }
        },
        mouseleave: function() {
            
        },
        mouseenter: function() {
            if($(this).hasClass('holiday')){
                console.log($(this).attr("data-date"));

            }
       }

    } );
    
           
});


var myMessages = ['info','warning','error','success'];

function hideAllMessages() {

    var messagesHeights=[]; // this array will store height for each

    for (i=0; i<myMessages.length; i++) {
        messagesHeights[i] = $('.' + myMessages[i]).outerHeight(); // fill array
        $('.' + myMessages[i]).css('top', -messagesHeights[i]); //move element outside viewport
    }
}

function showMessage(type) {
    $('.'+type).animate({top:"0"}, 500);

}

function flashMessage(type) {
    showMessage(type);
    setTimeout(function() {   //calls hide event after a certain time
        $('.'+type).animate({top: -200}, 1500);
    }, 3000);
    
}

function savedata(){
    var total = $('table:last-child td.holiday').filter('[data-text]');
     var dataArray = {};
    console.log(total.size());
    $('table:last-child td.holiday').filter('[data-text]').each(function( index ) {
        dataArray[$(this).attr("data-date")] = $(this).attr("data-text");
    });
    $dataArray = JSON.stringify(dataArray);
    log( $.type(dataArray) );
    log($.makeArray(dataArray));
    log(dataArray);
    submitAndsaveData();
    // window.location.href = "./savedata.php?dataArray="+JSON.stringify(dataArray);

}

function log (text) {
    console.log(text);
}


function submitAndsaveData(data) {

var weHaveSuccess = false;

    $.ajax({
        type: "GET",
        url: "./savedata.php",
        contentType : "text/xml",
        data:data,
        success: function(data,status,xhr){
            flashMessage('success');
            alert("Hurrah!");
            weHaveSuccess = true;
        },
        error: function(xhr, status, error){
            flashMessage('error');
            alert("Error!" + xhr.status);
        },
        complete: function(){
            if(!weHaveSuccess){
                flashMessage('error');
            }
        }
    });
}
