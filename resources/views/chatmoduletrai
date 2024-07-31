@extends('layouts.guest')

@section('content')
<section class="mainsection chat_section py-4">
    <div class="container chat_app">
        @if(isset($chats) && count($chats) > 0 || (!empty(request()->route('id'))) )
        <div class="row app-one">
            <div class="col-lg-4 col-md-12 side">
                <div class="side-one">
                    <div class="row heading">
                        <div class="col-4">
                            <h2>MESSAGE</h2>
                        </div>
                        <div class="form-group has-feedback mb-0 offset-1 col-7">
                            <input id="myInput" type="text" class="form-control" name="searchText"
                                placeholder="Search by Name" onkeypress="return notSpace(event)">
                        </div>
                    </div>
                    <div class="sideBar chatUserList">

                        <input type="hidden" id="view_blade_chat_id" name="view_chat_id"
                            value="{{request()->route('id')}}">
                        <input type="hidden" name="chat_id" id="chat_id" value="{{$chat_id}}">

                        @foreach($chats as $chat)
                        @if(!empty(@$chat['last_message']['id']))
                        <div class="list active_user_{{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['id'] : @$chat['receiver_user']['id']}}"
                            id="list"
                            chat_id="{{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['id'] : @$chat['receiver_user']['id']}}"
                            onclick="doWithThisElement({{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['id'] : @$chat['receiver_user']['id']}},this,{{@$chat['id']}})">
                            <div class="sideBar-body">
                                <div class="avatar-icon">
                                    @if(!empty($chat['sender_user']['profile_image']))
                                    <img src="{{asset('public/'.$chat['sender_user']['profile_image'])}}">
                                    @elseif(!empty($chat['receiver_user']['profile_image']))
                                    <img src="{{asset('public/'.$chat['receiver_user']['profile_image'])}}">
                                    @else
                                    <img src="{{asset('public/images/default-image.png')}}">
                                    @endif
                                </div>
                                <div class="chat-person">


                                    <h4 class="name-meta">
                                        {{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['first_name'] : @$chat['receiver_user']['first_name']}}
                                    </h4>
                                    @if(isset($chat['last_message']['type']) && $chat['last_message']['type'] == "T")
                                    <p class='last_message_{{$chat['receiver_user']['id']}}' style="width:132px;">
                                        {{$chat['last_message']['message']}} </p>
                                    @elseif(isset($chat['last_message']['type']) && $chat['last_message']['type'] ==
                                    "I")
                                    <p class='last_message_{{$chat['receiver_user']['id']}}'><i class="fa fa-image"></i>
                                        Image</p>
                                    @elseif(isset($chat['last_message']['type']) && $chat['last_message']['type'] ==
                                    "D")

                                    <p
                                        class='last_message_{{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['id'] : @$chat['receiver_user']['id']}}'>
                                        <i class="fa fa-file-pdf-o"></i> Pdf
                                    </p>
                                    @else
                                    <p></p>
                                    @endif
                                </div>
                                <span
                                    class="time-meta pull-right msg_current_time_{{($chat['receiver_user']['id'] == Auth::id()) ? @$chat['sender_user']['id'] : @$chat['receiver_user']['id']}}">{{@$chat['last_message']['created_at']}}
                                </span>
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>


                </div>

            </div>



            <div class="col-lg-8 col-md-12 conversation">

                <div class="message" id="conversation">
                    <div class="chat-person-name">
                        <!-- <img src="public/images/chat2.png" alt="image">
          <h3>Maria Roy</h3>
          <div class="dropdown clear-chat">
           <i class="fa fa-ellipsis-v" type="button" data-toggle="dropdown"></i>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Clear Chat</a>
            </div>
          </div> -->
                    </div>
                    <!-- <div class="message_header1 py-3 px-4">
            <div class="sideBar-name p-0">
              <div class="chatuser_details">
                <h4>Maria</h4>
                <div class="chat-area-box">
                  <span class="mb-0 text-secondary" style="font-size: 15px;">Hi, i am josephin. How are you..</span>
                  <p class="message-time">
                    11:00 PM
                  </p>
                </div>
              </div>
            </div>
         </div> -->

                    <input type='hidden' name='user_id' id='user_id' value="">
                    <input type='hidden' name='chat_id' id='room_chat_id' value="">
                    <!-- Badge Modal -->
                    <div class="modal fade" id="modalUploadFile" role="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Preview File</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('public/images/default-image.png')}}" class="profile_picture"
                                        alt="file">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <input type="submit" id="confirmUploadFile" class="btn btn-info badge_submit_reason"
                                        value="Upload" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chat_outer current_user_div " style="display:none">

                    </div>

                </div>
                <div class="row reply">
                    <div class="col-sm-12 col-xs-12 reply-main px-0">
                        <textarea class="form-control" rows="1" id="message" placeholder="Type a message"></textarea>
                        <img src="{{asset('public/images/add-more.png')}}" width="30" class="add-image-box">
                        <form name="photo" id="imageUploadForm" enctype="multipart/form-data"
                            action="{{route('upload_chat_doc')}}" method="post">
                            <input type="file" name="document" accept=".png, .jpg, .jpeg, .pdf"
                                onchange="chatfileurl(this);" class="send_doc" id="chatFileUpload">
                            <input type="text" name="chat_id" id="file_chat_id" value="{{$chat_id}}">
                            <input type='hidden' name='chat_id' id='file_room_chat_id' value="">
                            @csrf
                            <input type="submit" name="upload" value="" />
                        </form>

                        <button class="send-msg " id='send'></button>
                    </div>
                </div>

            </div>
        </div>
        @else
        <a href="{{route('coaches')}}">
            <h1 style="padding-top: 226px; padding-top: 223px; padding-bottom: 384px; padding-left: 233px;">Hi !! click
                here to start the chat with coach.</h1>
        </a>
        @endif
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ env('SOCKET_URL')}}/socket.io/socket.io.js"></script>


