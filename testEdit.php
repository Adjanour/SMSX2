<?php
$ID = $_GET['ID'];
$Id = (int)$ID;
$ch = curl_init();
$api_url = "http://127.0.0.1:8000/employee";
$url = "$api_url/$Id";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add Bootstrap CSS link -->
    <link href="../../../Users/Kirk/PhpstormProjects/API_INTERACTION/css/bootstrap.css" rel="stylesheet">
    <link href="../../../Users/Kirk/PhpstormProjects/API_INTERACTION/css/total2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="APIUpdate.php?ID=<?php echo $data[0]['EmployeeId'] ?>" method="post">

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="NAME" name="NAME" value=<?php echo $data[0]["EmployeeName"]?> ?>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="DEPARTMENT" name="DEPARTMENT" value=<?php echo $data[0]['Department']?> required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="DATE OF JOINING" name="DATE" value=<?php echo $data[0]['DateofJoining'] ?> required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="PROFILE" name="PROFILE" value=<?php echo $data[0]['PhotoFileName'] ?> required>
        </div>

        <input type="submit" class="btn btn-primary" name="Update" value="Update Record">
    </form>
</div>
</body>
<script type="text/javascript" src="js/bootstrap.js"></script>

</html>
