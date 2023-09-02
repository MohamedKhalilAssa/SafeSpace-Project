


$.post("postsSystem/loadPostsFromOthers.php",{clicked:id}).done(function(data){
    $(".posts").append(data);
    let count = $(".posts").children().length;
    $(".posts").children().click((e)=>{
        const ImageId2 =$(e.currentTarget).children().data("id");
        $.post("postsSystem/loadFriendsDesc.php", {rowId: ImageId2}).done(function(data){
            $("body").append(data);
            $(".post-container").fadeIn(600);
            $(".post-container").css("display","flex");
            $(".remove2").click(()=>{
                $(".post-container").fadeOut(600);
                $(".post-container").detach();
            })
        })
    });
    if(count == 1){
        $(".posts").css("justify-content", "flex-start");
    }
});