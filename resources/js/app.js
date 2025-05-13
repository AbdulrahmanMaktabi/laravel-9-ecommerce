import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Rename the channel || replace channel type if private 
var channel = Echo.private(`App.Models.User.${userId}`);
channel.notification(function(data) {
    console.log(data);
    alert(data.message);
    notyf.success(data.message);
});