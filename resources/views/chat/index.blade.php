@extends('layouts.app')
@section('content')
    <br><br>
    <div class="row" id="chatWrapper">
		<div class="col-md-1" id="channelWrapper">
			<div id="channelList">
				<ul>
					<li style="list-style-type: none; font-weight: 800; position: relative; left: -25px;"><a href="javascript:;" id="server" onclick="switch_channel( 'server' );">OpenPad.io</a></li>
				</ul>
			</div>
			<div id="userChannelList">
				<ul>
				</ul>
			</div>
		</div>
		
		<div class="col-md-10" id="messagesTopicWrapper">
			<div class="row">
				<div id="channelTopic"></div>
			</div>
			<div id="connect" style="text-align: center;">
				<form>
					<label for="server">Server: </label>
					<input type="text" id="server_val" required value="irc.freenode.net:6667" /><br />
					<input type="text" id="nick" required placeholder="Your nickname here" />
					<input type="submit" id="connect-btn" value="connect" />
				</form>
			</div>
			<div id="messagesWrapper">
				<ul id="messages">
					<li>Welcome to IRC webclient</li>
				</ul>
			</div>
				
		</div>
		<div class="col-md-1" id="usersWrapper">
			
		</div>
        <form action="#">
            <textarea id="msginput" style="width: 100%; height: 30px; overflow: none;"></textarea>
        </form>
    </div>
        
    <style>
        #chatWrapper {
            border: 1px solid grey;
            min-height: 500px;
			height: 100%;
        }
		.full-width-container { height: 100%; }
        #channelTopic {
            border-bottom: 1px solid grey;
			height: 30px;
			width: calc(100% - 15px);
        }
        #messagesTopicWrapper {
            height: 500px;
            overflow: hidden;
			padding: 0px;
			padding-left: 15px;
        }
		#messagesWrapper {
			overflow: scroll;
			height: 500px; 
		}
		#messages li {
			list-style-type: none;
		}
        #channelWrapper {
            border-right: 1px solid grey;
            min-height: 500px;
			padding-left: 0px;
        }
        #usersWrapper {
            border-left: 1px solid grey;
            min-height: 500px;
        }
		#usersWrapper div {
			overflow: hidden;
			
		}
		#usersWrapper a {
			white-space: nowrap;
			overflow: hidden;
		}
		#channelList ul {
			margin-bottom: 0px;
		}
        
    </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.js"></script>

<script type="text/javascript">

var current_channel = 'server';

function parse_msg( text ) {
	var data = text.split( " ", 4 );
	if ( data.length == 4 && data[1] == 'PRIVMSG' ) {
		var user = text.split( '!~' )[0].replace( ':', '' );
		var message = text.replace( /^:[^:]*:/, '' ).replace( /[\n\r]/g, '' );
		var receiver = null;
		/* The person we want to answer (channel or user). */
		if ( data[2].charAt(0) == '#' ) {
			receiver = data[2]; // channel
		} else {
			receiver = user; // user
		}
		return { 
				'valid'    : 1, 
				'user'     : user, 
				'channel'  : data[2], 
				'receiver' : receiver, 
				'message'  : message
			}
	} else {
		// not a valid message
		return { 'valid' : 0 }
	}
}

var socket = io.connect( "https://openpad.io:1338" );
//var socket = io.connect( "https://openpad.io:1338" );

