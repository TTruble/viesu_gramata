document.addEventListener('DOMContentLoaded', function () {
    fetchMessages();

    document.getElementById('task-form').addEventListener('submit', function (e) {
        e.preventDefault();
        submitMessage();
    });
});
 
const tbody = document.querySelector('tbody');

function fetchMessages() {
    const messageList = document.getElementById('message-list');

    // Make an AJAX request to fetch messages
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'message_api.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText)
            const zinojumi = JSON.parse(xhr.responseText);

            for(elem of tbody.querySelectorAll('tr')) elem.remove();

            zinojumi.forEach(function (zinojums) {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${zinojums.name}</td>
                <td>${zinojums.email}</td>
                <td>${zinojums.postname}</td>
                <td>${zinojums.message}</td>
                <td>
                </td>`;
                console.log(row);
                tbody.appendChild(row);
            });

            console.log(tbody);

            console.log('works');

        }
    };

    xhr.send();
}

function submitMessage() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const postname = document.getElementById('postname').value;
    const message = document.getElementById('message').value;

    if (!name || !postname) {
        alert('name and post name are required.');
        return;
    }

    const messageData = {
        name,
        email,
        postname,
        message
    };

 
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'message_api.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if (xhr.status === 200) {
            fetchMessages();
            document.getElementById('message-list').reset();
        }
    };

    xhr.send(JSON.stringify(messageData));
}