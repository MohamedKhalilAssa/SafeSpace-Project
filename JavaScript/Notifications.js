
$.post("NotificationsSettings/notificationSystem.php").done((data)=>{
    $(".notif-container").append(data);


    $(".btn.markAsRead").click(function(e){
        
        let id = e.target.getAttribute("data-id");
        e.target.classList.add("Clicked");   
        e.target.textContent= "Done";
        setTimeout(()=>{
            $(this).fadeOut(1000);
        },3000)
        $.post("NotificationsSettings/markAsRead.php",{Id:id});
        checkMarkAll();
     });
})


function checkMarkAll(){
    $.post("NotificationsSettings/markAllShow.php").done((data)=>{
        if(data != ""){
            $(".all-container").html(data);
            $(".markAll").click(()=>{
                 $(".btn").addClass("Clicked");   
                 $(".btn").text("Done");
                 setTimeout(()=>{
                      $(".btn").fadeOut(1000);
                  },3000)
                 $.post("NotificationsSettings/markAllClick.php");
            })
        } else {
            $(".all-container").html("");
        }
        
     })
}
checkMarkAll();
