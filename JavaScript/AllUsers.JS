
$(".online-users").load("AllUserSettings/getUsersOnline.php",function(data){
 
})

setInterval(function(){
    $(".online-users").load("AllUserSettings/getUsersOnline.php",function(data){
    })
}, 30000 );

$(".offline-users").load("AllUserSettings/getUsersOffline.php",function(data){
    })

setInterval(function(){
    $(".offline-users").load("AllUserSettings/getUsersOffline.php",function(data){
    })
}, 30000 );

