<?

include('ini.php'); 


?>

	<!-- =====================  About User  =====================  -->

<section  class="section-spacing single">
	
  <div class="back_layer">
	  
	 <div class="container-fluid p-3 ">
			
        <h2 class="text-center title  p-4">Create New List</h2>
		 
		<div id="create_list">
				
			<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" style="margin: 20px auto;">
             <tbody>
						
					<tr>
                      <td width="55">&nbsp;</td>
                      <td width="55" align="center"><img class="mb-2" src="layout/img/marker.png" width="15" ></td>
                      <td width="55" align="center"></td>
                      <td width="55" align="center"></td>
                    </tr>
						
                    <tr>
                      <td width="55" height="13" class="font-weight-bold text-white">Step : </td>
                      <td width="55" height="13" align="center" bgcolor="#f3e095" class=""> 
						  <u>1</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1">
						  <u>2</u>
					  </td>
                      <td width="55" height="13" align="center" bgcolor="#EEF5F9" class="f1"> 
						  <u>3</u>
					  </td>
                    </tr>
						
			  </tbody>
			</table>
			
			
       		<div class="container" style="justify-content: center; display: flex;">
			
          <form class="col-md-10 list_form" style="padding: 20px;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 0 5px 1px rgba(255, 255, 255, 0.5);background:#fff;">
			  

			 <!--======= List Name ========-->  

					<div class="form-row form-group"> 

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputName">Name</label>
							  <input pattern=".{3,32}" title="Name Must Be Between 3:32 Chars" type="text" class="form-control text-dark" id="inputName" name="list_name" required>
							</div>
						</div>
						
						
			 <!--======= List Description ========-->  

						<div class="col-md-10 mx-auto mb-2" style="border-bottom: 1px solid #555;">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputDesc">Description</label>
								<textarea class="form-control text-dark" id="inputDesc" name="desc"></textarea>
							</div>
						</div>
						
						
			 <!--======= Public List ========-->  

						<div class="col-md-10 mx-auto mb-2">
							<div class="form-group">
							  <label class="font-weight-bold" for="inputState">Public List</label>		 
							  <select id="inputState" class="form-control text-dark" name="public">
								<option selected>Yes</option>
								<option>No</option>
							  </select>
							</div>
						</div>
				

					</div>
			  
			  <input type="hidden" name="user_id" value="<?=$user_id ?>">
			  
			  <div class="modal-footer">
				<button type="submit" class="btn-filter">Next</button>
			  </div>
				
		    </form>
				
	  	</div>
			
			
		</div>
		 
	  </div>
	  
   </div>
	
</section>
	


<?

 include('include/footer.php'); ?>





