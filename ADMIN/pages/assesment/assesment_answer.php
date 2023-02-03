<?php
	session_start();
	$qid = $_GET['qid'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>
</head>
<body>
<div class="container">
	
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>
			</div>
			<div class="row">
				<a href="index.php" class="btn btn-primary" style="background-color:#1ddd9f; border-color:#1ddd9f;"><span class="glyphicon glyphicon-list-alt"></span> HOME</a>
				<a href="assesment_details.php?id=<?php echo $qid; ?>" class="btn btn-primary" style="background-color:#1ddd9f; border-color:#1ddd9f;"><span class="glyphicon glyphicon-arrow-left"></span> BACK</a>
				<a href="#addquestion" data-toggle="modal" class="btn btn-primary" style="background-color:#1ddd9f; border-color:#1ddd9f;"><span class="glyphicon glyphicon-plus"></span> ADD QUESTION</a>
			</div>
			<div class="height10">
			</div>
			<div class="row">
				<table id="myTable" class="table table-bordered table-striped">
					<thead>
						<th>ID</th>
						<th>ANSWER</th>
						<th>ACTION</th>
					</thead>
					<tbody>
						<?php
						    $q = $_GET['id']; 
							include_once('../../../connection/connection.php');
							$sql = "SELECT * FROM `topic_assesment_answers` WHERE question_id = '$q'";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
                              
                              
							    echo 
							    "<tr>
							    	<td>".$row['id']."</td>
								    <td>".$row['answer']."</td>
									<td>
									  <a href='#editanswer_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal' style='background-color:#1ddd9f; border-color:#1ddd9f;'><span class='glyphicon glyphicon-edit'></span> UPDATE </a>
									</td>
								</tr>";	
							    
								include('edit_delete_answer.php');
							}
							

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include('add_question.php') ?>

<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>
</html>