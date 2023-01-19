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
        var posts = document.getElementById("posts");

        var firstname = data.name;
        var lastname = data.surname;
        var pic = data.image == null || data.image == '' ? 'blank_profile_picture.jpg' : data.image;
        var job = data.job;

        // console.log(data.followers);
        // var my_followers = 289;
        var my_followers = data.followers
        var they_follow_me = cipherSimplifyer(my_followers);
        
        var i_follow = data.following
        var is_following = cipherSimplifyer(i_follow);

        var allposts = data.allpost;

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

        profile_pic.innerHTML = "<img src=pic/"+pic+" class='profile_foto'>";
        names.innerHTML = firstname+' '+lastname;
        rankcont.innerHTML = '<div>'+desimalpri+'<span style="font-size: 2.5rem;">'+desimalsec+'</span></div>';
        if(typeof(job) != 'undefined' && job !== null)
        {
            title.innerHTML = 'Currently working<br>at '+job;
        }
        followers.innerHTML = they_follow_me;
        following.innerHTML = is_following;
        posts.innerHTML = allposts;
	});
});

function follow(myId, userId, where) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(where == 1) {
                document.querySelector('.profile_access').outerHTML = this.responseText;
            } else {
                document.querySelector('.activity_list').outerHTML = this.responseText;
            }
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formfollowrequest');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);
    formData.append('where', where);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function unfollow(myId, userId, where) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (where == 1) {
                document.querySelector('.profile_access').outerHTML = this.responseText;
            } else {
                document.querySelector('.activity_list').outerHTML = this.responseText;
            }

            // var bg_popup = document.getElementById('bg_popup');
            // bg_popup.style.display = 'none';

            // var pending_menu = document.getElementById('pending_menu');
            // pending_menu.style.display = 'none';
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formunfollow');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);
    formData.append('where', where);

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

function follow_confirm(myId, userId) {
    console.log(myId, userId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.activity_list').outerHTML = this.responseText;
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formfollowconfirm');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function remove_request(myId, userId) {
    console.log(myId, userId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('.activity_list').outerHTML = this.responseText;
        }
    };
    var formData = new FormData(); 
    formData.append('MM_insert', 'formrequestdelete');
    formData.append('my_Id', myId);
    formData.append('user_Id', userId);

    xmlhttp.open("POST", "logic/start_be.php", true);
    xmlhttp.send(formData);
}

function cipherSimplifyer(my_followers) {
    var my_followers = my_followers.toString()
        
    if(my_followers.length >= 5 && my_followers.length < 6)
    {
        return my_followers.slice(0,2)+_simplifierAfterPoint(my_followers.slice(2,5))+'K';
    }
    else if(my_followers.length >= 6 && my_followers.length < 7)
    {
        return my_followers.slice(0,3)+_simplifierAfterPoint(my_followers.slice(3,6))+'K';
    }
    else if(my_followers.length >= 7 && my_followers.length < 8)
    {
        return my_followers.slice(0,1)+_simplifierAfterPoint(my_followers.slice(1,7))+'M';
    }
    else if(my_followers.length >= 8 && my_followers.length < 9)
    {
        return my_followers.slice(0,2)+_simplifierAfterPoint(my_followers.slice(1,8))+'M';
    }
    else if(my_followers.length >= 9 && my_followers.length < 10)
    {
        return my_followers.slice(0,3)+_simplifierAfterPoint(my_followers.slice(1,9))+'M';
    }
    else
    {
        return my_followers;
    }
}

function _simplifierAfterPoint(my_followers) {

    if((my_followers > 99 && my_followers < 200) || (my_followers > 99999 && my_followers < 200000)){
        return '.'+1;
    }
    else if((my_followers > 199 && my_followers < 300) || (my_followers > 199999 && my_followers < 300000)){
        return '.'+2;
    }
    else if((my_followers > 299 && my_followers < 400) || (my_followers > 299999 && my_followers < 400000)){
        return '.'+3;
    }
    else if((my_followers > 399 && my_followers < 500) || (my_followers > 399999 && my_followers < 500000)){
        return '.'+4;
    }
    else if((my_followers > 499 && my_followers < 600) || (my_followers > 499999 && my_followers < 600000)){
        return '.'+5;
    }
    else if((my_followers > 599 && my_followers < 700) || (my_followers > 599999 && my_followers < 700000)){
        return '.'+6;
    }
    else if((my_followers > 699 && my_followers < 800) || (my_followers > 699999 && my_followers < 800000)){
        return '.'+7;
    }
    else if((my_followers > 799 && my_followers < 900) || (my_followers > 799999 && my_followers < 900000)){
        return '.'+8;
    }
    else if((my_followers > 899 && my_followers < 1000) || (my_followers > 899999 && my_followers < 1000000)){
        return '.'+9;
    }
    else
    {
        return '';
    }
}

function followers() {
    console.log('followers');
}

function i_follow() {
    console.log('i follow');
}