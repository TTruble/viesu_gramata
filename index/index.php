<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="chungtainer">
        <h1 style="color: white;">Viesu grāmata</h1>
        <form id="task-form">
             <input type="name" id="name" placeholder="name" required>
            <input type="email" id="email" placeholder="email" required>
            <input type="postname" id="postname" placeholder="postname" required>
            <textarea id="message" placeholder="message here..." required></textarea>
            </select>
            <button type="submit">Add Message</button>
        </form>
        <div class="scrolltainer">
            <table id="message-list">
                <thead>
                    <tr>
                        <td>name</td>
                        <td>email</td>
                        <td>postname</td>
                        <td>message</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
</table>
        </div>
    </div>



    <script src="script.js"></script>
</body>

</html>