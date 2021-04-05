<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Need for a Ride - всеукраїнський клуб велосипедних походів та покатушок">
        <meta name='author' content='Vitalii Kolomiiets, Kyiv, Ukraine, vitaljan@gmail.com viber:+380632209770'>
        <title>Need4Ride  - велосипедні походи та покатушки</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="assets/plugin/explorer.js"></script>
        <script src="php/mysqlajax.js"></script>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="assets/plugin/explorer.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        
    <div class="header">
        <div class="header-content">
            <div class="register">
            <?
                if (1==2) {
                    
                }
                else
                {
                    echo "
                    <img id='login' class='register__item' src = 'assets/img/login.png' alt = 'Need for a ride - велосипедні походи та покатушки'>
                    <img id='register' class='register__item' src = 'assets/img/user-add.png' alt = 'Need for a ride - велосипедні походи та покатушки'>
                    ";
                }
            ?>
            </div> <!-- register -->

            <div class="nav-bar">

                <div class='slogan'>
                    Український велосипедний клуб
                </div> <!-- slogan -->

                <div class="menu-bar">

                    <img class='menu__item' src="assets/img/ride_button.png" alt="Need for a ride - велосипедні покатушки">
                    <img class='menu__item' src="assets/img/hike_button.png" alt="Need for a ride - велосипедні походи">

                </div> <!-- menu-bar -->

            </div> <!-- nav-bar -->
        </div> <!-- header-content -->

        <div class="separate-bar"></div>
        
    </div> <!-- header -->
    
    
<div class="logo">
    <div class="wheel1">
        <div>
            <div id='logo-globe' class="logo__globe">
                <img src="assets/img/globe.png" alt="Need for a ride - велосипедні походи та покатушки">
            </div>
        </div>
        <div>
            <div id='logo-wheel' class="logo__wheel">
                <img src="assets/img/wheel.png" alt="Need for a ride - велосипедні походи та покатушки">
            </div>
        </div>
    </div>
    <div class='logo-text'>
        <div class="row1">Need</div>
        <div class="row2">For</div>
        <div class="row3">a</div>
        <div class="row4">Ride</div>
    </div>
    <div class="wheel2">
        <img src="assets/img/wheel2.png" alt="Need for a ride - велосипедні походи та покатушки">
    </div>
        </div>

<div id="slider1"></div>

