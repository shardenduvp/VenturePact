//Defining constant variables.
var socket = io.connect(window.location.origin + ':8080');
var $window = $(window);
var dhId = $("#dhId").val();
var $chat_window = $("#chat-window");
var $txtChatWindow = $("#txtChatWindow");
var $txtChatStatusWindow = $("#txtChatStatusWindow");
var $chattingscrollWindow = $("#chattingscrollWindow"); // ul box for chatting 
var $btnChatWindow = $("#btnChatWindow");
var connected = false;
var FADE_TIME = 150; // ms
var TYPING_TIMER_LENGTH = 400; // ms
var typing = false;
var lastTypingTime;
var dynamic = '<div class="col-md-12 bt mt10 p10 pl30 bgwhite"><a href="javascript:void(0);" class="btn tab-btn-new fs12 mt5 mb5 pull-left btnEditPitch" data-id="lastInsertedId"><span class="icon-note" aria-hidden="true"></span> &nbsp;Edit Pitch </a><div class="pull-right mr20 mt5"><span class="fs10 grey-text mr10">Seen By:</span><a href=""><img width="30" class="img-circle" src="'+url+'"></a></div></div></div>';
var milestoneHtml =   "<span class='fs14 blue-new mb10'><span class='icon-direction fs16' aria-hidden='true'></span> Paid in {{milstoneCount}} Milestones</span><table class='table table-hover fs14 ml10 mt10'></table>";
var client_end = $('[name="client"]').val();
var supplier_end = $('[name="supplier"]').val();
var admin_end = $('[name="admin"]').val();

var socketId = 0;
socket.on('connect', function(err) {
    if (err) console.log("error : ", err);
    console.log("dhId", dhId);
    var data = {
        "dhId": dhId,
        "room": $chat_window.data("room"), //chat room id 
    };
    socket.emit('init', data);
    socket.emit('initAll',data);

    socket.on('ID', function(data) {
        console.dir("socketId received  : " + JSON.stringify(data));
        socketId = data;
        updateOnlineUsers(data.onlineusers);
        connected = true;
    });

    socket.on('update online', function(data) {
        console.log('update on line received ', data);
        updateOnlineUsers(data);
    });

    socket.on('new_message', function(data) {
        console.log("request received FOR NEW MESSAGE" + JSON.stringify(data));
         var thistemp =data.msg+ '<div class="pull-right mr20 mt5"><span class="fs10 grey-text mr10">Seen By:</span><a href=""><img width="30" src="'+url+'" class="img-circle"></a></div></div>';
        $chattingscrollWindow.prepend(thistemp);
        initJs();
        if(data.lastInsertedId){
            var data = {
                    "dhId": dhId,
                    "chat_message_id": data.lastInsertedId, //chat room id 
                };
            socket.emit('update seenby',data);
        }
    });

    /*
    socket.on('new pitch', function(data) {
        console.log("request received FOR pitch" + JSON.stringify(data));
        //change message for other side 
        var temp = data.msg;
        var d = dynamic;
        if(data.type == 0){
            //if message from supplier and recipient is client then only change the messages 
            if(client_end){
                temp = temp.replace("Pitch Sent", "Pitch Received"); 
                d = d.replace('Edit Pitch','Make An Offer');
            }
        }
        else if(data.type == 1){
            //if message from client and recipient is supplier then only change the messages 
            if(supplier_end){
                d = d.replace('Edit Pitch','Accept Offer');
                temp = temp.replace("Offer Made", "Offer Received");   
            }
        }

        d = d.replace('lastInsertedId',data.proposal_id);
        var thistemp = '<div class="tab-slide-white col-md-12 np pt10 mt20" data-animate="fadeIn">'+ temp + d;
        
        $chattingscrollWindow.prepend(thistemp);
        initJs();
        bindEditClick();
          var data = {
                "dhId": dhId,
                "chat_room_id": data.lastInsertedId, //last inserted id 
            };
         socket.emit('update seenby',data)
    });
*/

    socket.on('disconnect', function() {
        console.log('disconnect');
    });

    // Whenever the server emits 'typing', show the typing message
    socket.on('typing', function(data) {
        console.log('recived typing ', data);
        var htm = data.username + " is typing"
        $txtChatStatusWindow.html(htm)
        console.log(data + "typing");

    });

    // Whenever the server emits 'stop typing', kill the typing message
    socket.on('stop typing', function(data) {
        console.log('received stop typing ', data);
        var htm = data.username + " has entered text";
        $txtChatStatusWindow.html(htm)

    });
    /*
     * function for chat interface sending messages
     *
     */
    socket.on('connect_error', function(err) {
        // handle server error here
        console.log('Error connecting to server');
         connected = false;
    });

    socket.on('reconnect_error', function() {
        console.log("reconnect failed ");
        connected = false;
    });

});





