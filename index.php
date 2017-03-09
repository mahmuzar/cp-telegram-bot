<?php
include 'autoload.php';
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$controller = new \clientogram\controller\Controller();
$controller->init();
$controller->mesageFrame();
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Телеграм бот</title>
        <script src="/clientogram/js/jquery-3.1.1.min.js"></script>
        <script src="/clientogram/js/script.js"></script>
        <link rel="stylesheet" href="/clientogram/css/font-awesome.min.css">
        <meta charset="utf-8">
        <style>
            @font-face {
                font-family: "SF-UI-Display-Light"; /* Имя шрифта */
                src: url(clientogram/fonts/SF-UI-Display-Light.ttf); /* Путь к файлу со шрифтом */
            }
            @font-face {
                font-family: "SF-UI-Display-Bold"; /* Имя шрифта */
                src: url(clientogram/fonts/SF-UI-Display-Bold.ttf); /* Путь к файлу со шрифтом */
            }
            @font-face {
                font-family: "SF-UI-Display-Medium"; /* Имя шрифта */
                src: url(clientogram/fonts/SF-UI-Display-Medium.ttf); /* Путь к файлу со шрифтом */
            }
            @font-face {
                font-family: "SF-UI-Display-Regular"; /* Имя шрифта */
                src: url(clientogram/fonts/SF-UI-Display-Regular.ttf); /* Путь к файлу со шрифтом */
            }
            html, body{
                margin: 0;
                padding: 0;
                background-color: white;
            }
            html,body{
                width: 100%;

                height: 100%;
                margin: 0;
                padding: 0;
                background-image: url(clientogram/images/squama_bg.jpg);
                background-color: white;
            }
            .contaner{
                background-color: inherit;
                max-width: 1400px;
                height: 100%;
                width: 80%;
                min-width: 1200px;
                overflow-x: hidden;
                margin: auto;
                box-shadow: 0 -10px 5px 1px   #DDDDDD;
            }
            /* Бренд сайта */
            header{
                display: flex;
                flex-flow: row wrap;
            }
            #elephant{
                margin: 0 0 0 20px;
            }
            #elephant img{
                padding: 10px;
                height: 40px;
            }
            #elephant span{
                font-family: "SF-UI-Display-Light";
                font-size: 14pt;
                color:   #a5a5a5;
                position: relative;
                top: -25px;
            }
            /* Конец бренд сайта */
            /* Вторая чать шапки сайта */
            input{
                padding: 15px;
                border: 0;
                font-family: "SF-UI-Display-Regular";
            }
            input[type='text']{
                font-size: 14pt;
                border-radius: 4px 0 0 4px;
                font-family: inherit;
                color:   #a5a5a5;
                padding: 12px;
                transition: 0.5s;

            }
            input:focus{
                outline: none;
            }
            input[type='button']{
                border-radius: 0 4px  4px 0 ;
                background-image: url(clientogram/images/logo.png);
                background-repeat: no-repeat;
                background-position: center;
                background-color: #2FA8DF;
            }
            .top-form{
                height: 80px;


                display: flex;
                flex-flow: row wrap;
            }
            .top-form .elect{

                align-items: center !important;
                align-content: center !important;
                flex: 0 1 0;
                order: 1;
                font-size: 14pt;
                padding: 0 30px 0 30px;

            }

            .top-form .elect span{
                color: #C6C6C6;
                transition: 0.3s;
            }
            .top-form .elect span:hover{
                color: orange;
                cursor: pointer;    
            }
            .form{

                width: 100%;
                flex: 15 1 0;
                order: 2;
            }
            form{
                flex-basis: 100%;
            }
            .flex{
                display: flex;
                align-items: center;
            }
            .form-group{
                flex-flow: row wrap;
                padding-right: 20px;
            }
            .input-text{
                flex: 20 1 0;
                order: 1;
            }
            .button{
                flex: 1 1 0;
                order: 2;
            }


            #left{
                padding: 0;
                height: 100%;
                border-top: 0;
                border-left: 0;
                border-bottom: 0;
            }
            #content{
                padding: 20px 0 0 8px;
                overflow-y: auto;
                height: 100%; 
                border: 0;
                width: calc(100% - 451px); 
            }
            #one{
                display: flex;
                border-left: 0;
                border-top: 0;
                align-items: center;
                align-content: center;

            }
            #header_two{
                width: calc(100% - 451px); 
                border-left: 0;
                border-right: 0;
                border-top: 0;

            }
            .header{
                height: 85px;
                background-color: #EDEDEE;
            }

            .left_menu{
                width: 450px;

            }
            .main{
                height: calc(100% - 87px);
                display: flex;
                flex-flow: column wrap;
            }
            /* левая панель чата */
            .left {
                transition: 0.4s;
                border-bottom: 1px solid white;
                font-family: "SF-UI-Display-Bold";
                height: 95px;
                display: flex;
                flex-flow:  row wrap;
                align-items:  center; /* Выравнивание текста по вертикали */
            }
            .left:first-child{
                border-top: 0  !important;
            }
            .left:hover{
                background-color: #EDEDEE !important;
            }
            .left_flex{
                display: flex;
                height: 100%;
                align-items:  baseline; /* Выравнивание текста по вертикали */
                justify-content: flex-start; /* Выравнивание текста по горизонтали */
            }
            .left_one{
                flex-flow: row wrap;
                flex: 1 1 0;
                order: 1;
                width: 100%;

            }
            .in_left_one{
                padding: 10px;
            }
            .chat_name{
                flex: 10 1 0;
                order: 1;
                font-family: "SF-UI-Display-Medium";
                align-items: center;

                font-size: 15pt;
                color: #124E72;

            }
            .chat_name span{
                margin-left: 10px;
            }
            .chat_name span.star{
                color: #F3BD3D;
                font-size: 13pt;
                transition: 1s;
                opacity: 0;

            }
            .chat_name span.elect{


                opacity: 1 !important;

            }

            .last_date{
                font-family: "SF-UI-Display-Light";
                font-weight: 600;
                font-size: 13pt;
                color: #ADADAD;
                align-content: flex-end;
                flex: 1 0 0;
                order: 3; 
            }
            .left_two{
                flex-flow: row wrap;
                width: 100%;
                flex: 1 1 0;
                order: 2; 
            }
            .in_left_two{
                padding: 10px;
            }
            .last_message{
                font-family: "SF-UI-Display-Medium";
                color:   #ADADAD;
                flex: 13 1 0;
                order: 1;
            }
            .new_message{
                flex: 1 1 0;
                order: 2;

            }
            .new_message span{
                color: white;
                transition: 1s;
                opacity: 0 ;
            }
            .ava{
                margin-left: 15px;
                align-content: center;
                align-items: center;
                flex: 0 1 20%;
                order: 1; /* Первый блок */
            }
            .ava img{
                height: 80%;
                border-radius: 50%;
            }
            .chat_info{

                flex-flow:  column wrap;

                flex: 1 1 0;
                order: 2; /* Второй блок */

            }
            .b_bt{


                border-bottom: 1px solid #E2E2E2;  
            }
            /* пользователь выбран для переписки */
            #active{
                background-color: #EDEDEE !important;
            }
            .mark{
                color: #FF7F7F !important;
                opacity: 1 !important;
            }

            .bb{
                border-bottom: 1px solid #E2E2E2;
            }
            /* конец левой панели чата*/
            /* окно вывода сообщений */
            .message{
                padding: 0 0 10px 0;
                display: flex;
                height: 60px;
                flex-flow: row wrap;
            }
            .ava{
                padding: 0 20px 0 0;
                flex: 0 1 0;
                order: 1;
            }
            #content .ava img{
                height: 50px;
                border-radius: 50%;
            }
            .text_message{
                flex: 8 0 0;
                order: 2;
                word-break: break-all;
                font-size: 13pt;
                color: #4D4D4D;
                font-family: "SF-UI-Display-Medium";
            }
            .message_send_date{
                padding: 9px 0 0 40px;
                flex: 1 0 0;
                order: 3;
                align-content: flex-end !important;
                font-family: "SF-UI-Display-Medium";
                color:   #ADADAD;
            }
            .message_flex{
                display: flex;
                align-content: flex-start;
                align-items: center;
            }
            .iframe{
                border: 1px solid #E2E2E2;
            }
        </style>
    </head>
    <body > 

        <div class="contaner">
            <header>
                <div id="one" class="brand header left_menu iframe">
                    <div id="elephant">
                        <img alt="Brand" src="/clientogram/images/php_elephant.svg">
                        <span id="logo_text"><b>PHP</b> Developers contest
                        </span>
                    </div>
                </div>
                <div id="header_two" class="nav header iframe">
                    <div class="top-form flex">
                        <div class="elect flex">
                            <span data-chat_id="" id="add_elect" class="header_star">
                                <i class="fa fa-star fa-fw"></i>
                            </span>
                        </div>
                        <div class="form flex">
                            <form id="message_form" action="">
                                <div class="form-group flex">

                                    <input class="form-control flex input-text" id="message_input" type="text" placeholder="Сообщение...">
                                    <input class='form-control flex button' id="enter" type="button" name="enter" value="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main">
                <div id="left" class="side_bar left_menu iframe">

                </div>

                <div id="content" class="content iframe">

                </div>
            </div>

        </div>
        <script>

            var one_active_id = document.getElementById('active')
            localStorage.setItem('active_chat_id', $(one_active_id).attr('data-chat_id'));
            window.onload = function () {
                $.get("http://78.24.221.67/contentt.php", function (data) {
                    $('#content').html(data);
                });
                $.get("http://78.24.221.67/leftt.php", function (data) {
                    $('#left').html(data);
                    //alert("Load was performed.");
                    init();
                    // setInterval('sec()',10000);  


                });
                check();
            };

            /**
             * Помечает активным контакт на который кликнули
             * @returns {active}
             */
            function active() {
                //var one_active_id = document.getElementById('active')
                localStorage.setItem('active_chat_id', $(this).attr('data-chat_id'));
                var add_elect_chat_id = document.getElementById('add_elect');
                add_elect_chat_id.setAttribute('data-chat_id', localStorage.getItem('active_chat_id'));
                //alert($(this).attr('data-chat_id'));
                localStorage.setItem('active_chat_id', $(this).attr('data-chat_id'));
                //add_elect.setAttribute('data-chat_id', $(this).attr('data-chat_id'));
                var left_active = document.getElementById('active');
                if (!left_active) {
                    this.id = 'active';
                    left_active = document.getElementById('active');
                }
                //console.log(left_active);
                if (left_active.getAttribute('data-chat_id') != this.getAttribute('data-chat_id')) {
                    //alert('not empty');
                    left_active.id = '';
                    //left_active.style.borderBottom = '1px solid white';
                    left_active.classList.remove('bb');

                    if (left_active.previousElementSibling) {
                        left_active.previousElementSibling.classList.remove('bb');
                    }

                }

                //console.log(this);
                this.id = 'active';
                //this.style.borderBottom = '1px solid #E2E2E2';
                if (this.previousElementSibling) {
                    if (this.nextElementSibling) {
                        this.previousElementSibling.classList.add('bb');
                        this.classList.add('bb');
                    } else {
                        this.previousElementSibling.classList.add('bb');
                        this.classList.add('bb');
                    }

                } else {
                    if (this.nextElementSibling) {

                        this.classList.add('bb');
                    } else {

                        this.classList.add('bb');
                    }
                }
                var mark = this.children[1].children[1].children[1].children[0];
                //console.log(mark);

                if (mark.classList.contains('mark')) {
                    $.post("http://78.24.221.67/ajax_processing.php/?method=mark", {chat_id: this.getAttribute('data-chat_id')})
                            .done(function (data) {
                                var active_chat = document.getElementById('active');
                                //var span = active_chat.getElementById('elect');
                                var mark = active_chat.children[1].children[1].children[1].children[0];
                                //console.log(mark);
                                mark.classList.remove('mark');
                            });
                }

                $.get("http://78.24.221.67/ajax_processing.php/?method=active&chat_id=" + this.getAttribute('data-chat_id'), function (data) {

                });
                $.get("http://78.24.221.67/contentt.php", function (data) {
                    $('#content').html(data);
                });
            }
            /**
             * Функция задает стили для боковой панели списка контактов при наведении 
             * мыши
             * @returns {undefined}
             */
            function mouseOver() {

                if (!this.id) {
                    if (this.previousElementSibling) {
                        if (this.nextElementSibling) {

                            this.previousElementSibling.classList.add('bb');
                            this.classList.add('bb');


                        } else {
                            this.previousElementSibling.classList.add('bb');
                            this.classList.add('bb');
                        }
                    } else {
                        if (this.nextElementSibling) {

                            this.classList.add('bb');
                        } else {

                            this.classList.add('bb');
                        }
                    }


                }

            }
            /**
             * Функция задает стили для боковой панели списка контактов когда убираем мышь
             * @returns {undefined}
             */
            function mouseOut() {

                if (!this.id) {
                    if (this.previousElementSibling) {
                        if (this.nextElementSibling) {
                            if (this.previousElementSibling.id !== 'active') {
                                //this.previousElementSibling.classList.remove('bb');
                            } else {
                                this.classList.remove('bb');
                            }
                        } else {
                            this.classList.remove('bb');
                        }
                    } else {
                        if (this.nextElementSibling) {
                            if (this.nextElementSibling.id !== 'active') {
                                this.classList.remove('bb');
                            }

                        } else {
                            this.classList.remove('bb');
                        }
                    }


                }

            }


            /*
             * Конец БОКОВОЙ ПАНЕЛИ
             */
            /* форма отправки сообщений */
            add_elect.onclick = function () {
                //console.log('a');
                var ll = document.getElementsByClassName('left');
                //console.log(ll.length);
                for (var i = 0, ln = ll.length; i < ln; i++) {
                    //console.log(ll[i].children[1].children[0].children[0].children[0]);
                    if (ll[i].getAttribute('data-chat_id') == this.getAttribute('data-chat_id')) {
                        // alert('d');
                        if (ll[i].children[1].children[0].children[0].children[0].classList.contains('elect')) {
                            ll[i].children[1].children[0].children[0].children[0].classList.remove('elect');

                        } else {
                            ll[i].children[1].children[0].children[0].children[0].classList.add('elect');
                        }
                    }
                }
                $.get('http://78.24.221.67/ajax_processing.php/?method=updateElect&' +
                        'chat_id=' + this.getAttribute('data-chat_id'), function (data) {
                });


            };
            add_elect.onmouseover = function () {
                //this.setAttribute('data-chat_id', (localStorage.getItem('active_chat')));
            };

            function message() {

                //console.log(message_input);
                if (!message_input.value) {
                    message_input.setAttribute('placeholder', 'Введите текст');
                    message_input.style.color = "red";
                    return;
                }

                var active_chat = document.getElementById('active');
                $.post("http://78.24.221.67/ajax_processing.php/?method=sendMessage",
                        {chat_id: {chat_id: active_chat.getAttribute('data-chat_id'),
                                text: message_input.value}}
                )
                        .done(function (data) {
                            //alert("Data Loaded: " + data);
                            //localStorage.setItem('newMessage', true);
                            sec();
                        });

                message_input.value = '';
                return false;
            }


            message_form.onsubmit = message;
            enter.onclick = message;
            message_input.onsubmit = message;
            message_input.oninput = function () {
                message_input.style.color = '';
            };

            function sec() {
                $.get("http://78.24.221.67/contentt.php", function (data) {
                    $('#content').html(data);
                });
                $.get("http://78.24.221.67/leftt.php", function (data) {
                    $('#left').html(data);
                    //alert("Load was performed.");

                    // setInterval('sec()',10000);  
                    init();

                });
            }

            function check() {
                $.get("http://78.24.221.67/json.php", function (data) {
                    //$('#content').html(data);
                    if (data == 1) {
                        sec();
                        //alert('d');
                        //console.log(data);

                    }
                });
                setTimeout(check, 2000);
                //check();
            }


            //setInterval(check, 1000);

        </script>
    </body>
</html>