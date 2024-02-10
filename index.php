<?php
//connecting database
$servername="localhost";
$username="root";
$password="";
$database="note";
$conn=mysqli_connect($servername,$username,$password,$database);

//create connection
$insert=false;
if(!$conn){
	die("sorry we fail to connect: ".mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD']=='POST'){
	$title=$_POST["title"];
$description=$_POST["description"];

$sql="INSERT INTO `note` (`title`, `description`) VALUES ( '$title', '$description')";
$result = mysqli_query($conn,$sql);
if($result){
	$insert=true;
	
}
else{
	echo"we could not data record successfuly bracause this error ..>".mysqli_error($conn);;
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  </head>
  <title>iNotes</title>
  <body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="#">Contact us</a>
        </li>
		</ul>
        <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php
if($insert){
	echo"<div class='alert alert-success' role='alert'>
	<strong>success!</strong>your notes has been inserted successfuly
  <button type='button' class='close' data-dismiss='alert' aria-label='close'>
  <span aria-hidden='type;>&times;</span>
 </button>
</div>";
}
?>

<div class="container my-4">
<h1>Add a Note</h1>
<form action="/index/index.php" method="post">
  <div class="form-group">
    <label for="title">Note title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    </div>
  <div class="form-group">
    <label for="description" class="form-label">Note description</label>
  <textarea class="form-control"  name="description" id="description" rows="4"></textarea>
  </div>
  <button type="submit" class="btn btn-primary my-3">Add Note</button>
</form>
</div>

<div class="container my-4">
<table class="table" id="myTable">
<hr>
  <thead>
    <tr>
      <th scope="col">S-no</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
$sql="SELECT * FROM `note`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
	    echo"<tr>
      <th scope='row'>" .$row['S-no']. "</th>
      <td>" .$row['title']. "</td>
      <td>" .$row['description']. "</td>
      <td> Action</td>
    </tr>";
		
	}
?>
  </tbody>
  </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   <script>
  $(document).ready(function(){
$('#myTable').DataTable();
});
  </script>
  </body>
</html>

