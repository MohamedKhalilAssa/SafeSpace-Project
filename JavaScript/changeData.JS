$(".eyes1").click(()=>{
    $(".eyes1").toggleClass("show");

    if($(".eyes1").hasClass("show")){
        $(".password1").attr("type","text");
        $(".eyes1").attr("src","assets/eyeBarred.svg")
    } else{
        $(".password1").attr("type","password");
        $(".eyes1").attr("src","assets/eye.svg")
    }
})
$(".eyes2").click(()=>{
    $(".eyes2").toggleClass("show");

    if($(".eyes2").hasClass("show")){
        $(".password2").attr("type","text");
        $(".eyes2").attr("src","assets/eyeBarred.svg")
    } else{
        $(".password2").attr("type","password");
        $(".eyes2").attr("src","assets/eye.svg")
    }
})
$(".eyes3").click(()=>{
    $(".eyes3").toggleClass("show");

    if($(".eyes3").hasClass("show")){
        $(".password3").attr("type","text");
        $(".eyes3").attr("src","assets/eyeBarred.svg")
    } else{
        $(".password3").attr("type","password");
        $(".eyes3").attr("src","assets/eye.svg")
    }
})


// image

//? adding image

let imageInput = document.querySelector("#img");
let theImage = document.querySelector("#image-upload img");

imageInput.addEventListener("change",()=>{
   
    theImage.src = URL.createObjectURL(imageInput.files[0]);
    theImage.style.height="100%";
    theImage.style.width="100%";
});
