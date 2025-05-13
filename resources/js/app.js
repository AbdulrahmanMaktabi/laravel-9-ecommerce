import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Rename the channel || replace channel type if private 

var channel = Echo.private(`App.Models.User.${userId}`);
console.log(channel);

channel.notification(function(data) {
    console.log(data.body);
    alert("Order Success");
});