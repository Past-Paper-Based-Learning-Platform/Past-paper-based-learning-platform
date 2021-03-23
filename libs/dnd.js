document.querySelectorAll(".dzone-input").forEach(inputElement =>{
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", e => {
        inputElement.click();
    });

    inputElement.addEventListener("change", e => {
        if (inputElement.files.length){
            updateThumbnail(dropZoneElement,inputElement.files[0]);
        }
    });
    
    dropZoneElement.addEventListener("dragover", e => {
        e.preventDefault();
        dropZoneElement.classList.add("dzone-over");
    });

    ["dragleave","dragend"].forEach(type => {
        dropZoneElement.addEventListener(type, e => {
            dropZoneElement.classList.remove("dzone-over");
        });
    });

    dropZoneElement.addEventListener("drop", e=>{
        e.preventDefault();
        
        if(e.dataTransfer.files.length){
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement,e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("dzone-over");
    });
});



function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector(".dzone-thumb");
    
    //remove prompt
    if(dropZoneElement.querySelector(".dzone-prompt")){
        dropZoneElement.querySelector(".dzone-prompt").remove();
    }
    
    //if thumbnail do not exist
    if(!thumbnailElement){
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("dzone-thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    
}