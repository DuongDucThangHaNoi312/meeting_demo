<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="{{asset('assets/js/amazon-chime-sdk.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vid.css')}}" />
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.114.0.min.js"></script>
    <title>Video Meet!</title>
</head>
<body>
<div id="whiteboard-container"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/6.1.4/adapter.js" integrity="sha512-r8cn1OoZ21KHc0zmav3+MtQS24AJLAaDdNNWYkOborAznLETtfBKMb6xkpqXnjcH1GmKG9BqPOW9tU/Jzy98kQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Create an instance of the Chime SDK Whiteboard
        const whiteboard = new AWS.ChimeSDKWhiteboard();

        // Configure the messaging service
        const dataMessagingService = new AWS.DataMessagingService();

        // Initialize the whiteboard with the container element
        whiteboard.initialize({ container: document.getElementById('whiteboard-container') });

        // Register event listeners for whiteboard events
        whiteboard.addEventListener('mouseDown', (event) => {
            // Capture the mouse down event on the whiteboard
            // You can send the event details to other participants using the data messaging service
            const messagePayload = {
                type: 'mouseDown',
                x: event.x,
                y: event.y
            };

            dataMessagingService.sendDataMessage(messagePayload);
        });

        whiteboard.addEventListener('mouseMove', (event) => {
            // Capture the mouse move event on the whiteboard
            const messagePayload = {
                type: 'mouseMove',
                x: event.x,
                y: event.y
            };

            dataMessagingService.sendDataMessage(messagePayload);
        });

        whiteboard.addEventListener('mouseUp', (event) => {
            // Capture the mouse up event on the whiteboard
            const messagePayload = {
                type: 'mouseUp',
                x: event.x,
                y: event.y
            };

            dataMessagingService.sendDataMessage(messagePayload);
        });

        // Register a listener for data messages received from other participants
        dataMessagingService.addEventListener('dataMessage', (event) => {
            // Parse the payload of the received data message
            const messagePayload = JSON.parse(event.dataMessage.payload);

            // Perform actions based on the message type
            switch (messagePayload.type) {
                case 'mouseDown':
                    // Handle mouse down event from other participants
                    // e.g., create a new drawing on the whiteboard at (messagePayload.x, messagePayload.y)
                    break;
                case 'mouseMove':
                    // Handle mouse move event from other participants
                    // e.g., draw a line on the whiteboard from the previous point to (messagePayload.x, messagePayload.y)
                    break;
                case 'mouseUp':
                    // Handle mouse up event from other participants
                    // e.g., finish drawing a line on the whiteboard from the previous point to (messagePayload.x, messagePayload.y)
                    break;
                default:
                    break;
            }
        });
    </script>
</body>
</html>



