/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function init() {
    var left = document.getElementsByClassName('left');
    console.log(left);
    for (i = 0, l = left.length; i < l; i++) {

        left[i].onclick = active;
        left[i].onmouseover = mouseOver;
        left[i].onmouseout = mouseOut;
    }
    var active_left = document.getElementById('active');

    if (active_left) {
        if (active_left.previousElementSibling) {
            if (active_left.nextElementSibling) {
                active_left.previousElementSibling.classList.add('bb');
                active_left.classList.add('bb');
            } else {
                active_left.previousElementSibling.classList.add('bb');
                active_left.classList.add('bb');
            }

        } else {
            if (active_left.nextElementSibling) {

                active_left.classList.add('bb');
            } else {

                active_left.classList.add('bb');
            }
        }
    }
    var chat_id = localStorage.getItem('active_chat_id');
    if(chat_id){
        var add_elect_chat_id = document.getElementById('add_elect');
                add_elect_chat_id.setAttribute('data-chat_id', chat_id);
    }
   

}