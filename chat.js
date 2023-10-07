// // JavaScript code for chat functionality

// // Function to scroll the chat box to the bottom
// function scrollToBottom() {
//     var chatBox = document.getElementById('chat-box');
//     chatBox.scrollTop = chatBox.scrollHeight;
// }

// // Function to send a message
// function sendMessage() {
//     var messageInput = document.getElementById('message-input');
//     var message = messageInput.value.trim();

//     if (message !== '') {
//         var xhr = new XMLHttpRequest();
//         xhr.open('POST', 'insert-chat.php', true);
//         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
//         xhr.onload = function () {
//             if (xhr.readyState === XMLHttpRequest.DONE) {
//                 if (xhr.status === 200) {
//                     // Message sent successfully, you can handle the response here if needed
//                 } else {
//                     // Error sending the message, handle it as needed
//                 }
//             }
//         };
        
//         var formData = new FormData();
//         var incoming_id = document.querySelector('.incoming_id').value;
//         formData.append('incoming_id', incoming_id); // Get the incoming_id from your form
//         formData.append('message', message);
        
//         xhr.send(formData);
        
//         // Clear the input field
//         messageInput.value = '';
//     }
// }

// // Event listener for the message form
// document.getElementById('message-form').addEventListener('submit', function (e) {
//     e.preventDefault();
//     sendMessage();
// });

// // Periodically update the chat
// setInterval(function () {
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'get-chat.php', true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.onload = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 var data = xhr.responseText;
//                 document.getElementById('chat-box').innerHTML = data;
//                 scrollToBottom();
//             }
//         }
//     };
//     var incoming_id = document.querySelector('.incoming_id').value;
    
//     xhr.send('incoming_id=' + incoming_id); // Get the incoming_id from your form
// }, 1000); // Adjust the interval as needed

// // Scroll to the bottom when the page loads
// window.onload = function () {
//     scrollToBottom();
// };










// // JavaScript code for chat functionality

// // Function to scroll the chat box to the bottom
// // function scrollToBottom() {
// //     var chatBox = document.getElementById('chat-box');
// //     chatBox.scrollTop = chatBox.scrollHeight;
// // }

// // // Function to send a message
// // function sendMessage() {
// //     var messageInput = document.getElementById('message-input');
// //     var message = messageInput.value;

// //     if (message.trim() !== '') {
// //         var xhr = new XMLHttpRequest();
// //         xhr.open('POST', 'insert-chat.php', true);
// //         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
// //         xhr.onload = function () {
// //             if (xhr.readyState === XMLHttpRequest.DONE) {
// //                 if (xhr.status === 200) {
// //                     // Message sent successfully
// //                     // You can update the chat box with the newly sent message if needed
// //                     // For example, assuming your response is JSON:
// //                     var response = JSON.parse(xhr.responseText);
// //                     if (response.status === 'success') {
// //                         // Message sent successfully, you can display it in the chat box
// //                         var chatBox = document.getElementById('chat-box');
// //                         chatBox.innerHTML += '<div class="message outgoing">' + response.message + '</div>';
// //                         scrollToBottom(); // Scroll to the bottom to show the new message
// //                     } else {
// //                         // Handle other success scenarios or display a general success message
// //                     }
// //                 } else {
// //                     // Error sending the message, handle it as needed
// //                     console.error('Error sending message. Status code: ' + xhr.status);
// //                 }
// //             }
// //         };
        
        
// //         // Get the incoming_id from the hidden input field
// //         var incoming_id = document.querySelector('.incoming_id').value;
        
// //         var formData = new FormData();
// //         formData.append('incoming_id', incoming_id);
// //         formData.append('message', message);
        
// //         xhr.send(formData);
        
// //         // Clear the input field
// //         messageInput.value = '';
        
// //         // Scroll to the bottom of the chat
// //         scrollToBottom();
// //     }
// // }


// // var sendButton = document.querySelector('button[type="submit"]');
// // if (sendButton) {
// //     sendButton.addEventListener('click', function (e) {
// //         e.preventDefault(); // Prevent the default form submission
// //         sendMessage(); // Call the sendMessage function to send the message
// //     });
// // }

// // // Periodically update the chat
// // setInterval(function () {
// //     var xhr = new XMLHttpRequest();
// //     xhr.open('POST', 'get-chat.php', true);
// //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
// //     xhr.onload = function () {
// //         if (xhr.readyState === XMLHttpRequest.DONE) {
// //             if (xhr.status === 200) {
// //                 var data = xhr.responseText;
// //                 document.getElementById('chat-box').innerHTML = data;
// //                 scrollToBottom();
// //             }
// //         }
// //     };
    
// //     // Get the incoming_id from the hidden input field
// //     var incoming_id = document.querySelector('.incoming_id').value;
    
// //     xhr.send('incoming_id=' + incoming_id);
// // }, 1000); // Adjust the interval as needed

// // // Scroll to the bottom when the page loads
// // window.onload = function () {
// //     scrollToBottom();
// // };


// JavaScript code for chat functionality

// Function to scroll the chat box to the bottom
var incomingid = document.querySelector('[name="incomingid"]').value;

function scrollToBottom() {
    var chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
}


function sendMessage() {
    var messageInput = document.getElementById('message-input');
    var message = messageInput.value;

    if (message !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'insert-chat.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        // Combine both parameters in a single string
        var data = 'incomingid=' + incomingid + '&message=' + message;

        xhr.onload = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Message sent successfully, you can handle the response here if needed
                    console.log("success");
                    console.log(xhr.responseText);
                } else {
                    // Error sending the message, handle it as needed
                    console.error('Error sending message. Status code: ' + xhr.status);
                }
            }
        };
        
        xhr.send(data); // Send the combined data
        // Clear the input field
        messageInput.value = '';
    }
}


// Event listener for the message form
document.getElementById('message-form').addEventListener('submit', function (e) {
    e.preventDefault();
    sendMessage();
});

// Periodically update the chat
setInterval(function () {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'get-chat.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = xhr.responseText;
                document.getElementById('chat-box').innerHTML = data;
                scrollToBottom();
            }
        }
    };

    xhr.send('incomingid=' + incomingid); // Get the incoming_id from your form
}, 1000); // Adjust the interval as needed

// Scroll to the bottom when the page loads
window.onload = function () {
    scrollToBottom();
};
