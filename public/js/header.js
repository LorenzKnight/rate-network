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