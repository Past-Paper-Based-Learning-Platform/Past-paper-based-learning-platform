$(document).ready(function(){

    // if the user clicks on the like button ...
    $('.like-btn').on('click', function(){
      var discussion_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
          action = 'like';
      } else if($clicked_btn.hasClass('fa-thumbs-up')){
          action = 'unlike';
      }
      $.ajax({
          url: 'feed.php',
          type: 'post',
          data: {
              'post_action': action,
              'discussion_id': discussion_id
          },
          success: function(data){
              res = JSON.parse(data);
              if (action == "like") {
                  $clicked_btn.removeClass('fa-thumbs-o-up');
                  $clicked_btn.addClass('fa-thumbs-up');
              } else if(action == "unlike") {
                  $clicked_btn.removeClass('fa-thumbs-up');
                  $clicked_btn.addClass('fa-thumbs-o-up');
              }
              // display the number of likes and dislikes
              $clicked_btn.siblings('span.likes').text(res.likes);
              $clicked_btn.siblings('span.dislikes').text(res.dislikes);
    
              // change button styling of the other button if user is reacting the second time to post
              $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
          }
      });		
    
    });
    
    // if the user clicks on the dislike button ...
    $('.dislike-btn').on('click', function(){
      var discussion_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
          action = 'dislike';
      } else if($clicked_btn.hasClass('fa-thumbs-down')){
          action = 'undislike';
      }
      $.ajax({
          url: 'feed.php',
          type: 'post',
          data: {
              'post_action': action,
              'discussion_id': discussion_id
          },
          success: function(data){
              res = JSON.parse(data);
              if (action == "dislike") {
                  $clicked_btn.removeClass('fa-thumbs-o-down');
                  $clicked_btn.addClass('fa-thumbs-down');
              } else if(action == "undislike") {
                  $clicked_btn.removeClass('fa-thumbs-down');
                  $clicked_btn.addClass('fa-thumbs-o-down');
              }
              // display the number of likes and dislikes
              $clicked_btn.siblings('span.likes').text(res.likes);
              $clicked_btn.siblings('span.dislikes').text(res.dislikes);
              
              // change button styling of the other button if user is reacting the second time to post
              $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
          }
      });	
    
    });

    // if the user clicks on the like button ...
    $('.like-btn-answer').on('click', function(){
        var answer_id = $(this).data('id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
            action = 'like';
        } else if($clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }
        $.ajax({
            url: 'feed.php',
            type: 'post',
            data: {
                'answer_action': action,
                'answer_id': answer_id
            },
            success: function(data){
                res = JSON.parse(data);
                if (action == "like") {
                    $clicked_btn.removeClass('fa-thumbs-o-up');
                    $clicked_btn.addClass('fa-thumbs-up');
                } else if(action == "unlike") {
                    $clicked_btn.removeClass('fa-thumbs-up');
                    $clicked_btn.addClass('fa-thumbs-o-up');
                }
                // display the number of likes and dislikes
                $clicked_btn.siblings('span.likes-answer').text(res.likes);
                $clicked_btn.siblings('span.dislikes-answer').text(res.dislikes);
      
                // change button styling of the other button if user is reacting the second time to post
                $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
            }
        });		
      
      });

      // if the user clicks on the dislike button ...
      $('.dislike-btn-answer').on('click', function(){
        var answer_id = $(this).data('id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
            action = 'dislike';
        } else if($clicked_btn.hasClass('fa-thumbs-down')){
            action = 'undislike';
        }
        $.ajax({
            url: 'feed.php',
            type: 'post',
            data: {
                'answer_action': action,
                'answer_id': answer_id
            },
            success: function(data){
                res = JSON.parse(data);
                if (action == "dislike") {
                    $clicked_btn.removeClass('fa-thumbs-o-down');
                    $clicked_btn.addClass('fa-thumbs-down');
                } else if(action == "undislike") {
                    $clicked_btn.removeClass('fa-thumbs-down');
                    $clicked_btn.addClass('fa-thumbs-o-down');
                }
                // display the number of likes and dislikes
                $clicked_btn.siblings('span.likes-answer').text(res.likes);
                $clicked_btn.siblings('span.dislikes-answer').text(res.dislikes);
                
                // change button styling of the other button if user is reacting the second time to post
                $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
            }
        });	
      
      });
      
      // if the user clicks on the post comment ...
      $('.comment-post').on('click', function(){
        var answer_id = $(this).data('id');
        var comment = document.getElementById(`comment${answer_id}`).value;
        document.getElementById(`comment${answer_id}`).value = "";
        $.ajax({
            url: 'feed.php',
            type: 'post',
            data: {
                'comment_answer_id': answer_id,
                'comment': comment
            },
            success: function(data){
                res = JSON.parse(data);
                var comments = "";

                var list = $('<div>');

                for(var i = 0; (i < res.length); i++){
                    // display the posted comment
                    if (res[i]['anonymous_number']==null){
                        comments = "<div class='display-comment'><span class='discussion-username'>"
                            + res[i]['user_name']
                            + "</span>&nbsp;&nbsp;&nbsp;<span>"
                            + res[i]['comment']
                            + "</span>&nbsp;&nbsp;&nbsp;<span class='discussion-timestamp' style='float:right'>"
                            + res[i]['timestamp']
                            + "</span></div>";
                    }else{
                        comments = "<div class='display-comment'><span class='discussion-username'>user_"
                        + res[i]['anonymous_number']
                        + "</span>&nbsp;&nbsp;&nbsp;<span>"
                        + res[i]['comment']
                        + "</span>&nbsp;&nbsp;&nbsp;<span class='discussion-timestamp' style='float:right'>"
                        + res[i]['timestamp']
                        + "</span></div>";
                    }
                    list.append(comments);
                }
                $(`#comment-content${answer_id}`).html(list);
            }
        });
    });	
      
      });
       // if the user clicks on the show comment ...
       $('.comment-show').on('click', function(){
        var answer_id = $(this).data('id');
        $.ajax({
            url: 'feed.php',
            type: 'post',
            data: {
                'comment_show_id': answer_id,
            },
            success: function(data){
                res = JSON.parse(data);
                var comments = "";

                var list = $('<div>');

                if(res.length==0){
                    $(`#comment-content${answer_id}`).html("No comments");
                }else{
                    for(var i = 0; (i < res.length); i++){
                        // display the posted comment
                        if (res[i]['anonymous_number']==null){
                            comments = "<div class='display-comment'><span class='discussion-username'>"
                                + res[i]['user_name']
                                + "</span>&nbsp;&nbsp;&nbsp;<span>"
                                + res[i]['comment']
                                + "</span>&nbsp;&nbsp;&nbsp;<span class='discussion-timestamp' style='float:right'>"
                                + res[i]['timestamp']
                                + "</span></div>";
                        }else{
                            comments = "<div class='display-comment'><span class='discussion-username'>user_"
                            + res[i]['anonymous_number']
                            + "</span>&nbsp;&nbsp;&nbsp;<span>"
                            + res[i]['comment']
                            + "</span>&nbsp;&nbsp;&nbsp;<span class='discussion-timestamp' style='float:right'>"
                            + res[i]['timestamp']
                            + "</span></div>";
                        }
                        list.append(comments);
                    }
                    $(`#comment-content${answer_id}`).html(list);
                }

            }
        });	
      
    
});

