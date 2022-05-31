// data state ...
onload=()=>{
 const state = document.getElementById('state');
 state.style.textAlign='center';
 state.style.display = 'none';


/*  get site content ... */

const documentTitle=document.title;
const xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        document.getElementsByClassName('row')[0].insertAdjacentHTML('beforeend',xhttp.responseText);
        inc=document.getElementsByClassName('container').length;
        addEvent();
        addFavEvent();
        if(documentTitle=="Favourite"){
            addRemoveItemEvent();
        }
        }
    else if(this.readyState==4 && this.status==201){
        state.style.display = "block";

    }




  }

// get more data from db ..
  let inc=0;
  const load = document.getElementsByClassName('loading')[0];
  load.addEventListener('click' , function(){
    if(window.location.search.includes('q')) //search page..
{
    const urlParams = new URLSearchParams(location.search);
    const q= urlParams.get('q');
    xhttp.open('GET',`content.php/?inc=${inc}&q=${q}&page=search`); 

}




else if(documentTitle=="Favourite")
xhttp.open("GET", `content.php?inc=${inc}&page=fav`);



    // browse ..
    else{

        xhttp.open("GET", `content.php?page=home&inc=${inc}`);
        }
        xhttp.send();
 }
);
        load.click();


function addRemoveItemEvent(){
    const allDeleteButt = document.getElementsByClassName('del');
     for(const deleteButt of allDeleteButt){
     deleteButt.onclick=function(){
        res = confirm('Are you sure you want to remove this from the list ?');
    const parentContainer = this.parentElement;
    const img_id = this.id;
                    
            xhttp.open("GET", `remove.php?imgid=${img_id}`);
           
    
    if(res){
            xhttp.send();
            parentContainer.classList.add('trans');
            setTimeout(function(){
            parentContainer.classList.add('remove');
            
            },500);        
        }
    }
}
}


function addFavEvent(){
    const favButtonElements = document.getElementsByName('fav');
    for(const buttonElm of favButtonElements){

    buttonElm.onclick=function(){

    xhttp.open("GET", `add.php?imgid=${this.value}`);
    xhttp.send();
}

}

}

}