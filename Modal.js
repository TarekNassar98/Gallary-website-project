const image=document.getElementsByClassName('container');
const modal=document.getElementsByClassName('modal')[0];
const closeButton=document.getElementsByClassName('close')[0];

 function view(event){
        event.preventDefault();
        event.stopPropagation();
        modal.classList.add('visible');            
        modal.children[0].src=this.src;
    }

function close(){
    modal.classList.remove('visible');               
}

closeButton.onclick=close;

function addEvent(){
for(let i=0;i<image.length;i++){
    image[i].firstElementChild.firstElementChild.onclick=view;
  

}
}






