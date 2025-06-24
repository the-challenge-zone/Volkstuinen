fetch('../../Backend/Chart_Data.php', {
    method: 'GET',
    credentials: 'include',
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    if (data.error || Object.keys(data).length === 0) {
        console.warn('No usage data available');
        return;
    }
const labels = Object.keys(data);
    const values = Object.values(data);
    const ctx = document.getElementById('Usage_Chart').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    'rgba(0, 102, 0, 1)',
                    'rgba(153, 255, 153, 1)'
                ],
                borderColor: [
                    'rgba(0, 102, 0, 0)',
                    'rgba(153, 255, 153, 0)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: { enabled: true }
            }
        }
    });
})
.catch(error => {
    console.error('Error fetching usage chart data:', error);
});
    
// ----------------------------
// PIE CHART 2: COMPLEX CHART
// ----------------------------
window.addEventListener('DOMContentLoaded', () => {
    console.log('complexChartData:', complexChartData);

    if (typeof complexChartData !== 'undefined' && complexChartData.length > 0) {
        const labels = complexChartData.map(item => item.name);
        const data = complexChartData.map(item => item.size);
        const ctx = document.getElementById('Complex_Chart').getContext('2d');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Grondverdeling (m²)',
                    data: data,
                    backgroundColor: [
                        '#003300','#004D00','#006600','#008000','#009900','#00B300','#00CC00','#00E600','#00FF00','#33FF33','#66FF66','#99FF99'
                    ],
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: { enabled: true }
                }
            }
        });
    } else {
        console.warn('complexChartData is undefined or empty');
    }
});

    fetch("../../Backend/FetchMessages.php",
        {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to fetch messages.");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                renderNotifications(data.messages);
            } else {
                console.error(data.error);
            }
        })
        .catch((error) => {
            console.error("Error fetching messages:", error);
        });


    // Render notifications
    function renderNotifications(messages) {
        notificaties.innerHTML = "";

        if (messages.length === 0) {
            notificaties.textContent = "Geen berichten beschikbaar.";
        }

        messages.forEach((message) => {
            const notifItem = document.createElement("div");
            notifItem.className = "notif-item";
            notifItem.textContent = message.Subject;

            notifItem.addEventListener("click", function () {
                openModal(message.Subject, message.Message);
            });

            notificaties.appendChild(notifItem);
        });
    }

    const modal = document.getElementById("modal");
    const modalTitle = document.getElementById("modal-title");
    const modalDescription = document.getElementById("modal-description");
    const closeBtn = document.getElementById("close-btn");

    function openModal(title, description) {
        modal.style.display = "flex";
        modalTitle.textContent = title;
        modalDescription.textContent = description;
    }

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    fetchMessages();

