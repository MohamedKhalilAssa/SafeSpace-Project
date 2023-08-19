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
        
        SignUpButton.classList.add("active");
        SignUpButton.classList.remove("inactive");

        title.textContent = "Sign Up";
        signupFieldsAppear(signupFields,icons);
        errorsDiv.innerHTML="";
        requiredField.setAttribute("required","true");

        SignInButton.classList.add("inactive");
        SignInButton.classList.remove("active");
    } 
})

SignInButton.addEventListener("click",(element) => {
    
    
    if (SignInButton.classList.contains("inactive")){
        

        SignInButton.classList.add("active");
        SignInButton.classList.remove("inactive");

        title.textContent = "Sign In";
        signupFieldsDisappear(signupFields,icons);
        requiredField.removeAttribute("required");
       

        SignUpButton.classList.add("inactive");
        SignUpButton.classList.remove("active");
    } 
})

function signupFieldsAppear(signup,Icons) {
    signup.forEach((field) => {
        field.style.maxHeight = "3rem";
    })
    Icons.forEach((icon)=> {
        icon.style.maxHeight="30px";
    })
}
function signupFieldsDisappear(signup,Icons) {
    signup.forEach((field) => {
        field.style.maxHeight = "0";
    })
    Icons.forEach((icon)=> {
        icon.style.maxHeight="0";
    })
}