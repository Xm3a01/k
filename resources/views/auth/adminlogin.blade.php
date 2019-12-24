<html lang="en" dir="rtl">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8">
    <title>AdminPanel | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author"> 
    @include('dashboard.includes._head')

</head>
<!-- END HEAD -->

<body class=" login">
        <!-- BEGIN LOGIN FORM -->
        <!-- BEGIN LOGIN -->
        <div class="content m-t-10">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="{{route('admin.login.submit' , app()->getLocale())}}" method="post">
                @csrf
                <div class="form-title">
                    <span class="form-title">{{__('مرحبا بك')}}.</span>
                     </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">البريد اللاكتروني</label>
                    <input class="form-control form-control-solid placeholder-no-fix @error('email') is-invalid @enderror" type="text"  placeholder="البريد اللاكتروني" name="username" /> </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
                    <input class="form-control form-control-solid placeholder-no-fix  @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="كلمة المرور" name="password" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">د خـول</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> كن مسجلا
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">نسيت كلمة المرور؟</a>
                    </div>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="index.html" method="post">
                <div class="form-title">
                    <span class="form-title">هل نسيت كلمة المرور؟</span><br>
                    <span class="form-subtitle">ادخل البريد اللاكتروني.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="البريد اللاكتروني" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">رجوع</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right">ارســال</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
    @include('dashboard.includes._javascript')

</body>

</html>