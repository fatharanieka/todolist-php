<!DOCTYPE html>
<html lang="en">
<head>
	<title>TO DO LIST</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="netactlib/css/bootstrap.css">
	<script src="netactlib/js/bootstrap.js"></script>
	<style>
		.navbar {
			margin-bottom: 0px;
		}
		.row.content {
			min-height: 555px
		}
		.sidenav {
			background-color: #f8f8f8;
			min-height: 555px
		}
		
		th{
			text-align: center !important;
			text-transform: uppercase !important;
		}
		
		footer {
			background-color: #555;
			color: white;
			padding: 15px;
		}
		.completed {
    text-decoration: line-through;
    color: gray;
}

.task-list {
    list-style-type: none;
    padding: 0;
}

.task-item {
    margin-bottom: 10px;
}

.task-actions {
    margin-left: 10px;
}

		
		@media screen and (max-width: 767px) {
			.sidenav {
				height: auto;
				padding: 15px;
			}
			
			.row.content {
				height: auto;
			}
		}
		.completed {
    text-decoration: line-through;
    color: gray;
}

.task-list {
    list-style-type: none;
    padding: 0;
}

.task-item {
    margin-bottom: 10px;
}
		</style>
</head>
<body>
<?php
include_once 'header.php';
?>

<div class="container-fluid">
	<div class="row content">
		<div class="col-sm-3 sidenav">
		<?php
		include_once 'sidenav.php';
		?>
	</div>
	
	<div class="col-sm-9">
		<?php
		include_once 'content.php';
		?>
	</div>
</div>
</div>

<?php
include_once 'footer.php';
?>

</body>
</html>