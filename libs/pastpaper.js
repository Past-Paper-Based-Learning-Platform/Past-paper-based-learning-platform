document.querySelector(".pastpaper").addEventListener("click",()=>{
    document.getElementById("pdfpp").style.display="block";
    document.getElementById("pdfans").style.display="none";

})

document.querySelector(".answerscript").addEventListener("click",()=>{
    document.getElementById("pdfpp").style.display="none";
    document.getElementById("pdfans").style.display="block";
})

document.querySelector(".question").addEventListener('click',()=>{
    const style = document.querySelector(".discussionform").style.display;
    if(style === "none"){
        document.querySelector(".discussionform").style.display='block';
        document.getElementById('content').setAttribute('class','contentx');
        document.querySelector(".pdf").style.height='83%';
    }else{
        document.querySelector(".discussionform").style.display='none';
        document.getElementById('content').setAttribute('class','content');
        document.querySelector(".pdf").style.height='87%';
    }
})

const tagContainer = document.querySelector('.tag-container');

const input = document.querySelector('.tag-container input');

const input1 = document.querySelector('.tag-input input');

var tags = [];

function createTag(label){
    const div =document.createElement('div');
    div.setAttribute('class', 'tag');
    const span =document.createElement('span');
    span.innerHTML=label;
    const closeBtn =document.createElement('i');
    closeBtn.setAttribute('class','closebtn');
    closeBtn.setAttribute('data-item',label);
    closeBtn.innerHTML = '&times;';

    div.appendChild(span);
    div.appendChild(closeBtn);
    return div;
}

function clearTags() {
    document.querySelectorAll('.tag').forEach(tag => {
      tag.parentElement.removeChild(tag);
    });
  }

function addTags(){
    clearTags();
    tags.slice().reverse().forEach(function(tag){
        const input = createTag(tag);
        tagContainer.prepend(input);
    })
}

input.addEventListener('keyup',function(e){
    if(e.key === ' '){
        tags.push(input.value);
        addTags();
        input1.value=tags;
        input.value='';
    }
})

document.addEventListener('click', function(e){
    if(e.target.tagName === 'I'){
        const value = e.target.getAttribute('data-item');
        const index = tags.indexOf(value);
        tags = [...tags.slice(e,index), ...tags.slice(index+1)];
        addTags();
        input1.value=tags;
    }
})