var csrfToken = document.documentElement.dataset.csrf; // Correct

    function fadeOutAlert(alertId) {
        setTimeout(function () {
            var alert = document.getElementById(alertId);
            if (alert) {
                alert.style.transition = "opacity 1s";
                alert.style.opacity = 0;
                setTimeout(function () {
                    alert.style.display = "none";
                }, 1000);
            }
        }, 2500); // 2500 milliseconds (2.5 seconds)
    }

    // Call the fadeOutAlert function for each alert message
    fadeOutAlert("alert");

    function toggleNotifications(event) {
        // Get the CSRF token from the meta tag

        // Make an AJAX request to update the read_at column
        $.ajax({
            url: "/mark-notifications-as-read",
            method: "POST",
            data: {
                _token: csrfToken
            },
            success: function (response) {
                // Update the UI as needed
                var notificationsContainer = document.getElementById('notificationsContainer');
                notificationsContainer.classList.toggle('hidden');
                // You can update the notification count or any other UI element here
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

        // Close the profile menu if it is open
        var logoutMenu = document.getElementById("logout");
        logoutMenu.classList.add("hidden");

        // Prevent the click event from propagating to the document click event listener
        event.stopPropagation();
    }

    document.addEventListener("click", function (event) {
        var notificationsContainer = document.getElementById("notificationsContainer");
        var targetElement = event.target;

        // Check if the clicked element is inside the notifications container
        if (!notificationsContainer.contains(targetElement) && targetElement.id !== "notificationCount") {
            // If not, hide the notifications container
            notificationsContainer.classList.add("hidden");
        }
    });

    function showProfile(event) {
        // Prevent the click event from propagating to the document click event listener
        event.stopPropagation();

        var logoutMenu = document.getElementById("logout");
        logoutMenu.classList.toggle("hidden");

        // Close the notifications container if it is open
        var notificationsContainer = document.getElementById('notificationsContainer');
        notificationsContainer.classList.add('hidden');
    }

    document.addEventListener("click", function (event) {
        var logoutMenu = document.getElementById("logout");
        var targetElement = event.target;

        // Check if the clicked element is inside the logout div
        if (!logoutMenu.contains(targetElement) && targetElement.id !== "logoutButton") {
            // If not, hide the logout div
            logoutMenu.classList.add("hidden");
        }
    });

    function toggleSettings() {
        var mobileMenu = document.getElementById("settings");
        mobileMenu.classList.toggle("hidden");
    }
    