</body>
<script>
        window.onload = (()=>{
            
            let wheelAngle = 0;
            let globeAngle = 0;
            let wheelRotation = false;

            function wheelRotate(time = 2000, direct = 1) {
                let wheelSize = {top: '80px', left: '20px', width: '200px', height: '200px'};
                if (parseInt(document.body.clientWidth) <= 1100) wheelSize = {top: '60px', left: '10px', width: '120px', height: '120px'};
                if (parseInt(document.body.clientWidth) <= 640) wheelSize = {top: '67px', left: '10px', width: '80px', height: '80px'};
                if (parseInt(document.body.clientWidth) <= 480) wheelSize = {top: '47px', left: '10px', width: '80px', height: '80px'};
                $('.wheel1').animate(wheelSize, 2000);
                
                if (wheelRotation) return;
                wheelRotation = true;

                const rt = 20; // repeat time
                let globe = document.querySelector('#logo-globe');
                let wheel = document.querySelector('#logo-wheel');
                let iteration = time / rt;
                let delta = direct / iteration;

                let interval = setInterval(()=>{
                    wheelAngle += direct;
                    globeAngle -= direct/5;
                    wheel.style.transform = `rotate(${wheelAngle}deg)`;
                    globe.style.transform = `rotate(${globeAngle}deg)`;
                    direct -= delta;

                    time -= rt;
                    if (time <= 0) {
                        clearInterval(interval);
                        wheelRotation = false;
                    }
                }, rt);
                return;
            }

            wheelRotate(10000, -2);
            
            window.onresize = (e)=>{
                let wheelSize = {top: '80px', left: '20px', width: '200px', height: '200px'};
                if (parseInt(document.body.clientWidth) <= 1100) wheelSize = {top: '60px', left: '10px', width: '120px', height: '120px'};
                if (parseInt(document.body.clientWidth) <= 640) wheelSize = {top: '67px', left: '10px', width: '80px', height: '80px'};
                if (parseInt(document.body.clientWidth) <= 480) wheelSize = {top: '47px', left: '10px', width: '80px', height: '80px'};
                document.querySelector('.wheel1').style.top = wheelSize.top;
                document.querySelector('.wheel1').style.left = wheelSize.left;
                document.querySelector('.wheel1').style.width = wheelSize.width;
                document.querySelector('.wheel1').style.height = wheelSize.height;
            }

            setSlider(4, 'assets/img/slider/', 'img', 5, 0.5, 'slider1', null,
            [
                '<span>Знайдіть свою покатушку та їдьте в подорож</span>',
                '<span>Знайдіть свій похід та мандруйте світом</span>',
                '<span>Створіть власну покатушку та запросіть інших</span>',
                '<span>Створіть власний похід та мандруйте разом</span>'
            ]);

            $(document.body).animate({opacity: 1}, 500);
            $(document.querySelector('.row1')).delay(1500).animate({opacity: 1}, 500);
            $(document.querySelector('.row2')).delay(1900).animate({opacity: 1}, 600);
            $(document.querySelector('.row3')).delay(2300).animate({opacity: 1}, 700);
            $(document.querySelector('.row4')).delay(2300).animate({opacity: 1}, 700);
            $(document.querySelector('.wheel2')).delay(2300).animate({opacity: 1}, 700);

            document.querySelector('.register').addEventListener('click', (event)=>{
                if (event.target.id == 'login') {
                    modalWindow(
                        '',
                        `
                        <form class="form" name='login'>
                            <label><input class="input_text" type="text" name="email" placeholder="Ваш email"></label>
                            <label><input class="input_text" type="password" name="psw" placeholder="Пароль"></label>
                        </form>
                        `,
                        ['Увійти', 'Нагадати пароль'],
                        (n)=>{
                            if (n == 0) { // кнопка увійти
                                if (!document.forms.login.email.value) {
                                    explorerPopUp('Заповніть поле email!');
                                    return;
                                }
                                if (!document.forms.login.psw.value) {
                                    explorerPopUp('Заповніть поле пароль!');
                                    return;
                                }
                                closeWindow('modal-login');
                                explorerPopUp('Ви успішно увійшли у систему')
                            }
                            if (n == 1) { // кнопка нагадати
                                if (!document.forms.login.email.value) {
                                    explorerPopUp('Заповніть поле email!');
                                    return;
                                }
                                closeWindow('modal-login');
                                explorerPopUp('Інформацію для відновлення паролю надіслано на Ваш email.')
                            }
                        },
                        undefined, null, 'modal-login', ['bike-form', 'login'], {color: '#333333', width: '300px', height: '300px', border: '4px solid rgb(65,65,65)'}); // modalWindow login =============================================
                }
                else {
                    modalWindow(
                        '',
                        `
                        <form class="form" name='registration'>
                            <label><input class="input_text" type="email" name="email" placeholder="Ваш email"></label>
                            <label class="checkbox"><input type="checkbox" name="robot" id="robot"" checked="false"><span></span>я не робот</label>
                        </form>
                        `,
                        ['Зареєструватись'],
                        (n)=>{
                            if (n == 0) {

                                if (!document.forms.registration.email.value) { // поле email порожнє
                                    explorerPopUp('Заповніть поле email!');
                                    return;
                                }

                                // валидация email
                                if (!validateEmail(document.forms.registration.email.value)) {
                                    explorerPopUp('Перевірте коректність email!');
                                    return;
                                }

                                // якщо email валідний:
                                ajax(document.forms.registration.email.value, (response)=>{ // створення акаунту
                                    // перевірка наявності email  в базі:
                                    if (response.exist) explorerPopUp('Такий email вже зареєстрований. Ви можете увійти з допомогою свого email або зареєструвати інший.');
                                    
                                    
                                    if (!response.error) { // без помилок:
                                        console.log(response)
                                        explorerPopUp('На зазначений email надіслано повідомлення для закінчення реєстрації.', undefined, 5000);
                                        closeWindow('modal-registration');
                                    }

                                }, 'registration.php', phpPath='php/'); // ajax

                            }
                        },
                        undefined, null, 'modal-registration', ['bike-form', 'login'], {color: '#333333', width: '300px', height: '200px', border: '4px solid grey'}); // modalWindow registration ======================================
                        document.forms.registration.robot.checked = false;
                }
            })

            function validateEmail(mail) {return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))         }
            
        }); //onload
    </script>
</html>
