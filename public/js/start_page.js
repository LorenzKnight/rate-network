document.addEventListener("DOMContentLoaded", () => {
    // fetch("logic/header_logic.php")
    // .then(res => res.json())
    // .then(data => {

    //     var row_num = data.length;
    //     console.log(row_num);
        
    //     for(i=0; i<row_num; i++) {
    //         console.log(data);
    //     }
    // });

    var adress = "logic/start_be.php";
   
    fetch(adress)
	.then(res => res.json())
	.then(data => {
        console.log(adress);
        var row_num = data.length;
        
        for(i=0; i<row_num; i++) {
            var pic = data[i].userId == '' ? 'blank_profile_picture.jpg' : 'profile_pic';
            
            var test = pic == 3 ? 'blank_profile_picture.jpg' : data[i].userId;
            document.getElementById("content").innerHTML += 
            `<div class="public_post_in_wall">
                <div class='post_profil'>
                    <div class='small_profile_sphere'>
                        <img src='pic/`+test+`' class='small_porfile_pic'>
                    </div>
                    <div class='post_profile_desc' id='post_profile_desc'>
                        `+data[i].content+`
                    </div>
                </div>
                <div class='content'>
                    <div class='post_fotos'>
                        `+data[i].mediaId+`
                    </div>
                    <div class='post_comments'>
                    </div>
                </div>
            </div>`
            ;
        }
    });
});

function test(id)
{
    
}