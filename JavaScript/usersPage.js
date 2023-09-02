// $(".profile-container").load("AllUserSettings/getClickedUser.php",function(data){
//     console.log(data);
//     });

// animation and functionality

$(".settings").click(()=>{
    $(".settings").toggleClass("clicked");
    
    if($(".settings").hasClass("clicked")){
        $(".btn-container").addClass("active");
        $(".btn-container").removeClass("inActive");
    } else {
        $(".btn-container").removeClass("active");
        $(".btn-container").addClass("inActive");
    }
    
}
)





// ajax
let id = location.search
id = id.split("");
id.splice(0,4);
id = id.join("");

$.post("OtherPagesSettings/getClickedUser.php",{Id: id}).done(function(data){
    $(".profile-container").prepend(data);
});   

function All(){
    $.post("OtherPagesSettings/checkStatus.php",{Id: id}).done(function(data){
        $(".btn-container").html(data);
    
        
    
        $(".add").click(function(){
            $.post("OtherPagesSettings/addFriend.php",{Id: id}).done(function(data){
                All();
            });
        })
    
        $(".accept").click(()=>{
            $.post("OtherPagesSettings/acceptFriend.php",{Id: id}).done(function(data){
                All();
            });
        })
        $(".ignore").click(()=>{
            $.post("OtherPagesSettings/ignoreFriend.php",{Id: id}).done(function(data){  
                All();
            });
        })  
    });   
}

All();