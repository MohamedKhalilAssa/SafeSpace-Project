
$("#message-input").keyup(()=>{
    let length2 = $("#message-input").val().length
    $(".chars").html(length2 + "/200");
})
let counter;

$(document).ready(function() {
    // * load Friends
    loadFriendsInChat();
    // Load messages 

    $("#message-input").on("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); 
            $(".icon-container").click(); // Trigger the click event on the submit button
        }
    });

    $(".icon-container").click((e)=>{
        if(!$(".onMessage").children().length || $("#message-input").val() == ""){
            $("#message-input").val("")
            $("#message-input").attr("placeholder","Choose a Friend and type some text first..");
        } else {
            $("#message-input").attr("placeholder","Message..");
           const message =  $("#message-input").val();
           $("#message-input").val("");
           $(".chars").val("0/200");

            const sendTo = $("#getId").data("needed");
        //    send the message
           $.post("MessagingSystem/sendMessage.php",{message:message,sendTo :sendTo }).done(function(data){
               console.log(data)
                $.post("MessagingSystem/loadMessage.php",{sendTo : sendTo }).done(function(data){
                    $(".messages").html(data);
                    // Use a setTimeout to wait for the content to be updated
                    setTimeout(function() {
                            let messagesContainer = $(".messages");
                            messagesContainer.scrollTop(messagesContainer.prop("scrollHeight"));
                        }, 0);
                });
           })

          
        }
    })
});


// Load the friends in the side

function loadFriendsInChat(){
    $.post("MessagingSystem/loadFriends.php").done(function(data){
        
        $(".friends").html(data);

        // check messages in those friends;

        setInterval(checkNewMessages,5000);


        // Click event
        $(".user").click((e)=>{

            // showing the user you're currently messaging
    
            const copy = $(e.currentTarget).children().clone();
            let copyName = copy[1].textContent;
            const profileId = $(e.currentTarget).data("id");
            $(".onMessage").html(copy);

            $(".onMessage .name").replaceWith(`<a id='getId' data-needed=${profileId} class='name' href='usersPage.php?id=${profileId}'> ${copyName} </a>`);

            $(".user2 .stateInfo").addClass("stateInfo2");
            $(".user2 .stateInfo").removeClass("stateInfo");

            loadMessages(profileId);

            // mark previous messages as read
            $.post("MessagingSystem/markRead.php",{sentBy : profileId });
            $(".unread").detach()

            // Clear previously started interval
            clearInterval(counter);
            counter = setInterval(()=>{
                console.log(profileId)
                $.post("MessagingSystem/loadMessage.php",{sendTo : profileId }).done(function(data){
                    $(".messages").empty();
                    if(data != $(".messages").html()){
                        $(".messages").html(data);

                        
                    } 
                });
            },3000)
        })
        
    })
}

function loadMessages(ID){
    $.post("MessagingSystem/loadMessage.php",{sendTo : ID }).done(function(data){
        
        if(data != $(".messages").html()){
            $(".messages").html(data);
            
            // Scroll all the way down out of accessibility
            scrollToBottom(".messages");
        } 

       
    });
}


function scrollToBottom(elementSelector) {
    const element = $(elementSelector);
    const scrollHeight = element.prop("scrollHeight");
    element.animate({ scrollTop: scrollHeight }, 1000); // 500ms is the duration of the scroll animation
}

function checkNewMessages(){
    document.querySelectorAll(".user").forEach((ele)=>{
        const UserId = ele.dataset.id;
        $.post("MessagingSystem/checkMessage.php",{sentBy: UserId}).done((data)=>{               
            ele.innerHTML+= data;
        });

   })
}