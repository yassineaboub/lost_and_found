<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   @include('index.head')
</head>
<body class="register">
    @include('index.navbar')
    <div class="regiter-container">
        <form method="POST" action="{{ route('utilisateur.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <h2>Register</h2>
                <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                <div class="container">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload"  name="image" files="true" accept="image/*" value="/img/user.jpg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url(/img/user.jpg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="pseudo" name="pseudo" required/>
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="Password"class="pass" placeholder="Mot de Passe" name="mdp" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="password" class="comfpass" placeholder="Répeter Mot de passe" required/>
                    <div class="input-icon"><i class="fa fa-key"></i></div>
                    <span class="note">Veuillez confirmer votre mot de passe</span>
                </div>
                <div class="input-group input-group-icon">
                    <input type="NUMBER" placeholder="PhoneNumber" name="tel" required/>
                    <div class="input-icon"><i class="fa fa-phone"></i></div>
                </div>
            </div>
            <div class="row">
                <div class="col-half">
                    <h4>Gender</h4>
                    <div class="input-group">
                        <input type="radio" name="sexe" value="male" id="gender-male" required/>
                        <label for="gender-male">Male</label>
                        <input type="radio" name="sexe" value="female" id="gender-female" required/>
                        <label for="gender-female">Female</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>First Name</h4>
                <div class="input-group">
                    <input type="Text"  name="nom"  placeholder="Nom" id="payment-method-card"  required/>
                    <div class="input-group input-group-icon"></div>
                    <div class="row"></div>
                </div>
                <h4>Last Name</h4>
                <div class="input-group">
                    <input type="Text"  name="prenom" placeholder="Please Enter Your Last Name" id="payment-method-card" required/>
                    <div class="input-group input-group-icon"></div>
                    <div class="row"></div>
                </div>
                <h4>E-mail</h4>
                <div class="input-group">
                    <input type="Text"  name="email" placeholder="Please Enter Your E-mail" id="payment-method-card" required/>
                    <div class="input-group input-group-icon"></div>
                    <div class="row"></div>
                </div>
                <h4>Address</h4>
                <div class="input-group">
                    <input type="Text" name="adrs"  placeholder="Please Enter Your Address" id="payment-method-card"/>
                    <div class="input-group input-group-icon"></div>
                    <div class="row"></div>
                </div>
                <h4>Terms and Conditions</h4>
                <div class="input-group">
                    <input type="checkbox" id="terms"/>
                    <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
                </div>
                <div class="input-group">
                    <input type="submit" value="Submit" style="background-color:#fed136;font-size:20px;font-weight: bold;"/>
                </div>
            </div>
        </form>
    </div>
    @include('index.script')
</body>
</html>