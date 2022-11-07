document.addEventListener("DOMContentLoaded", () => {
    let submit_button = document.getElementById('submit_comment');
    submit_button.addEventListener('click', sendComment);

    // var adress = "logic/start_be.php";
   
    // fetch(adress)
	// .then(res => res.json())
	// .then(data => {
    //     console.log(adress);
    //     var row_num = data.length;
        
    //     for(i=0; i<row_num; i++) {
    //         var pic = data[i].userId == '' ? 'blank_profile_picture.jpg' : 'profile_pic';
            
    //         var test = pic == 3 ? 'blank_profile_picture.jpg' : data[i].userId;
    //         document.getElementById("content").innerHTML += 
    //         `<div class="public_post_in_wall">
    //             <div class='post_profil'>
    //                 <div class='small_profile_sphere'>
    //                     <img src='pic/`+test+`' class='small_porfile_pic'>
    //                 </div>
    //                 <div class='post_profile_desc' id='post_profile_desc'>
    //                     `+data[i].content+`
    //                 </div>
    //             </div>
    //             <div class='content'>
    //                 <div class='post_fotos'>
    //                     `+data[i].mediaId+`
    //                 </div>
    //                 <div class='post_comments'>
    //                 </div>
    //             </div>
    //         </div>`
    //         ;
    //     }
    // });
});

function sendComment() {

    var postId = document.getElementById('postId').value;
    var comment = document.getElementById('comment').value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                let num_comments = document.getElementById('num_comments');
                
                num_comments.innerHTML = response.num_comments;

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
            
            // console.log(response);
            post_fotos_coments.innerHTML = post_fotos_coments.innerHTML+response.comments_html;
        }
    };
    var formData = new FormData(); 

    formData.append('show_comments', 1);
    formData.append('postId', postId);

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