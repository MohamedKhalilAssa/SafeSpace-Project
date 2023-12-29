//form settings To switch between sign in and sign up 
let SignUpButton = document.querySelector(".btn.n2");
let SignInButton = document.querySelector(".btn.n1");
let title = document.querySelector(".title");
let signupFields = document.querySelectorAll(".signup-fields");
let icons = document.querySelectorAll(".signup-fields .icons");
let requiredField = document.querySelector("#name-input");

let errorsDiv = document.querySelector(".errors");


SignUpButton.addEventListener("click",(element) => {
    
    if (SignUpButton.classList.contains("inactive")){
        element.preventDefault();
        
        setActive(SignUpButton);
        sessionStorage.setItem("state","Up");

        title.textContent = "Sign Up";
        signupFieldsAppear(signupFields,icons);
        $(".image-field").css("max-height","180px");
        setTimeout(()=>{
            $(".image-field").fadeIn();
        },0)
        errorsDiv.innerHTML="";
        

        setInactive(SignInButton);
    }
})




SignInButton.addEventListener("click",(element) => {
    
    
    if (SignInButton.classList.contains("inactive")){
        element.preventDefault();

        setActive(SignInButton);
        sessionStorage.setItem("state","In");


        title.textContent = "Sign In";
        signupFieldsDisappear(signupFields,icons);
        $(".image-field").css("max-height","0");
        setTimeout(()=>{
            $(".image-field").fadeOut(100);
        },0)

        setInactive(SignUpButton);
    } 
})

let state = sessionStorage.getItem("state");

setTimeout(()=>{ document.querySelectorAll(".btn").forEach((ele)=>{ele.style.transition = `all 0.3s ease`})} ,100)


//default state

// ? making it easier for users
$("#email-input").keyup(function(){
    sessionStorage.setItem("currentEmail",`${$("#email-input").val()}`);
});
$("#name-input").keyup(function(){
    sessionStorage.setItem("currentName",`${$("#name-input").val()}`);
});
let currentName =sessionStorage.getItem("currentName");
let currentEmail = sessionStorage.getItem("currentEmail");

if (state == "In"){
    setActive(SignInButton);
    $(".image-field").fadeOut(500);

    setInactive(SignUpButton);
    if(currentEmail != ""){
        const emailPattern = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/;
      
          if(emailPattern.test(currentEmail)){
              $("#email-input").val(currentEmail);
          }
      }
}


//signup state
else if(state == "Up") {
    setActive(SignUpButton);
    setInactive(SignInButton);

    title.textContent = "Sign Up";
    signupFieldsAppear(signupFields,icons);
    $(".image-field").fadeIn(500);

    setTimeout(()=> document.querySelectorAll(".btn").forEach((ele)=> ele.style.transition = `0.3s`) ,1000)

    if(currentName != ""){
        
        $("#name-input").val(currentName);
       
    }
    if(currentEmail){   
        const emailPattern = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/;
        if(emailPattern.test(currentEmail)){
        $("#email-input").val(currentEmail);
    }
    }
}



   

//* Functions 
function signupFieldsAppear(signup,Icons) {
    signup.forEach((field) => {
        field.style.maxHeight = "3rem";
    })
    Icons.forEach((icon)=> {
        icon.style.maxHeight="30px";
    })
    $(".eyes2").css("max-height","35px");
    $(".image-field").fadeIn();

}
function signupFieldsDisappear(signup,Icons) {
    $(".image-field").fadeOut(100);

    signup.forEach((field) => {
        field.style.maxHeight = "0";
    })
    Icons.forEach((icon)=> {
        icon.style.maxHeight="0";
    })
    $(".eyes2").css("max-height","0");
    
}

function setActive(Element){
    Element.classList.add("active");
    Element.classList.remove("inactive");
}
function setInactive(Element){
    Element.classList.add("inactive");
    Element.classList.remove("active");
}


// * Setting cookies for animation 


let container = document.querySelector(".container");
let logo = document.querySelector("header");
let side = document.querySelector(".side");
let userIcons = document.querySelectorAll(".users-icon");
logo.addEventListener("animationend", ()=> {
    document.cookie = "animationDone = True; SameSite=None; Secure"; 
})

let cookies = document.cookie;
let mail = document.querySelector(".mail");

if (cookies){
    container.style.animation = "none";
    logo.style.animation="none";
    side.style.animation="none";
    container.style.left = "0";
    side.style.right = "0";
    logo.style.top = "0";
    userIcons.forEach((ele)=> ele.style.animationDelay = "0.3s");
    mail.style.animationDelay="1.5s";
}

//? adding image

let imageInput = document.querySelector("#img");
let theImage = document.querySelector("#image-upload img");

imageInput.addEventListener("change",()=>{
   
    theImage.src = URL.createObjectURL(imageInput.files[0]);
    theImage.style.height="100%";
    theImage.style.width="100%";
});


// hide password and show

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

// let xhr = new XMLHttpRequest();
// setInterval(function(){
//     xhr.open("GET", "JavaScript/text.php");

//     xhr.onload= ()=>{
//         if(xhr.readyState == 4 && xhr.status == 200){
//             let result = xhr.response;
//             console.log(result)
//         }
//     }
//     xhr.send();
// }, 50
// )