function validateForm() {
    var  question, output = true;

    question = document.getElementById("question");
    
    if (!question.value) {
        question.focus();
        alert("Cannot Create Empty Discussions!");
        output = false;
    }
    return output;
}

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
}  

//tags bar implementation
const tagContainer = document.querySelector('.tag-container');
const input = document.querySelector('.tag-container input');
const taglist = document.querySelector('.tag-list');

let tags = [];

function createTag(label) {
  const div = document.createElement('div');
  div.setAttribute('class', 'tag');
  const span = document.createElement('span');
  span.innerHTML = label;
  const closeIcon = document.createElement('i');
  closeIcon.innerHTML = "&times";
  closeIcon.setAttribute('data-item', label);
  div.appendChild(span);
  div.appendChild(closeIcon);
  return div;
}

function clearTags() {
  document.querySelectorAll('.tag').forEach(tag => {
    tag.parentElement.removeChild(tag);
  });
}

function addTags() {
  clearTags();
  tags.slice().reverse().forEach(tag => {
    tagContainer.prepend(createTag(tag));
  });
}

input.addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
      e.target.value.split(',').forEach(tag => {
        tags.push(tag);  
      });
      
      addTags();
      taglist.value=tags;
      input.value = '';
    }
});
document.addEventListener('click', (e) => {
  console.log(e.target.tagName);
  if (e.target.tagName === 'I') {
    const tagLabel = e.target.getAttribute('data-item');
    const index = tags.indexOf(tagLabel);
    tags = [...tags.slice(0, index), ...tags.slice(index+1)];
    addTags();    
    taglist.value=tags;
  }
});