$(document).ready( function () {
	
	/* Textarea capture (enter click) */
	$("#msginput").keypress(function(e) {
		if(e.which == 13) {
			$(this).parent("form").submit();
			return false;
		}
	});

	/* Handle Initial Connection to IRC server. */
	setTimeout(function() {
		$("#server_val").val("fuge.it:6667");
		$("#nick").val("test"+Math.floor((Math.random() * 100) + 1) );
		$("#connect-btn").click();
	 }, 100);
	$("#connect-btn").click( function(e) {
		e.preventDefault();
		/* UI things… */
		$("#connect").hide();
		$("#ui").show();
		$('#top-box').height( $(window).innerHeight() - $('#bottom-box').outerHeight() - 25 );
		$('#top-box ul').height( $('#top-box').innerHeight() - 2 );

		/* Connect to IRC. */
		socket.send("CONNECT "+ $("#server_val").val());
		socket.send("NICK "+ $("#nick").val() +"\n");
		socket.send("USER "+ $("#nick").val() + ' '
			+ $("#server_val").val().split(":")[0] 
			+ " blubb :"+$("#nick").val() +"\n");
			
		setTimeout(function() {
			socket.send( 'JOIN #subtlefuge\r\n' );
		}, 500)
	});

	/* Add handler to input form. */
	$('form').submit( function() {
		var msg = $('#msginput').val();
		$('#msginput').val('');
		
		/* Check for commands. */

		/*	/join 		*/
		if ( msg.match( /^\/join .+/i ) ) {
			socket.send( 'JOIN ' + msg.split(' ')[1] + "\r\n" );
		/*	/nick 		*/
		/*	/join 		*/
		} else 	if ( msg.match( /^\/names.*/i ) ) {
			socket.send( 'NAMES ' + msg.split(' ')[1] + "\r\n" );
		/*	/nick 		*/
		} else 	if ( msg.match( /^\/who.*/i ) ) {
			socket.send( 'WHO ' + msg.split(' ')[1] + "\r\n" );
		/*	/nick 		*/
		} else 	if ( msg.match( /^\/nick .+/i ) ) {
			if (msg.split(' ')[1].match(/^([a-zA-Z0-9]|[-[]\\`\^{}])+$/))
			{
				socket.send('NICK ' + msg.split(' ')[1] + "\r\n" ); 
				$("#nick").val(msg.split(' ')[1]); //save nick for recnnects...
			}
			else
			{
				showMsg("Error: Your Nickname contains illegal letters.", current_channel);
			}
			
		/*	/help		*/
		} else 	if ( msg.match( /^\/help.*/i ) ) {
			showHelp();

		/*	/connect	*/
		} else 	if ( msg.match( /^\/connect .+/i ) ) {
			socket.send("CONNECT "+ msg.split(' ')[1]);
			socket.send("NICK "+ $("#nick").val() +"\n");
			socket.send("USER "+ $("#nick").val() + ' '
				+ $("#server_val").val().split(":")[0] 
				+ " blubb :"+$("#nick").val() +"\n");

		/*	/part		*/
		} else 	if ( msg.match( /^\/part( .+)?$/i ) ) {
			if(msg.split(' ')[1])  	//channel given
				socket.send('PART ' + msg.split(' ')[1] + "\r\n" ); 
			else			//no channel given -> use current channel
				socket.send('PART ' + current_channel + "\r\n" ); 

		/*	/query		*/
		} else 	if ( msg.match( /^\/query .+/i ) ) {
			var username = msg.split(' ')[1];
			if ($('#'+username).length == 0)
			{
				switch_channel( username );
				$('#channel').append( '<li onclick="switch_channel($(this).text() );" id="' 
					+ username + '">' + username + '</li>' );
				showMsg('Private conversation with '+username, current_channel);
			}

		/*	/msg		*/
		} else 	if ( msg.match( /^\/msg .+ .+/i ) ) {
			var username = msg.split(' ')[1];
			var message = msg.substr(msg.substr(5).indexOf(' ')+6);
			socket.send("PRIVMSG "+username+" :"+message+"\r\n");
			showMsg($("#nick").val()+ " -> "+ username +" : " + message, "server");
			showMsg(message, username, $("#nick").val());

		/*	unknown command	*/
		} else if ( msg.match( /^\/.*/i ) ) {
			showMsg( "Error: Unknown command or too few arguments. Type /help for help.", current_channel );

		} else {
			var msgLines = msg.split("\n");
			for(i=0; i < msgLines.length; i++) {
				/* No command. Send as message to current channel */
				socket.send("PRIVMSG "+current_channel+" :"+msgLines[i]+"\r\n");
			}
			showMsg(msg, current_channel, $("#nick").val());

		}
		return false;
	});
});


/* Add new message to channel window */
function showMsg(msg, channel, username ){

	msg = $('<div/>').text(msg).html();  // escape msg
	
	if(typeof(username) != "undefined") var username = username+":";
		else var username = "";

	if (channel.includes("#")) channel =channel.replace( "#", '' );
	
	var theHtml = '<li '+ ( ( channel != current_channel.replace( /^#/, '' ))  ? 'style="display:none;"' : '' ) +' class="' + channel + '">' + username + ""+msg+"</li>";
	$("#messages").append(theHtml).ready(function(){
		
		
		/* Check for links to embed */
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		if (msg.match(p)) {
			var myId = getId(msg);
			var rand = ((Math.random() * 9999) + 1);
			var youtubeEmbed = '<li '+ ( ( channel != current_channel.replace( /^#/, '' ))  ? 'style="display:none;"' : '' ) +' class="' + channel + '"><div style="height: 315px; width: 560px;"><iframe width="560" height="315" src="//www.youtube.com/embed/' + myId + '" id="iframe_embed_'+rand+'" frameborder="0" allowfullscreen></iframe></div></li>';
			$("#messages").append(youtubeEmbed).ready(function(){
				$('#frame_embed_'+rand).load(function() {
					$("#messagesWrapper").scrollTop($('#messages').height());
				})
			});
		}
		$("#messagesWrapper").scrollTop($('#messages').height());
	});
}

function switch_channel( c ) {
	$("#channelTopic").html("");
	$('#messages li').css( 'display', 'none' );
	$('li.' + c.replace( /^#/, '' ) ).css( 'display', 'block' ); /* Show messages only for this channel */
	current_channel = c;
	
	/* Perform whois on channel switch to user */
	if (!c.includes("#")) {
        socket.send( 'WHOIS ' + c + "\r\n" );
    } else { /* Perform user list and topic lookups on group channel switch */
		socket.send( 'NAMES ' + c + "\r\n" );
		socket.send( 'TOPIC ' + c + "\r\n" );
	}
}

/* Help functions */
function showHelp(){
	showMsg("*************************************", current_channel);
	showMsg("Available commands:", current_channel);
	showMsg("/join <channel>		: Joins the given Channel", current_channel);
	showMsg("/nick <nickname>		: Changes the nick name to the given one", current_channel);
	showMsg("/part [<channel>]		: Leaves the given channel or the current one if no channel is given", current_channel);
	showMsg("/connect <hostname>:<port>	: Connects to the given server (closes any open connection)", current_channel);
	showMsg("/query <user>			: Opens a private chat with the given user", current_channel);
	showMsg("/msg <user> <message>		: Sends a message to the given user without opening a new chat.", current_channel);
	showMsg("*************************************"	, current_channel);
}

/* Open a channel on username clicks */
function openUsernameChannel(username) {
	if ($('#'+username).length == 0)
		$('#userChannelList ul').append( '<li><a href="javascript:;" onclick="switch_channel($(this).text() );" id="' + username + '">' + username + '</a></li>' );
	switch_channel(username);
	$("#msginput").focus();
}

/* Handle incoming messages from irc server */
socket.on('message', function (data) {
	var lines = data.split( "\r\n" );
	console.log(data);
	console.log(lines.length);
	for ( var i = 0; i < lines.length; i++ )  {
	console.log("line: "+i);
		// play ping pong
		if ( lines[i].match( /^PING.*/ ) ) {
			socket.send( 'PONG ' + lines[i].split(' ')[1] + '\r\n' );
		} else if ( lines[i] != ''  ) {
			var msg = parse_msg( lines[i] );
			if ( msg.valid ) {
			console.log("123");
				// check if channel exists. If not -> add it as a new one (query)
				if ($('#'+msg.receiver.split("!")[0].replace( /^#/, '' )).length == 0)
					$('#userChannelList ul').append( '<li><a href="javascript:;" onclick="switch_channel($(this).text() );" id="' + msg.receiver.split("!")[0].replace( /^#/, '' ) + '">' + msg.receiver.split("!")[0] + '</a></li>' );
					
					var username = msg.user.split("!")[0];
					console.log(username);
					showMsg(msg.message, msg.receiver.split("!")[0], username );
					console.log("456");
			} else {
			console.log(lines.length);
			console.log("789");
				msg = lines[i].split(' ');
				console.log(msg);
				if ( msg.length > 2 && msg[1] == 'JOIN' ) {
					if(msg[0].slice(1, msg[0].indexOf('!'))== $('#nick').val())
					{
						// own JOIN message -> open channel
						msg[2] = msg[2].replace( /^:/, '');
						switch_channel( msg[2] );
						$('#channelList ul').append( '<li><a href="javascript:;" onclick="switch_channel( $(this).text() );" id="' 
							+ msg[2].replace( /^#/, '' ) + '">' + msg[2] + '</a></li>' );
					}
					else
					{
						// TODO: other user's JOIN -> update user list
						showMsg(msg[0].split("!")[0]+" ("+msg[0].split("!")[1]+"@"+msg[0].split("!")[1]+") has joined", msg[2].replace( /^:#/, '' ));
						socket.send( 'NAMES ' + msg[2].replace( /^:/, '' ) + "\r\n" );
					}
				} else if ( msg.length > 2 && msg[1] == 'PART' ) {
					if(msg[0].slice(1, msg[0].indexOf('!')) == $('#nick').val())
					{
						// own PART message -> leave channel
						switch_channel( 'server' );
						$(msg[2]).parent("li").remove();
					}
					else
					{
						//TODO: other user's PART message -> update user lists of affected channels
						showMsg(msg[0].split("!")[0]+" has quit ("+msg[3]+")", msg[2].replace( /^:#/, '' ));
						socket.send( 'NAMES ' + msg[2].replace( /^:/, '' ) + "\r\n" );
					}
				/* Whois hostname */
				} else if ( msg.length > 4 && msg[1] == '311' ) { 
					$("#channelTopic").html(lines[0].split(" ")[4]+"@"+lines[0].split(" ")[5]);
				 /* Channel motd */
				} else if ( msg.length > 4 && msg[1] == '332' ) {
					$("#channelTopic").html(lines[i].replace( /^:[^:]*:/, '' ), msg[3]);
				/* User in channel */
				} else if ( msg.length > 4 && msg[1] == '353' ) {
                    var users = lines[i].split(':')[2].split(" ").reverse();
                    $("#usersWrapper").html("");
                    for(var z = 1; z < users.length; z++) {
                         $("#usersWrapper").append("<div><a href='javascript:;' onClick='openUsernameChannel($(this).text())' title='"+users[z]+"'>"+users[z]+"</a></div>");
                    }
				/* Changed user mode. */
				} else if ( msg.length > 2 && msg[1] == 'MODE' ) { 
					showMsg( lines[i].replace( /^.* MODE /, 'Mode ' ) + ' by ' + msg[0].replace( /^:/, '' ).replace( /!.*$/, '' ), msg[2]);
				/* Misc. server */
				} else {
					showMsg( lines[i], 'server' );
				}
			}
		}
	}
});


/* Auto-embed functionality */
function getId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 'error';
    }
}
</script>



@endsection