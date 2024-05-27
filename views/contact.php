<h2> Contact Form - <?= $username ?> </h2>
<form action="/contact" method="POST">
    <label for="name">Name:</label>
    <input name="name" type="text" required />

    <label for="msg">Message:</label>
    <input name="msg" type="text" required />

    <button type="submit">Submit</button>
</form>