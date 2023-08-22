<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accounts Management</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Accounts Management</h2>
    <div class="row">
      <!-- User Profile Information -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">User Profile</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" value="John Doe">
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" value="johndoe@example.com">
              </div>
              <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" value="555-123-4567">
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Password Management -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">Password Management</div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword">
              </div>
              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword">
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmPassword">
              </div>
              <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Notification Preferences -->
    <div class="card">
      <div class="card-header">Notification Preferences</div>
      <div class="card-body">
        <form>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="emailNotifications" checked>
            <label class="form-check-label" for="emailNotifications">Receive Email Notifications</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="smsNotifications">
            <label class="form-check-label" for="smsNotifications">Receive SMS Notifications</label>
          </div>
          <button type="submit" class="btn btn-primary">Save Preferences</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Link to Bootstrap JS and Popper.js -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