<script>
//send message when we press enterkey
var input = document.getElementById("message");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("send").click();
    }
});
</script>

<!-- submit on upload -->
<script>
$(document).ready(function(e) {
    $('#imageUploadForm').on('submit', (function(e) {
        $('#modalUploadFile').modal('hide');
        e.preventDefault();
        var formData = new FormData(this);
        var file_name = $('#chatFileUpload').val();
        var file_chat_id = $('#file_chat_id').val();
        var file_room_chat_id = $('#file_room_chat_id').val();

        //alert(ffff);
        console.log("file_name", file_name);
        // check file extention
        let fileName, fileExtension;
        fileName = file_name;

        fileExtension = fileName.split('.').pop();
        ///////////
        // upload document & images

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var socket = io.connect("{{ env('SOCKET_URL')}}");
                // alert(fileExtension);
                if (fileExtension == "png" || fileExtension == "jpeg" ||
                    fileExtension == "jpg") {
                    var message_type = 'I';
                } else if (fileExtension == "pdf") {
                    var message_type = 'D';
                } else {
                    var message_type = 'O';
                }
                if (message_type == 'O') {
                    alert("Invalid file format ");
                    return false;
                }

                if (data.status) {
                    e.preventDefault();
                    var message = data.url ?? '';
                    var reciever_id = parseInt($('#user_id').val());
                    var sender_id = '{{auth()->user()->id}}';
                    // var message = "hello this is my message!!!";

                    var data = {
                        sender_id: parseInt(sender_id),
                        message: message,
                        message_type: message_type,
                        receiver_id: parseInt(reciever_id),
                        type: 'admin',
                        room_id: file_chat_id ?? file_room_chat_id
                    };


                    console.log(socket);
                    $('#message').val('');
                    socket.emit('message', data);
                }
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });

    }));

    $("#chatFileUpload").change(function() {
        var modal = $('#modalUploadFile').modal();
        modal.show();
    });

    $("#confirmUploadFile").click(function() {
        $("#imageUploadForm").submit();
    });
});

$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        console.log("myInput");
        var value = $(this).val().toLowerCase();
        var length = $.trim($("#myInput").val()).length;
        if (length == 0) {
            console.log("length 0");
            $(".list").filter(function() {
                $(this).toggle($(this).find('.name-meta').text().toLowerCase().indexOf(value) >
                    -1)
            });

        } else {
            $(".list").filter(function() {

                $(this).toggle($(this).find('.name-meta').text().toLowerCase().indexOf(value) >
                    -1)
            });

        }


    });
});
</script>





