import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Rename the channel || replace channel type if private 
var channel = Echo.private(`App.Models.User.${userId}`);
channel.notification(function(data) {
    setTimeout(function() {
        notyf.success(data.message); // Show the notification in Notyf style
    }, 3000); // Delay of 3000 milliseconds = 3 seconds

});