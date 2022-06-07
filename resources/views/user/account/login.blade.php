@extends("user.main.mainPage")
@section("title","Vape VN - Collections")
@section("content")
    <div class="grid">
        <div class="action-account">
            <div class="login">
                <form action="{{route('handle_login')}}" method="POST">
                    @csrf
                    <h3 class="login__title">Đăng nhập</h3>
                    @php
                        if(Session::has('login_false')){
                            echo '<p style="color:red;">'.Session::get('login_false').'</p>';
                        }
                        Session::put('login_false',null)
                    @endphp
                    @php
                        if(Session::has('register_success')){
                            echo '<p style="color:red;">'.Session::get('register_success').'</p>';
                        }
                        Session::put('register_success',null)
                    @endphp
                    <div class="login__user">
                        <label for="email">Địa chỉ Email</label>
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="login__pass">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" placeholder="Mật khẩu">
                    </div>
                    <div class="forget-pass">
                        <a href="#">Quên mật khẩu</a> <a href="{{route('home')}}">Quay về trang chủ</a>
                    </div>
                    <div class="handle-login">
                        <button type="submit" class="btn-login">
                            <i class="fa-solid fa-lock"></i>
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
            <div class="register">
                <h3 class="register__title">Tạo tài khoản</h3>
                <p>Tạo tài khoản để dễ dàng hơn trong việc mua sắm và kiểm tra các đơn đặt của bạn !</p>
                <form action="{{route('register')}}" id="form-register" method="POST" id="regForm">
                    @csrf
                    <div class="first-name">
                        <label for="name">Họ và tên</label>
                        <input required type="text" name="name" id="name" placeholder="Họ và tên">
                        <small id="name-null" class="notify-error"></small>
                    </div>
                    <div class="login__user">
                        <label for="email">Địa chỉ Email</label>
                        <input required type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="login__pass">
                        <label for="pass">Mật khẩu</label>
                        <input required type="password" name="pass" id="pass" placeholder="Mật khẩu" onkeyup="validatePassword(this)">
                        <small id="pass-null" class="notify-error"></small>
                    </div>
                    <div class="login__pass">
                        <label for="confirmPassword">Nhập lại mật khẩu</label>
                        <input required type="password" name="confirmPassword" id="confirmPassword" placeholder="Nhập lại mật khẩu" onblur="validateRetypePassword(this)">
                        <small id="no-match-pass" class="notify-error"></small>
                    </div>
                    <button class="btn-register js-disable noHover" id="js-register-account">
                        <i class="fa-solid fa-user"></i>
                        Tạo tài khoản
                    </button>
                    <i style="display:block;cursor:pointer;" id="hidden-form-register">Quay lại</i>
                </form>
                <button class="btn-register" id="js_show_form_register">
                    <i class="fa-solid fa-user"></i>
                    Tạo tài khoản
                </button>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('js_show_form_register').onclick = function(){
            this.style.display = 'none'
            document.getElementById('form-register').style.display = 'block'
        }
        document.getElementById('hidden-form-register').onclick = function(){
            document.getElementById('form-register').style.display = 'none'
            document.getElementById('js_show_form_register').style.display = 'block'
        }
        
        
        function validatePassword(textfield) {
            var submitButton = document.getElementById("js-register-account");
            if(textfield.value.length>=6) {
                // submitButton.disabled = false;
                document.getElementById('pass-null').innerText = ""
            }
            else{
                submitButton.disabled = true;
                document.getElementById('pass-null').innerText = "Mật khẩu phải lớn hơn 6 kí tự"        
            }
        }
        function validateRetypePassword(textfield) {
            var submitButton = document.getElementById("js-register-account");
            var password = document.getElementById('pass').value
            if(textfield.value==password) {
                submitButton.disabled = false;
                document.getElementById('no-match-pass').innerText = ""
                flagRepass = true
            }
            else{
                submitButton.disabled = true;
                document.getElementById('no-match-pass').innerText = "Mật khẩu không khớp"     
                flagRepass = false       
            }
        }
        
    </script>
@stop