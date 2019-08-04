<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My assets</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Webslesson Demo - PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        
        <link rel="stylesheet" href="css/style.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>

   .box
   {
    width:95%;
    padding:10px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>
 </head>
 <body>
 <?php include('includes/profileHeader.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
  <div class="container box">
   <h1 align="center">PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</h1>
   <br />
   <div class="table-responsive">
    <br />
    <div align="right">
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add Vehicles</button>
    </div>
    <br /><br />
    <div id="image_data">
   </div>
  </div>

        </div>
	</div>
 </body>
</html>

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h2>vehicle posting page</h2>
    </div>
    <div class="modal-body">
    <div class="row">
					<div class="col-md-12">
						
                        <h2 class="page-title">Post A Vehicle</h2>
                        <div id="success"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									

									<div class="panel-body">
										<form method="post"  class="form-horizontal" enctype="multipart/form-data">
                                        <div class="row"> 
                                        <div class="form-group">
												<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="vehicletitle" id="vehicletitle" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Vehicle Brand<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="vehiclebrand" id="vehiclebrand" class="form-control" required>
												</div>
                                            </div>
                                            </div>   
                                            
                                            <div class="row">
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Vehical Overview<span style="color:red">*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" name="vehicalorcview" id="vehicleoverview"rows="3" title="basic overview of the scooter" required></textarea>
												</div>
                                            </div>
                                            </div>
                                            
                                            <div class="row">
                                            <div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
												<div class="col-sm-6">
													<input type="number" name="priceperday" class="form-control" id="priceperday" pattern="[0-9]" title="price must be numbers" required>
                                                </div>
                                                </div>
                                                </div>
                                                
                                                <div class="row">
                                                <div class="hr-dashed"></div>
                                                <div class="form-group">
												<label class="col-sm-6 control-label">Select Fuel Type<span style="color:red">*</span></label>
												<div class="col-sm-6">
													<select class="selectpicker" name="fueltype" id="fueltype" required>
														<option value=""> Select Fuel Type </option>

														<option value="Petrol">Petrol</option>
														<option value="Diesel">Diesel</option>
														<option value="CNG">CNG</option>
													</select>
                                                </div>
                                                </div>
                                                </div>
											

                                            <div class="row">
                                            <div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-6 control-label">Model Year<span style="color:red">*</span></label>
												<div class="col-sm-6">
													<input type="number" name="modelyear" class="form-control" id="modelyear"  title="year must be numbers" required>
												</div>
                                            </div>
                                            </div>
											<div class="hr-dashed"></div>


											<div class="form-group">
												<div class="col-sm-12">
													<h4><b>Upload Images</b></h4>
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-6">
                                                    Image 1 <span style="color:red">*</span><input type="file" name="img1" id="user_image1" required>
                                                   
                                                   
												</div>
												<div class="col-sm-6">
                                                    Image 2<span style="color:red">*</span><input type="file" name="img2" id="user_image2" required >
                                                    
												</div>
												<div class="col-sm-6">
                                                    Image 3<span style="color:red">*</span><input type="file" name="img3" id="user_image3" >
                                                   
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-4">
                                                    Image 4<span style="color:red">*</span><input type="file" name="img4" id="user_image4">
                                                    
												</div>
												<div class="col-sm-4">
                                                    Image 5<input type="file" name="img5" id="user_image5">
                                                    
												</div>

											</div>
											<div class="hr-dashed"></div>									
										</div>
									</div>
								</div>
							</div>
							

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Accessories</div>
										<div class="panel-body">


											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="antilockbrakingsys" name="check" value="1">
														<label for="antilockbrakingsys"> AntiLock Braking System </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="brakeassist" name="check" value="1">
														<label for="brakeassist"> Brake Assist </label>
													</div>
												</div>

												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="leatherseats" name="check" value="1">
														<label for="leatherseats"> Leather Seats </label>
													</div>
												</div>
											</div>




											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
                                                    <input type="submit" name="insert"  id="insert" onclick="addScooterToDatabase()" value="Save Changes" class="btn btn-info" />
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
						

					</div>
				</div>
				
				

			</div>
     
    </div>
   </div>
  </form>
 </div>
</div>


<script type="text/javascript" language="javascript" src="js/showScooters.js" ></script>

<script type="text/javascript" language="javascript" >


 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var vehicletitle = $('#vehicletitle').val();
  var vehiclebrand = $('#vehiclebrand').val();
  var vehicalorcview = $('#vehicleoverview').val();
  var priceperday = $('#priceperday').val();
  var fueltype = $('#fueltype').val();
  var modelyear = $('#modelyear').val();
  var img1 = $('#user_image1').val().split('.').pop().toLowerCase();
  var img2= $('#user_image2').val().split('.').pop().toLowerCase();
  var img3 =$('#user_image3').val().split('.').pop().toLowerCase();
  var img4 = $('#user_image4').val().split('.').pop().toLowerCase();
  var img5 = $('#user_image5').val().split('.').pop().toLowerCase();
  
  var antilockbrakingsys = checkBoxValues[0];
  var brakeassist = checkBoxValues[1];
  var leatherseats = checkBoxValues[2];


   if(jQuery.inArray(img1, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File1");
    $('#user_image1').val('');
    return false;
   }

   if(jQuery.inArray(img2, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File2");
    $('#user_image2').val('');
    return false;
   }

    if(jQuery.inArray(img3, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File3");
    $('#user_image3').val('');
    return false;
   }
   
   if(jQuery.inArray(img4, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File4");
    $('#user_image4').val('');
    return false;
   }
   if(jQuery.inArray(img5, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File5");
    $('#user_image5').val('');
    return false;
   }
  
   $.ajax({ 
    url:"insertVehicle.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
    }
   });
  
  
 });
 
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#first_name').val(data.first_name);
    $('#last_name').val(data.last_name);
    $('.modal-title').text("Edit User");
    $('#user_id').val(user_id);
    $('#user_uploaded_image').html(data.user_image);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
 });
 
 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
     alert(data);
     
    }
   });
  }
  else
  {
   return false; 
  }
 });
 
 

</script>
   