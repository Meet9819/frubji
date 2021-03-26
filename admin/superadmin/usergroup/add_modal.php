<!-- Add New -->
<div class="modal fade bs-example-modal-lg" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Add New User Group</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                  


                          <form id="example-advanced-form" action="usergroup/addnew.php" method="post" enctype="multipart/form-data" >
                 

                                      


                                                        <div class="form-group col-md-12">
                                                                    <label for="inputName" class="control-label mb-10">Create User Group</label>
                                                                    <input type="text" name="role_rolecode" class="form-control" id="inputName" placeholder="Enter Role" required>
                                                                </div> 

  <div class="form-group col-md-12  text-right">  
                              <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary" />
                            </div>   

                                                        


                  </form>


                                                        

                        </div>
                  
                    </div>
                </div>
            </div>
        </div>