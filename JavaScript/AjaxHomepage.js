

$(".settings").click(()=>{
    $(".settings").toggleClass("clicked");
    $(".profile-container").toggleClass("settingsClicked");
}
)

 setInterval(function(){
        location.reload()
    },  2700000);
//ajax

$(".logout").click(function(){
    $.post("ProfileSetting/logout.php").done(function(data){
        location.reload();
    });   
})