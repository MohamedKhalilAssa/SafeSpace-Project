let errorDiv = document.querySelector(".errors");

if(errorDiv.hasChildNodes()){
    setTimeout(()=>{
        $(".errors").fadeOut(500);
        $(".errors").empty();
    },4000);
}

// Create New Pass file
