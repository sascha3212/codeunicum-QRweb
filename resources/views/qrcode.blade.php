<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(450)->errorCorrection('H')->merge('img/logo.png', .4, true)->generate($qrcode_hash)) !!}">
        </div>
    </div>
</div>
</body>
</html>
<script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyCsX1yfWrJUN5N2KvTGf0J6dHfBckfyPlc",
        authDomain: "qrcode-scanner-8025a.firebaseapp.com",
        databaseURL: "https://qrcode-scanner-8025a.firebaseio.com",
        storageBucket: "qrcode-scanner-8025a.appspot.com",
        messagingSenderId: "450607565451"
    };
    firebase.initializeApp(config);

    var qrcode_hash = '{{$qrcode_hash}}';

    {{--writeUserData('wilko.dekkers@gmail.com', 'http://www.codeunicum.com');--}}
    function writeUserData(email, site) {
        firebase.database().ref('sitebind/0').set({
            email: email,
            site: site
        });
    }

    var Qrcodebind = firebase.database().ref('qrcodebind');

    Qrcodebind.on('value', function (snapshot) {
        var databaseQrcode = snapshot.val();
        var qrcodebind_array = $.map(databaseQrcode, function (value, index) {
            return [value];
        });

        var Usersites_array = firebase.database().ref('sitebind').once('value').then(function (snapshot) {
            var databaseSites = snapshot.val();
            var array = $.map(databaseSites, function (value, index) {
                return [value];
            });
            return array;
        });

        Usersites_array.then(function (sitebindings) {
//            console.log(sitebindings);
            for (var i = 0; i < qrcodebind_array.length; i++) {
                if (qrcodebind_array[i].Qrcode == qrcode_hash) {
                    for (var ii = 0; ii < sitebindings.length; ii++) {
                        if (sitebindings[ii].email == qrcodebind_array[i].Email) {
                            window.location.href = sitebindings[ii].site;
                        }
                    }
                }
            }
        });

    });


</script>