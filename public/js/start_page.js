document.addEventListener("DOMContentLoaded", () => {
    let submit_comment_button = document.querySelectorAll('.submit_comments');
    submit_comment_button.forEach((element)=>{
        element.addEventListener('click', sendComment);
    });

    let submit_rate_button = document.querySelectorAll('.rating_star');
    submit_rate_button.forEach((element)=>{
        element.addEventListener('click', ratePost);
    });
});

function sendComment(event) {
    var formComments = event.target.closest('.post_container'); 
    console.log(formComments);
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

            let bg_comments_popup = document.getElementById('bg_comments_popup');
            bg_comments_popup.style.display = "block";

            let post_fotos_coments = document.getElementById('comments_popup');
            post_fotos_coments.innerHTML = post_fotos_coments.innerHTML+response.comments_html;

            let popup_profile = document.getElementById('popup_profile');
            popup_profile.innerHTML = response.post_author;

            let num_comments = document.querySelector('#bg_comments_popup #num_comments');
            num_comments.innerHTML = response.num_comments;
        }
    };
    var formData = new FormData(); 

    formData.append('show_comments', 1);
    formData.append('postId', postId);

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

            console.log(response);

            let post_rate_list = formComments.querySelector('#post_rate_list');
            if(post_rate_list != null) {
                post_rate_list.innerHTML = response.all_rates;

                let num_rate = formComments.querySelector('#num_rate');
                num_rate.innerHTML = response.num_rate;
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

function showrate()
{
    bgPopUp = document.getElementById('rate_popup');
    bgPopUp.style.display = "block";
}

document.addEventListener('mouseup', function(e) {
    var popup = document.getElementById('comment_fotos_popup');
    var bg_popup = document.getElementById('bg_comments_popup');

    if (!popup.contains(e.target)) {
        bg_popup.style.display = 'none';
    }
});

function fyllUp(star)
{
    var star1 = document.getElementById("star_mo1");
    var star2 = document.getElementById("star_mo2");
    var star3 = document.getElementById("star_mo3");
    var star4 = document.getElementById("star_mo4");
    var star5 = document.getElementById("star_mo5");

    switch (star)
    {
        case 1:
            star1.style.color = "pink"
            break
        case 2:
            star1.style.color = "pink"
            star2.style.color = "pink"
            break
        case 3:
            star1.style.color = "pink"
            star2.style.color = "pink"
            star3.style.color = "pink"
            break
        case 4:
            star1.style.color = "pink"
            star2.style.color = "pink"
            star3.style.color = "pink"
            star4.style.color = "pink"
            break
        case 5:
            star1.style.color = "pink"
            star2.style.color = "pink"
            star3.style.color = "pink"
            star4.style.color = "pink"
            star5.style.color = "pink"
            break
    }
}

function fyllOut(star)
{
    var star1 = document.getElementById("star_mo1");
    var star2 = document.getElementById("star_mo2");
    var star3 = document.getElementById("star_mo3");
    var star4 = document.getElementById("star_mo4");
    var star5 = document.getElementById("star_mo5");

    switch (star)
    {
        case 1:
            star1.style.color = "#666"
            break
        case 2:
            star1.style.color = "#666"
            star2.style.color = "#666"
            break
        case 3:
            star1.style.color = "#666"
            star2.style.color = "#666"
            star3.style.color = "#666"
            break
        case 4:
            star1.style.color = "#666"
            star2.style.color = "#666"
            star3.style.color = "#666"
            star4.style.color = "#666"
            break
        case 5:
            star1.style.color = "#666"
            star2.style.color = "#666"
            star3.style.color = "#666"
            star4.style.color = "#666"
            star5.style.color = "#666"
            break
    }
}