<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="{{asset('assets/js/amazon-chime-sdk.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vid.css')}}" />

    <title>Video Meet!</title>
</head>
<body>
<div style="width: 100%;  text-align:center; margin: 0 auto;">
    <label style="color:blueviolet;font-size: 50px;font-weight: bold;align-items: center;">Video Meet!</label>
</div>
<audio style="display: none" id="meeting-audio"></audio>
<div style="width: 100%;  text-align:center; margin: 0 auto;">
    User Name: <input id="username" name="username" type="text" value=""/>
    <button type="button" id="start-button">Start Meeting</button>
    <button type="button" id="stop-button">Stop Meeting</button>
    <button type="button" id="exit-button">Exit Meeting</button>
    <button type="button" id="share-button">Screen Share</button>
</div>
<br>
<b style="color:blueviolet;">Meeting Id:</b> <label id="meeting-Id"></label><br>
<b style="color:blueviolet;">Meeting Link:</b> <label id="meeting-link"></label><br>
<b style="color:blueviolet;">Attendees:</b> <label id="Attendees"></label>
<hr>
<div id="video-list">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/6.1.4/adapter.js" integrity="sha512-r8cn1OoZ21KHc0zmav3+MtQS24AJLAaDdNNWYkOborAznLETtfBKMb6xkpqXnjcH1GmKG9BqPOW9tU/Jzy98kQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/vid.js')}}"></script>
</body>
</html>
