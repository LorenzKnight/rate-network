function search() {
    fetch("logic/search_be.php")
	.then(res => res.json())
	.then(data => {
    
        var searchUser = document.getElementById("searchuser").value;
        
        var containerStyle = {
            "background-color": "#FFF",
            "border-radius": "5px",
            "padding-bottom": "15px",
            "box-shadow": "0 4px 10px 0 rgba(47, 48, 63, 0.193)"
        };

        var containerReset = {
            "background-color": "",
            "border-radius": "0px",
            "box-shadow": "0 0 0 0 rgba(47, 48, 63, 0.193)"
        };
         
        var searchContainer = document.getElementById("search_container");
        Object.assign(searchContainer.style, containerStyle);

        if(searchUser == '') {
            Object.assign(searchContainer.style, containerReset);
            document.getElementById("usersresult").innerHTML = "";
            
            return;
        }
        var searchUser = searchUser.toLowerCase();
        var search_list = [];
        for (i=0; i < data.length; i++) {
            let isAdded = false;
            var usersData = [];
            usersData.push(data[i].name.toLowerCase());
            usersData.push(data[i].surname.toLowerCase());
            
            for (e=0; e < usersData.length; e++) {
                if (usersData[e].indexOf(searchUser) > -1 && !isAdded) {
                    search_list.push(data[i]);
                    isAdded = true;
                }
            }
        }

        document.getElementById("usersresult").innerHTML ="";
        for (j=0; j < search_list.length; j++) {
            var profilePic = search_list[j].image == null || search_list[j].image == '' ? 'blank_profile_picture.jpg' : search_list[j].image ;

            document.getElementById("usersresult").innerHTML += `
            <a href='#' onclick='goToUser("`+search_list[j].username+`")'>
                <li>
                    <div class='x_small_profile_sphere'>
                        <img src='pic/`+profilePic+`' class='x_small_profile_pic'>
                    </div>
                    <div class='popup_profile_name'>
                        `+search_list[j].name+` `+search_list[j].surname+`
                    </div>
                </li>
            </a>`;
        }
    });
}

function goToUser(userId) {
    window.location.href = 'start.php?userID='+userId;
}