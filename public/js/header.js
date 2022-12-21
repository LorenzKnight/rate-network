document.addEventListener("DOMContentLoaded", () => {
    fetch("logic/header_be.php")
	.then(res => res.json())
	.then(data => {
        var profile_pic = document.getElementById("profile_sphere");
        var names = document.getElementById("names");
        var rankcont = document.getElementById("rank");
        var title = document.getElementById("title");
        var followers = document.getElementById("followers");
        var following = document.getElementById("following");

        var firstname = data.name;
        var lastname = data.surname;
        var pic = data.image == null || data.image == '' ? 'blank_profile_picture.jpg' : data.image;
        var job = data.job;
        var they_follow_me = data.followers;
        var is_following = data.following;

        var rate = data.rate;
        var rate = rate.toString();
        
        if (rate !== 'null' && rate.length == 1) {
            var desimalpri = rate+'.0';
            var desimalsec = '00';
        }
        else if (rate !== 'null' && rate.length > 1 && rate.length < 4) {
            var desimalpri = rate.slice(0,3);
            var desimalsec = '00';
        }
        else if (rate !== 'null' && rate.length == 4) {
            var desimalpri = rate.slice(0,3);
            var desimalsec = rate.slice(3,4)+'0';
        }
        else if (rate !== 'null' && rate.length > 4) {
            var desimalpri = rate.slice(0,3);
            var desimalsec = rate.slice(3,5);
        }

        profile_pic.innerHTML = "<img src=pic/"+pic+" class='porfile_pic'>";
        names.innerHTML = firstname+' '+lastname;
        rankcont.innerHTML = '<div>'+desimalpri+'<span style="font-size: 2.5rem;">'+desimalsec+'</span></div>';
        if(typeof(job) != 'undefined' && job !== null)
        {
            title.innerHTML = 'Currently working<br>at '+job;
        }
        followers.innerHTML = they_follow_me;
        following.innerHTML = is_following;
	});
});

// function initFollowButtons() {
//     let search_enviroment = document.getElementById('searchuser');
//     search_enviroment.addEventListener('focusout', clean_search_enviroment);
// }

function follow(myId, userId) {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.profile_access').outerHTML = this.responseText;
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formfollowrequest');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function unfollow(myId, userId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.profile_access').outerHTML = this.responseText;

            var bg_popup = document.getElementById('bg_popup');
            bg_popup.style.display = 'none';

            var pending_menu = document.getElementById('pending_menu');
            pending_menu.style.display = 'none';
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formunfollow');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function undo_follow_request() {
    let bg_popup = document.getElementById('bg_popup');
    bg_popup.style.display = 'block';

    var displaySize = {
        "width": "300px",
        "height": "250px",
        "margin": "20vh auto"
    };
     
    var bgContainer = document.getElementById("bg_container");
    Object.assign(bgContainer.style, displaySize);

    let pending_menu = document.getElementById('pending_menu');
    pending_menu.style.display = 'block';
}