document.addEventListener("DOMContentLoaded", () => {
    initButtons();
    initSlides();
});

function initButtons() {
    let submit_comment_button = document.querySelectorAll('.submit_comments');
    submit_comment_button.forEach((element)=>{
        element.addEventListener('click', sendComment);
    });

    let submit_rate_button = document.querySelectorAll('.rating_star');
    submit_rate_button.forEach((element)=>{
        element.addEventListener('click', ratePost);
    });

    let slide_button = document.querySelectorAll('.slideshow-container .prev, .slideshow-container .next');
    slide_button.forEach((element)=>{
        element.addEventListener('click', showSlides);
    });

    let submit_post_button = document.getElementById('create_post');
    submit_post_button.addEventListener('click', createpost);

    let notices = document.getElementById('all_notices');
    notices.addEventListener('click', show_notices);

    // let search_enviroment = document.getElementById('searchuser');
    // search_enviroment.addEventListener('focusout', clean_search_enviroment);
    // search_enviroment.addEventListener('focus', search);
}

function sendComment(event) {
    var formComments = event.target.closest('.post_container'); 
    // console.log(formComments);
    var postId = formComments.querySelector('#postId').value;
    var comment = formComments.querySelector('#comment').value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);

                let num_comments = formComments.querySelector('#num_comments');
                num_comments.innerHTML = response.num_comments;

                formComments.querySelector('#comment').value = '';

                let lastComment = formComments.querySelector('.last_comment');
                if(lastComment != null) {
                    lastComment.innerHTML = lastComment.innerHTML+response.last_comment;
                }
                else
                {
                    let post_comments = formComments.querySelector('.post_comments');
                    post_comments.innerHTML = post_comments.innerHTML+response.last_comment;
                }
            }
        };
        var formData = new FormData(); 
        formData.append('MM_insert', 'formcomments');
        formData.append('postId', postId);
        formData.append('comment', comment);

        xmlhttp.open("POST", "logic/start_be.php", true);
        xmlhttp.send(formData);
}

function showcomments(postId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let post_comments = document.getElementById('post_comments');
            if(typeof(post_comments) != 'undefined' && post_comments != null)
            {
                post_comments.remove();
            }
            var response = JSON.parse(this.responseText);

            let bg_popup = document.getElementById('bg_popup');
            bg_popup.style.display = 'block';

            let comment_fotos_popup = document.getElementById('comment_fotos_popup');
            comment_fotos_popup.style.display = 'block';

            var displaySize = {
                "width": "1050px",
                "height": "600px",
                "margin": "5vh auto"
            };
             
            var bgContainer = document.getElementById("bg_container");
            Object.assign(bgContainer.style, displaySize);

            let post_fotos_coments = document.getElementById('comments_popup');
            post_fotos_coments.innerHTML = post_fotos_coments.innerHTML+response.comments_html;

            let popup_profile = document.getElementById('popup_profile');
            popup_profile.innerHTML = response.post_author;

            let num_comments = document.querySelector('#bg_popup #num_comments');
            num_comments.innerHTML = response.num_comments;

            let fotos_content = document.querySelector('.fotos_content');
            fotos_content.innerHTML = response.post_images;
            
            initSlides();
            initButtons();
        }
    };
    var formData = new FormData(); 

    formData.append('show_comments', 1);
    formData.append('postId', postId);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function addpost() {
    let bg_popup = document.getElementById('bg_popup');
    bg_popup.style.display = 'block';

    var displaySize = {
        "width": "600px",
        "height": "600px",
        "margin": "5vh auto"
    };
     
    var bgContainer = document.getElementById("bg_container");
    Object.assign(bgContainer.style, displaySize);

    let post_form = document.getElementById('post_form');
    post_form.style.display = 'block';
}