$(document).ready(function() {
    window.setInterval("updatechatTime()", (1000));
    var chatscrollLi = $chattingscrollWindow.find('li:last-child').offset();
    bindEditClick();
    /*if (typeof chatscrollLi !== 'undefined') {
        $chattingscrollWindow.animate({
            scrollTop: $chattingscrollWindow.find('li:last-child').offset().top + 'px'
        }, 1000);
    }*/
    
    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    $btnChatWindow.on("click", function() {
        console.log("send clicked");
        var msg = $txtChatWindow.val().trim();
        sendMessage(msg);

    });
});

// Updates the typing event
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function sendMessage(msg) {    
    msg = cleanMsg(msg);
    //console.log(msg);
    if (msg != '' && connected) {
        var socketdata = {
            "for": $chat_window.data("u"), // introduction id 
            "from": $chat_window.data("user"), // logedin user
            "room": $chat_window.data("room"), //chat room id 
            "msg": msg,
            "template": "1",
            "url": url,
            "username": username
        };
        socketdata.msg = render_supplier_message(socketdata, templates[0], 0);
        console.log(socketdata);
        socket.emit("chat_message", socketdata);
    }
}

/*
function sendPitch(data,type,lastInsertedId) {
    var temp = templates[1].template;
    //lastInsertedId  = 1;
    console.log(lastInsertedId);
    console.log(JSON.stringify(data));   
    if(data["ProposalPitches[billing_type]"] == 1) {
        //code Time and Material 
        console.log(" Time & Material");
        temp = temp.replace('mil-box','mil-box hide');
        if(data['tm_billing_type']==0)
            temp = temp.replace("{{tm_billing_schedule_type}}", 'Weekly');
        else
            temp = temp.replace("{{tm_billing_schedule_type}}", 'Monthly');
         
        temp = temp.replace("{{tm_amount}}", numberWithCommas(data["ProposalPitches[fp_total_price]"]));
        temp = temp.replace("{{billing_type}}", "Time & Material");
        temp = temp.replace("{{amount}}",numberWithCommas(data['ProposalPitches[tm_amount]']));
        
    }
    else {        
        console.log("Fixed Price");
        var milstones =  data["PitchHasMilestones[overview][]"];
        var milamount    = data["PitchHasMilestones[amount][]"];
        
        if(milstones.length>0) {                        
            var tablehtml = "";
            for (var i = 0; i < milstones.length; i++) {
                tablehtml += "<tr><td>#"+(i+1)+" </td><td data-original-title='"+milstones[i]+"' data-container='body' data-toggle='tooltip' data-placement='top' title=''>"+milstones[i]+"</td><td>$"+numberWithCommas(milamount[i])+"</td></tr>";
                console.log(milstones[i] + "amount "+ milamount[i] );
            };
            var m= milestoneHtml.replace("{{milstoneCount}}",milstones.length);
            var mHtml = $("<div>" + m+ "</div>");
            mHtml.find('table').html(tablehtml);
            temp = temp.replace("{{milestone}}", mHtml.html());
        }
        else {
            temp = temp.replace('mil-box','mil-box hide');
        }
        //code for Fixed Price
        temp = temp.replace("{{tm_amount}}", data["ProposalPitches[tm_amount]"]);
        temp = temp.replace("{{billing_type}}", "Fixed Price");
        temp = temp.replace("{{tm_billing_schedule_type}}", '');
        temp = temp.replace("{{amount}}", data['ProposalPitches[fp_total_price]']);
    }
    // set duration type 
    if(data["duration_type"]==0) {
        temp = temp.replace("{{fp_total_price_interval}}", "Days");        
    }
    else {
        temp = temp.replace("{{fp_total_price_interval}}", "Weeks");        
    }
    temp = temp.replace("{{start_date}}", moment(data["ProposalPitches[start_date]"]).format('DD MMM YYYY'));
    var placeholders = templates[1].placeholders.split(',');
    //console.log(temp);  
    for (var i = 0; i < placeholders.length; i++) {
        $.each(data, function(index, value) {
            var p = placeholders[i].substr(2);
            p = p.substr(0, p.length - 2);
            
            if ("ProposalPitches[" +p+']' == index) {
                console.log("ProposalPitches[" +p+'] = '+  index);
                temp = temp.replace(placeholders[i], value);
            }
        });
    };
    temp = temp.replace("{{ondate}}", moment(Date()).fromNow());
    temp = temp.replace("dummy", (new Date()).toString());
    
    var d = dynamic;
    if(type == 1) {
        temp = temp.replace("Pitch Sent", "Offer Made");
        d = d.replace('Edit Pitch','Edit Offer');
    }
    d = d.replace('lastInsertedId',lastInsertedId);
    var thistemp = '<div class="tab-slide-white col-md-12 np pt10 mt20" data-animate="fadeIn">'+temp + d;

    $chattingscrollWindow.prepend(thistemp);
    bindEditClick();

    //create link and seen by for self 
    if (connected) {
        var socketdata = {
            "for": $chat_window.data("u"), // introduction id 
            "from": $chat_window.data("user"), // logedin user
            "room": $chat_window.data("room"), //chat room id 
            "msg": temp,
            "template": "2",
            "url": url,
            "username": username,
            "type": type ,
            'proposal_id':lastInsertedId
        };
        //socketdata.msg = render_supplier_message(socketdata, templates[0], 0);
        console.log(socketdata);
        socket.emit("pitch", socketdata);
    }
    initJs();
}
*/

