/* global API_KEY TOKEN SESSION_ID SAMPLE_SERVER_BASE_URL OT */
/* eslint-disable no-alert */

 // $.get('session.php',function(res){   
 //       initializeSession(res);
 //  }); 
function invite(user_id){
      $('#btn_'+user_id).text('Please wait . . ');
      $.post('invite.php',{session_id:1,user_id:user_id},function(res){
        $('#btn_'+user_id).text('Invited'); 
         initializeSession(res);        
        
      });
    }
    function approve(user_id,chat_id){
      $('#btn_'+user_id).text('Please wait . . ');
      $.post('approve.php',{chat_id:chat_id,user_id:user_id},function(res){
        $('#btn_'+user_id).text('Connected');
        initializeSession(res);       
      });
    }


    $('.users').click(function(){
      var user_id = $(this).attr('userId');
      $('.users').removeClass('active');
      $(this).addClass('active');
      // $.post('session.php',{user_id:user_id},function(res){
      //  console.log(res);
      // });

    });


var apiKey;
var session;
var sessionId;
var token;



function initializeSession(data) {
  // console.log(data);

  var obj = jQuery.parseJSON(data); 
   // console.log(obj);
   apiKey = obj.apiKey;  
   sessionId = obj.session;
  token = obj.token;

    
  console.log(apiKey);
  session = OT.initSession(apiKey, sessionId); 

  // Connect to the session
  session.connect(token, function callback(error) {
    // If the connection is successful, initialize a publisher and publish to the session
    if (!error) {
      // If the connection is successful, publish the publisher to the session
     
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
    // to:connection,
    type: 'msg',
    data: msgTxt.value
  }, function signalCallback(error) {
    if (error) {
      console.error('Error sending signal:', error.name, error.message);
    } else {
      msgTxt.value = '';
    }
  });
 

});