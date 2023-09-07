
// hide password and show

$(".eyes1").click(()=>{
    $(".eyes1").toggleClass("show");

    if($(".eyes1").hasClass("show")){
        $(".password1").attr("type","text");
        $(".eyes1").attr("src","../assets/eyeBarred.svg")
    } else{
        $(".password1").attr("type","password");
        $(".eyes1").attr("src","../assets/eye.svg")
    }
})
$(".eyes2").click(()=>{
    $(".eyes2").toggleClass("show");

    if($(".eyes2").hasClass("show")){
        $(".password2").attr("type","text");
        $(".eyes2").attr("src","../assets/eyeBarred.svg")
    } else{
        $(".password2").attr("type","password");
        $(".eyes2").attr("src","../assets/eye.svg")
    }
})

// empty the errors div in case it's filled

let errorDiv = document.querySelector(".errors");

if(errorDiv.hasChildNodes()){
    setTimeout(()=>{
        $(".errors").fadeOut(500);
        $(".errors").empty();
    },4000);
}
