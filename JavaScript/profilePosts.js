// styling part
$(".addPost").click(()=>{
    $(".form-container").fadeIn(600);
})
$(".remove").click(()=>{
    $(".form-container").fadeOut(600);
})

$("#desc-input").keyup(()=>{
    let length = $("#desc-input").val().length;
    $(".chars").text(length +"/500");
})

let imageInput = document.querySelector("#img");
let theImage = document.querySelector("#image-upload img");

imageInput.addEventListener("change",()=>{
    if(imageInput.files[0].size <= 100 * 1024 * 1024){
        theImage.src = URL.createObjectURL(imageInput.files[0]);
        theImage.style.height="100%";
        theImage.style.width="100%";
    }
        else {
            $(".Errors").html("Size is over 100mbs");
            $(".Errors").fadeIn(600)
            setTimeout(()=>$(".Errors").fadeOut(600),6000);
        }
});

// Submitting Using ajax and posting in the DB
let form = document.querySelector("#form");
$("#form").submit((e)=>{
    e.preventDefault();
    const formData =new FormData(form) ;
    
    
    $.ajax({
        url:"postsSystem/postVerify.php",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
          
            if(data == "done" || data == "donedone" || data == "donedonedone"){

                $(".input").val("");
                theImage.src = "assets/plus.svg";
                theImage.style.height="50%";
                theImage.style.width="50%";
                $(".form-container").fadeOut(500);
                $(".posts").children().not(".addPost").remove();
                loadPosts();
            }
            else {
               
                let errors;
                let str = "";
                let i = 0
                errors = data.split("\n");
                while(errors[i]){
                    str += errors[i] + "<br>";
                    i++;
                }
                $(".Errors").html(str);
                $(".Errors").fadeIn(600)
                setTimeout(()=>$(".Errors").fadeOut(600),6000);
            }
        }
    })
    
});

loadPosts();


function loadPosts(){
    $.post("postsSystem/loadPosts.php").done(function(data){
        console.log(data)
        $(".posts").append(data);
        let count = $(".posts").children().length;
        $(".posts").children(":not(.addPost)").click((e)=>{
            const ImageId =$(e.currentTarget).children().data("id");
            $.post("postsSystem/loadDesc.php", {rowId: ImageId}).done(function(data){
                $("body").append(data);
                $(".post-container").fadeIn(600);
                $(".post-container").css("display","flex");
                $(".remove2").click(()=>{
                    $(".post-container").fadeOut(600);
                    $(".post-container").detach();
                })
                $("#delete").click(()=>{
                    $.post("postsSystem/deletePost.php", {rowId: ImageId}).done(function(){
                            location.reload();
                    });
                })
            })
        });
        if(count == 1){
            $(".posts").css("justify-content", "flex-start");
        }
    });
}


// Show post details 

