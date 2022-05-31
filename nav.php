<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="nav.css">

</head>
<body>

    <nav>

        <div class="collapse hide ">
        <ul>     
            <li class="logo"><a href="./index.php"><i class="far fa-image fa-5x"></i></a></li> 
        <li class="search">
            
            <form action="search.php">
            <input    name='q' title="only numbers and letter are accepted" required pattern="[a-zA-Z0-9]+" type="search" name="" id="search" placeholder="search the site..." value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>"> <button>SEARCH</button></form>
            <ul style = "z-index:8" id="sugg">
              
            </ul>
        </li>
        
      
    
        <li class="rs"><button  id="set"><i class="fa-solid fa-user fa-2x"></i></button>
            <ul id="opt" class="hide-opt">
                <li id="arrow"></li>
                <li><a href="MyProfile.php">My Profile</a></li>
                <li><a href="MyFavourite.php">My Favorites</a></li>
                <li> <a href="login.php">Sign Out</a></li>
            </ul>
            </li>
        </ul>
        
    
    </div>
    <span class="collapse-button"><button><i class="fa-solid fa-bars fa-2x"></i></button></span>
    </nav>

</body>

<!--  configure the 'collapse' button click for small screen sizes..  -->

<script>

const collapseButton=document.getElementsByClassName('collapse-button')[0];
const collapseDiv=document.getElementsByClassName('collapse')[0];
collapseButton.onclick=function(event){
     collapseDiv.classList.toggle('hide');
     collapseButton.classList.toggle('fixed');
    }


    //configure 'live search' 

    
const suggList = document.getElementById('sugg');
const searchReq = new XMLHttpRequest();
//when data is ready
searchReq.onreadystatechange=function() {
      
    if (this.readyState==4 && this.status==200) {
        
        suggList.innerHTML=searchReq.responseText;
        suggList.style.border = "2px solid black";
}

}


// hide sugg if the input search is empty
function hideList()
{
        suggList.style.border = "0";
        suggList.innerHTML="";
}


       // output the selected sugg by the user into the search bar
       function output(field){
        document.getElementsByName('q')[0].value = field.textContent ; 
        hideList();
       }

// apply live search (whenever the user change the search field)
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input',  function  updateValue(){
        if(this.value.length==0||!this.value.match(/^[A-Za-z0-9_-]*$/)){
            hideList();
    }
        else{
            
            const q = this.value.trim(); // remove extra spaces .
            searchReq.open("GET", `liveSearch.php?q=${q}` );
            searchReq.send();
        
        }
        });
    

        
    // configure 'profile logo ' click  

    document.getElementById('set').onclick =function(){
        document.getElementById('opt').classList.toggle('show-opt');
        document.getElementById('opt').classList.toggle('hide-opt');
            }



</script>
</html>

