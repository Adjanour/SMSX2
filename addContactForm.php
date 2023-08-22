<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body style="border-radius:10px;">
    <div class="container">
    <div>
        <div class="card-title">
    <h2>Add New Contact</h2>
    </div>
    <div class="form-card">
    <form class="form" action="addcontacts.php" method="post">
        <div class="mb-3">
        <input type="text"  class="form-control"  id="name" name="fullname" placeholder="Full name"><br>
        </div>
        <div class="mb-3">
        <input type="text"  class="form-control" id="phone" name="phonenumber" placeholder="Phone Number" required><br>
        </div>
        <div class="mb-3">
        <input type="email"  class="form-control" id="email" name="email" placeholder="Email"><br>
        </div>
        <div class="mb-3">
        <input type="submit" class="btn btn-primary" value="Add Contact">
        </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>
