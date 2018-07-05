/* global API_KEY TOKEN SESSION_ID SAMPLE_SERVER_BASE_URL OT */
/* eslint-disable no-alert */

// var apiKey = '45828062';
// var sessionId = '2_MX40NTgyODA2Mn5-MTUzMDUyNzc0MTM5OX4rSlJXK2ZVVnlhRWR2WkQrUzZHZ3dMUyt-UH4';
// var token = 'T1==cGFydG5lcl9pZD00NTgyODA2MiZzaWc9MjVlZDk3MWVlOWIyMDdkYjA5MTAxMzAwYmJkN2RhZTkxZjJhMzZiZTpzZXNzaW9uX2lkPTJfTVg0ME5UZ3lPREEyTW41LU1UVXpNRFV5TnpjME1UTTVPWDRyU2xKWEsyWlZWbmxoUldSMldrUXJVelpIWjNkTVV5dC1VSDQmY3JlYXRlX3RpbWU9MTUzMDUyNzk5MCZub25jZT0wLjMyMjk4MDEzODA5OTc0MjM1JnJvbGU9cHVibGlzaGVyJmV4cGlyZV90aW1lPTE1MzA2MTQzOTA=';

 // var apiKey = '45828062';
 // var sessionId ;
 // var token;
// initializeSession();
 $.get('session.php',function(res){   
       initializeSession(res);
  }); 

connection = null;

function initializeSession(data) {

    var obj = jQuery.parseJSON(data); 
       var apiKey = obj.apiKey;
       var sessionId = obj.session;
       var token = obj.token;

    
  //console.log(apiKey);
  session = OT.initSession(apiKey, sessionId);
 //console.log(session);
  // Subscribe to a newly created stream
  // session.on('streamCreated', function streamCreated(event) {
  //   //console.log(event);
  //   var subscriberOptions = {
  //     insertMode: 'append',
  //     width: '100%',
  //     height: '100%'
  //   };
  //   session.subscribe(event.stream, 'subscriber', subscriberOptions, function callback(error, data) {
  //     console.log("after subscriber");
  //     console.log(data);
  //     connection = data.stream.connection;
  //     console.log(connection);
  //     if (error) {
  //       console.error('There was an error publishing: ', error.name, error.message);
  //     }
  //   });
  // });

  // session.on('sessionDisconnected', function sessionDisconnected(event) {
  //   console.error('You were disconnected from the session.', event.reason);
  // });


  // // Initialize the publisher
  // var publisherOptions = {
  //   insertMode: 'append',
  //   width: '100%',
  //   height: '100%'
  // };
  // var publisher = OT.initPublisher('publisher', publisherOptions, function initCallback(initErr) {
  //   if (initErr) {
  //     console.error('There was an error initializing the publisher: ', initErr.name, initErr.message);
  //     return;
  //   }
  // });

  // Connect to the session
  session.connect(token, function callback(error) {
    // If the connection is successful, initialize a publisher and publish to the session
    if (!error) {
      // If the connection is successful, publish the publisher to the session
      // session.publish(publisher, function publishCallback(publishErr) {
      //   if (publishErr) {
      //     console.error('There was an error publishing: ', publishErr.name, publishErr.message);
      //   }
      // });
    } else {
      console.error('There was an error connecting to the session: ', error.name, error.message);
    }
  });

  // Receive a message and append it to the history
  var msgHistory = document.querySelector('#history');
  session.on('signal:msg', function signalCallback(event) {
    console.log("msg received");
    console.log(event);
    var msg = document.createElement('p');
    msg.textContent = event.data;
    msg.className = event.from.connectionId === session.connection.connectionId ? 'mine' : 'theirs';
    msgHistory.appendChild(msg);
    msg.scrollIntoView();
  });
}

// Text chat
var form = document.querySelector('form');
var msgTxt = document.querySelector('#msgTxt');

// Send a signal once the user enters data in the form
form.addEventListener('submit', function submit(event) {
  event.preventDefault();

  session.signal({
    to:connection,
    type: 'msg',
    data: msgTxt.value
  }, function signalCallback(error) {
    if (error) {
      console.error('Error sending signal:', error.name, error.message);
    } else {
      msgTxt.value = '';
    }
  });
  // session.on('sessionConnected',function(data){
  //   //console.log('sessionConnected');
  //   //console.log(data);
  // });
  // session.on('connectionCreated',function(data){
  //   //console.log('connectionCreated');
  //   //console.log(data);
  // });

});

// if (apiKey && token && sessionId) {
//   initializeSession(apiKey,sessionId,token);
// } else{
 
 
//}
