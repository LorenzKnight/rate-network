document.addEventListener("DOMContentLoaded", () => {
    fetch("logic/header_logic.php")
	.then(res => res.json())
	.then(data => {
        // console.log(data.name)
        var profile_pic = document.getElementById("profile_sphere");
        var names = document.getElementById("names");
        var rankcont = document.getElementById("rank");

        var firstname = data.name;
        var lastname = data.surname;
        var pic = data.image;
        
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
	});
});

// function postwall(text)
// {
//     var content = document.getElementById("post_profile_desc");
//     var textinfo = text;

//     content.innerHTML = textinfo;
// }