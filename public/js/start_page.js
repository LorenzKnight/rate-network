function bridge(pic, name, surname, rank) {

    var profile_pic = document.getElementById("profile_sphere");

    profile_pic.innerHTML = "<img src=src/img/"+pic+" class='porfile_pic'>";

    
    var names = document.getElementById("names");
    var namesinfo = name+' '+surname;

    names.innerHTML = namesinfo;


    var rankcont = document.getElementById("rank");
    var rank = rank.toString();
    
    if (rank !== 'null' && rank.length == 1) {
        var desimalpri = rank+'.0';
        var desimalsec = '00';
    }
    else if (rank !== 'null' && rank.length > 1 && rank.length < 4) {
        var desimalpri = rank.slice(0,3);
        var desimalsec = '00';
    }
    else if (rank !== 'null' && rank.length == 4) {
        var desimalpri = rank.slice(0,3);
        var desimalsec = rank.slice(3,4)+'0';
    }
    else if (rank !== 'null' && rank.length > 4) {
        var desimalpri = rank.slice(0,3);
        var desimalsec = rank.slice(3,5);
    }
    
    rankcont.innerHTML = '<div>'+desimalpri+'<span style="font-size: 2.5rem;">'+desimalsec+'</span></div>';
}

function postwall(text)
{
    var content = document.getElementById("post_profile_desc");
    var textinfo = text;

    content.innerHTML = textinfo;
}

// window.addEventListener('load', function(event) {
//     initCanvas();
//     console.log("App is ON");
// });