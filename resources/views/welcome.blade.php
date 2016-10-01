<!DOCTYPE html>
<html>
    <head>
        <title>GetHype</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            #background {
                width: 100%; 
                height: 100%; 
                position: fixed; 
                left: 0px; 
                top: 0px; 
                z-index: -1;
            }

            .stretch {
                width: 100%;
                height: 100%;
            }

            @media screen and (max-device-width: 480px), (max-width: 480px) {
                .bg-desktop {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div id="background">
            <img src="/images/comingsoon_v1.jpg" class="bg-desktop stretch">
            <img src="/images/comingsoon_v1_mobile.jpg" class="bg-mobile stretch">
        </div>
    </body>
</html>