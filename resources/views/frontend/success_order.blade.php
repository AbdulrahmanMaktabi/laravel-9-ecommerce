<h1>Success Order</h1>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        console.log("DOM Loaded");

        const channel = Echo.private(`App.Models.User.${userId}`);
        console.log("Subscribing to channel:", `App.Models.User.${userId}`);

        channel.notification((data) => {
            console.log("Notification Received:", data);
            alert("Notification received: " + data.message);
        });
    });
</script>