<script>
function doWithThisElement(sidebar_chat_id, active, room_chat_id) {

    //alert(sidebar_chat_id);
    $('.list').removeClass("active-chat"); //remove active class
    if (active) {
        $(active).addClass("active-chat"); // add active class
    } else {
        $('.active_user_' + sidebar_chat_id).click();
    }
    // alert("User: " + sidebar_user_id);
    var sidebar_user = sidebar_chat_id;
    current_user = sidebar_chat_id;
    $('#user_id').val(sidebar_chat_id)
    $('#room_chat_id').val(room_chat_id)
    const user_id = "{{auth()->user()->id}}";
    $.ajax({
        url: "{{route('chat_data')}}",
        type: 'GET',
        data: {
            'sidebar_chat_id': sidebar_user
        },
        dataType: 'json', // added data type

        success: function(response) {

            $('.current_user_div').html('')
            user_name = response.data.receiver.first_name
            id = response.data.receiver.id

            last_name = response.data.receiver.last_name
            reload = 0;
            if (!response.data[0]) {
                // console.log(response);
                reload = 1;


            }
            /*****************************************/

            /* inbox chat header*/

            /****************************************/

            var html = '';
            if (response.data.receiver.profile_image) {
                html = '<img src="' + app_url + '/public/' + response.data.receiver.profile_image +
                    '" alt=""><h3>' + user_name + ' ' + last_name +
                    '</h3><div class="dropdown clear-chat"><i class="fa fa-ellipsis-v" type="button" data-toggle="dropdown"></i><div class="dropdown-menu"><button class="dropdown-item clear_chat " onclick="clearChat()" >Clear Chat</button></div>'
            } else {
                html = '<img src="' + app_url + '/public/images/default-image.png" alt=""><h3>' +
                    user_name + ' ' + last_name +
                    '</h3><div class="dropdown clear-chat"><i class="fa fa-ellipsis-v" type="button" data-toggle="dropdown"></i><div class="dropdown-menu"><button class="dropdown-item clear_chat" onclick="clearChat()">Clear Chat</button></div>'
            }
            $(".chat-person-name").show().html(html);

            /*****************************************/

            /* inbox: get all chat*/

            /****************************************/
            $.each(response.data.chat_messages, function(key, data) {
                console.log(data);
                console.log("message box");

                /*****************************************/

                /* inbox: sender's messages*/

                /****************************************/
                if (data.chat_status == '0' || ((data.chat_status == '1' && data.clear_by_sender ==
                        null) && data.clear_by_receiver != user_id) || ((data.chat_status == '1' &&
                        data.clear_by_receiver == null) && (data.chat_status == '1' && data
                        .clear_by_sender != user_id))) {

                    if (user_id == data.sender_id) {
                        $('.current_user_div').show()
                        var html = '';
                        if (data.type == 'T') {
                            html =
                                '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="mesage_text current_user_message">' +
                                data.message + '</div><span class="message-time">' + data
                                .created_at + '</span></div> </div>'

                        } else {
                            if (data.type == 'I') {
                                html =
                                    '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="current_user_message"><div><a href="' +
                                    data.message + '" target="_blank"><img src="' + data.message +
                                    '" width=100px; height=100px;></a></div></div><span class="message-time">' +
                                    data.created_at + '</span></div> </div>'
                            } else {
                                html =
                                    '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="current_user_message"><div><a href="' +
                                    data.message + '" target="_blank"><img src="' + app_url +
                                    '/public/chat_doc/pdf.png" width=100px; height=100px;></a></div></div><span class="message-time">' +
                                    data.created_at + '</span></div> </div>'

                            }
                        }


                    } else {
                        var html = '';
                        if (data.type == 'T') {
                            html =
                                '<div class="message_header1 py-3 px-4"><div class="sideBar-name p-0"><div class="chatuser_details"><h4>' +
                                user_name +
                                '</h4><div class="chat-area-box"><span class="mb-0 text-secondary" style="font-size: 15px;">' +
                                data.message + '</span><p class="message-time"> ' + data
                                .created_at + ' </p> </div></div></div></div>'

                        } else {
                            if (data.type == 'I') {
                                html =
                                    '<div class="message_header1 py-3 px-4"><div class="sideBar-njame p-0"><div class="chatuser_details"><h4>' +
                                    user_name +
                                    '</h4><div class="chat-area-box-for-doc"><span class="mb-0 text-secondary" style="font-size: 15px;"><div><div><a href="' +
                                    data.message + '" target="_blank"><img src="' + data.message +
                                    '" width=100px; height=100px;></a></div></span><p class="message-time"> ' +
                                    data.created_at + ' </p> </div></div></div></div>'
                            } else {
                                html =
                                    '<div class="message_header1 py-3 px-4"><div class="sideBar-njame p-0"><div class="chatuser_details"><h4>' +
                                    user_name +
                                    '</h4><div class="chat-area-box-for-doc"><span class="mb-0 text-secondary" style="font-size: 15px;"><div><a href="' +
                                    data.message + '" target="_blank"><img src="' + app_url +
                                    '/public/chat_doc/pdf.png" width=100px; height=100px;></a></div></span><p class="message-time"> ' +
                                    data.created_at + ' </p> </div></div></div></div>'
                            }
                        }
                    }
                }
                // console.log(html);
                $(".current_user_div").show().append(html);
                $('.current_user_div').scrollTop($('.current_user_div')[0].scrollHeight);

            })
        }
    });

    // $('.current_user_div').scrollTop($('.current_user_div')[0].scrollHeight);
    // $("current_user_div").animate({
    //                 scrollTop: $(
    //                   'current_user_div').get(0).scrollHeight
    //             });
}