function bindEditClick(){
    $('.btnEditPitch').click(function(){console.log($(this).data('id'))});
}

function updateOnlineUsers(data){
    $('[id^="o_stat_"]').removeClass('online-dot').addClass('offline-dot');
    if(data){
        for (var i = data.length - 1; i >= 0; i--) {
            $('#o_stat_'+data[i]).removeClass('offline-dot').addClass('online-dot');
        };
    }
}

function cleanMsg(msg){
    var temp = msg
    var blacklist = ['<script', '<script>','</script>','<style>','</style>'];
    var replace_with = ''; 
    $.each(blacklist, function (key, val) {
        // search for value and replace it
        msg = msg.replace(blacklist[key], replace_with);
    })
    if(temp!=msg)
        msg =msg +" - Trimmed bad words";
    return msg;
}

function updateTyping() {
    if (socketId) {
        if (!typing) {
            startTypingUpdate();
        }
        lastTypingTime = (new Date()).getTime();

        setTimeout(function() {
            var typingTimer = (new Date()).getTime();
            var timeDiff = typingTimer - lastTypingTime;
            if (timeDiff >= TYPING_TIMER_LENGTH && typing) {
                stopTypingUpdate();
            }
        }, TYPING_TIMER_LENGTH);
    }
}

function stopTypingUpdate() {
    socket.emit('stop typing', {
        "room": $chat_window.data("room") 
    });
    typing = false;
}

function startTypingUpdate() {
    socket.emit('typing', {
        "room": $chat_window.data("room")
    });
    typing = true;
}

function render_supplier_message(data, t, align) {
    var temp = t.template;
    temp = temp.replace('{{url}}', data.url);
   
    //replace all occurrence of alignment
    var placeholders = t.placeholders.split(',');
    for (var i = 0; i < placeholders.length; i++) {
        $.each(data, function(index, value) {
            var p = placeholders[i].substr(2);
            p = p.substr(0, p.length - 2);
            if (p == index) {
                temp = temp.replace(placeholders[i], value);
            }
        });
    };
    temp = temp.replace("{{ondate}}", moment(Date()).fromNow()); 
    temp = temp.replace("dummy", (new Date()).toString());
    var thistemp =temp+ '<div class="pull-right mr20 mt5"><span class="fs10 grey-text mr10">Seen By:</span><a href=""><img width="30" src="'+url+'" class="img-circle"></a></div></div>';
    
    $chattingscrollWindow.prepend(thistemp);
    initJs();
    $txtChatWindow.val('');
    return temp;
}

function updatechatTime() {
    $('.time').each(function() {
        //console.log("updating time ", typeof($(this).data('last')));
        if($(this).data('last')!== ''){
           // console.log(moment($(this).data('last')));
            $(this).html(moment($(this).data('last')).fromNow());
        }
    });
}

function initJs() {
    if(typeof(Core) !='undefined'){
        Core.init();            
    }
}

function initChat() {
    var data = {
        "dhId": dhId,
        "room": $("#chat-window").data("room"), //chat room id 
    };
    console.log(data);
    socket.emit('init', data);
    dhId = $("#dhId").val();
    $chat_window = $("#chat-window");
    $txtChatWindow = $("#txtChatWindow");
    $txtChatStatusWindow = $("#txtChatStatusWindow");
    $window = $(window);
    $chattingscrollWindow = $("#chattingscrollWindow"); // ul box for chatting 
    $btnChatWindow = $("#btnChatWindow");
    $btnChatWindow.bind("click");

    $txtChatWindow.on('keydown', function(event) {
        console.log('writing');
        // When the client hits ENTER on their keyboard
        if (event.which === 13) {
            var msg = $txtChatWindow.val().trim();
            sendMessage(msg);
            stopTypingUpdate();

        }
        updateTyping();
    });
}

function addUserClick()
{
    
}