function createpost() {
    var picNames = document.querySelector('.post_foto_prev').getAttribute('data-pic-names');
    var postContent = document.getElementById('post_content').value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
            initButtons();
            initSlides();
            
            let bg_popup = document.getElementById('bg_popup');
            bg_popup.style.display = 'none';

            updatePostCount();
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formnewpost');
    formData.append('pic_name', picNames);
    formData.append('post_content', postContent);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function updatePostCount() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('posts').innerHTML = this.responseText;
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'getpostcount');

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function ratePost(event) {
    var formComments = event.target.closest('.post_container'); 
    var postId = formComments.querySelector('#postId').value;
    var stars = event.target.getAttribute('data-rate');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            // console.log(response);

            let post_rate_list = document.querySelector('[data-postID="'+postId+'"] #post_rate_list');
            if(post_rate_list != null) {
                post_rate_list.innerHTML = response.all_rates;

                let num_rate = document.querySelector('[data-postID="'+postId+'"] #num_rate');
                num_rate.innerHTML = response.num_rate;

                let rate_popup = document.querySelector('#rate_popup'+postId);
                rate_popup.innerHTML = response.rated_post;
            }
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formrate');
    formData.append('postId', postId);
    formData.append('stars', stars);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

//Close popups
document.addEventListener('mouseup', function(e) {
    var bg_container = document.getElementById('bg_container');

    if (!bg_container.contains(e.target)) {
        close_popup();
    }
});

function close_popup() {
    var bg_popup = document.getElementById('bg_popup');
    bg_popup.style.display = 'none';

    var comment_fotos_popup = document.getElementById('comment_fotos_popup');
    comment_fotos_popup.style.display = 'none';

    var post_form = document.getElementById('post_form');
    post_form.style.display = 'none';

    var pending_menu = document.getElementById('pending_menu');
    pending_menu.style.display = 'none';

    var activity_list = document.getElementById('activity_list');
    activity_list.style.display = 'none';

    var followers_list = document.getElementById('followers_list');
    followers_list.style.display = 'none';

    var list_i_follow = document.getElementById('list_i_follow');
    list_i_follow.style.display = 'none';
}

function fyllUp(star)
{
    for (i = 1; i < star+1; i++) {
        var stars = document.querySelectorAll("#star_mo"+i);
        stars.forEach(function(element){
            element.style.color = "pink";
        })
    }
}

function fyllOut(star)
{
    for (i = 1; i < star+1; i++) {
        var stars = document.querySelectorAll("#star_mo"+i);
        stars.forEach(function(element){
            element.style.color = "#666";
        })
    }
}

// FOTO SLIDER
let slideInitIndex = 1;

function initSlides() {
    let slides_container = document.querySelectorAll(".slideshow-container");
    slides_container.forEach((element)=>{
        element.setAttribute('slideIndex', slideInitIndex);
        let slides = element.getElementsByClassName("mySlides");
        if(slides.length == 0) {
            return;
        }
        // console.log(slides);
        let dots = element.getElementsByClassName("dot");

        if(slideInitIndex == 1) {
            let prevButton = element.querySelector('.prev');
            prevButton.style.display = 'none';
        }

        slides[slideInitIndex-1].style.display = "block";
        dots[slideInitIndex-1].className += " active";
    });
}

function showSlides(event) {

    let sliderContainer = event.target.closest('.slideshow-container');
    let n = parseInt(event.target.getAttribute('data-direction'));
    let slideIndex = parseInt(sliderContainer.getAttribute('slideIndex'));
    let prevButton = sliderContainer.querySelector('.prev');
    let nextButton = sliderContainer.querySelector('.next');

    let i;
    let slides = sliderContainer.getElementsByClassName("mySlides");

    slideIndex += n;

    if(slideIndex <= 1) {
        prevButton.style.display = 'none';
    } 
    if (slideIndex > 1) {
        prevButton.style.display = 'block';
    }
    if (slideIndex >= slides.length-1) {
        nextButton.style.display = 'none';
    }
    if (slideIndex <= slides.length-1) {
        nextButton.style.display = 'block';
    }
 
    let dots = sliderContainer.getElementsByClassName("dot");
    if (slideIndex > slides.length) {slideIndex = 1}

    if (slideIndex < 1) {slideIndex = slides.length}
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    sliderContainer.setAttribute('slideIndex', slideIndex);
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

function show_notices() {
    let bg_popup = document.getElementById('bg_popup');
    bg_popup.style.display = 'block';

    var displaySize = {
        "width": "450px",
        "height": "600px",
        "margin": "5vh auto"
    };
     
    var bgContainer = document.getElementById("bg_container");
    Object.assign(bgContainer.style, displaySize);

    let activity_list = document.getElementById('activity_list');
    activity_list.style.display = 'block';

    checked_notices();
}

function checked_notices() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.menu').outerHTML = this.responseText;

            let notices = document.getElementById('all_notices');
            notices.addEventListener('click', show_notices);
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formchecknotices');

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}
// function clean_search_enviroment() {
//     document.getElementById("usersresult").innerHTML = "";
// }