$(document).ready(function() {


    var socket = io.connect("{{ env('SOCKET_URL')}}");

    socket.on('message', function(data) {
        console.log("new message------");
        //if(reload == 1){
        //    location.reload();
        //}

        const user_id = "{{auth()->user()->id}}";

        if ((data.message === '') || (data.message === '\n')) {
            console.log("empty message");
            return false;

        }
        if (user_id == data.sender_id) {
            console.log("sender message");
            $('.current_user_div').show()
            var html = '';
            if (data.message_type == 'T') {
                html =
                    '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="mesage_text current_user_message">' +
                    data.message + '</div><span class="message-time">' + data.message_time +
                    '</span></div> </div>'
            } else {
                if (data.message_type == 'I') {
                    html =
                        '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="current_user_message"><div><a href="' +
                        data.message + '" target="_blank"><img src="' + data.message +
                        '" width=100px; height=100px;></a></div></div><span class="message-time">' +
                        data.message_time + '</span></div> </div>'
                } else {
                    html =
                        '<div class="message-main-sender"><div class="sender"><div class="message-name">You</div><div class="current_user_message"><div><a href="' +
                        data.message + '" target="_blank"><img src="' + app_url +
                        '/public/chat_doc/pdf.png" width=100px; height=100px;></a></div></div><span class="message-time">' +
                        data.message_time + '</span></div> </div>'

                }
            }
            var rec = data.receiver_id;


        } else {
            console.log("receiver message");
            var html = '';
            if (data.message_type == 'T') {
                html =
                    '<div class="message_header1 py-3 px-4"><div class="sideBar-name p-0"><div class="chatuser_details"><h4>' +
                    user_name +
                    '</h4><div class="chat-area-box"><span class="mb-0 text-secondary" style="font-size: 15px;">' +
                    data.message + '</span><p class="message-time"> ' + data.message_time +
                    ' </p> </div></div></div></div>'

            } else {


                if (data.message_type == 'I') {
                    html =
                        '<div class="message_header1 py-3 px-4"><div class="sideBar-njame p-0"><div class="chatuser_details"><h4>' +
                        user_name +
                        '</h4><div class="chat-area-box-for-doc"><span class="mb-0 text-secondary" style="font-size: 15px;"><div><a href="' +
                        data.message + '" target="_blank"><img src="' + data.message +
                        '" width=100px; height=100px;></a></div></span><p class="message-time"> ' + data
                        .message_time + ' </p> </div></div></div></div>'
                } else {
                    html =
                        '<div class="message_header1 py-3 px-4"><div class="sideBar-njame p-0"><div class="chatuser_details"><h4>' +
                        user_name +
                        '</h4><div class="chat-area-box-for-doc"><span class="mb-0 text-secondary" style="font-size: 15px;"><div><a href="' +
                        data.message + '" target="_blank"><img src="' + app_url +
                        '/public/chat_doc/pdf.png" width=100px; height=100px;></a></div></span><p class="message-time"> ' +
                        data.message_time + ' </p> </div></div></div></div>'

                }
            }

        }

        //message
        console.log(data.message_type);
        if (data.message_type == 'T') {
            $('.last_message_' + rec).html(data.message);
        } else if (data.message_type == 'I') {
            $('.last_message_' + rec).html('<i class="fa fa-image"></i> Image');
        } else {
            $('.last_message_' + rec).html('<i class="fa fa-file-pdf-o"></i> Pdf');
        }
        $('.msg_current_time_' + rec).html(data.message_time);
        $(".current_user_div").show().append(html);
        var clone_div = $('.last_message_' + rec).parent().parent().parent().clone();
        $('.last_message_' + rec).parent().parent().parent().remove();
        $('.sideBar').prepend(clone_div);

        $('.current_user_div').scrollTop($('.current_user_div')[0].scrollHeight);


        // $('#chat-board').html(response.message);
        //console.log(data);

        // $('.active_user_'+current_user).html('');
        // $('.active_user_'+rec).load(location.href + '.list');

        console.log("reloading the sidebar again ")

        var reciever_id = parseInt($('#user_id').val());
        $.ajax({
            url: "{{route('chat.user_list')}}",
            type: 'GET',
            data: {
                'id': reciever_id
            },
            dataType: 'json', // added data type

            success: function(response) {
                //message

                var clone_div = $('.last_message_' + rec).parent().parent().parent()
                    .clone();
                $('.last_message_' + rec).parent().parent().parent().remove();
                $('.sideBar').prepend(clone_div);

                $('.current_user_div').scrollTop($('.current_user_div')[0].scrollHeight);


            }
        });

    });

    // send message 

    $(".send-msg").click(function(e) {
        // alert('ok');
        var length = $.trim($("#message").val()).length;
        if (length == 0) {
            return false;
        }

        e.preventDefault();
        var message = $('#message').val();
        var document = $('#document').val();
        var reciever_id = parseInt($('#user_id').val());
        var sender_id = '{{auth()->user()->id}}';


        var chat_id = $('#chat_id').val();
        var room_chat_id = $('#room_chat_id').val();
        var room_id = chat_id ?? room_chat_id;

        // alert(room_id);
        // var message = "hello this is my message!!!";
        if (message === '') {
            return false;
        }
        socket.emit('joinroom', room_id);

        var data = {
            sender_id: parseInt(sender_id),
            message: message,
            document: document,
            message_type: 'T',
            receiver_id: parseInt(reciever_id),
            type: 'admin',
            room_id: room_id
        };


        console.log(socket);
        $('#message').val('');
        if (message == '\n') {
            return false;
        }


        socket.emit('message', data);

    })
});
</script>



<script>
$(document).ready(function() {
    var view_blade_id = $("#view_blade_chat_id").val();

    if (view_blade_id !== "") {
        doWithThisElement(view_blade_id);

    } else {
        window.onload = function() {

            $('.list').eq(0).click();
        }
    }
});
</script>
<script>
function notSpace(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 32) {
        return false;
    }
    return true;
}

function clearChat() {
    var chat_id = $('#chat_id').val();
    var room_chat_id = $('#room_chat_id').val();

    var reciever_id = parseInt($('#user_id').val());
    var sender_id = '{{auth()->user()->id}}';
    $.ajax({
        url: "{{route('chat.clear_chat')}}",
        type: 'GET',
        data: {
            'chat_id': chat_id ?? room_chat_id,
            'sender_id': sender_id,
            'receiver_id': reciever_id
        },
        dataType: 'json', // added data type

        success: function(response) {
            SwalOverlayColor();
            swal({
                title: response.status,
                text: response.message,
            })
            $('.current_user_div').html('')
        }
    });
}
</script>
@endsection