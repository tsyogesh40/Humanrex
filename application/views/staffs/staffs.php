<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Staff's Panel | HumanRex</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/staffs/staffs.css" rel="stylesheet">
    <script src="<?=base_url()?>assets/jquery-1.11.1.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">
                    <!-- <h2>Welcome to Humanrex!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li class="active">
                     <a href="#home" data-toggle="tab" title="welcome">
                      <span class="round-tabs one">
                              <i class="glyphicon glyphicon-home"></i>
                      </span>
                  </a></li>

                  <li><a href="#profile" data-toggle="tab" title="profile">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                     </span>
           </a>
                 </li>
                 <li><a href="#messages" data-toggle="tab" title="History">
                     <span class="round-tabs three">
                          <i class="glyphicon glyphicon-gift"></i>
                     </span> </a>
                     </li>

                     <li><a href="#settings" data-toggle="tab" title="Nofifications ">
                         <span class="round-tabs four">
                              <i class="glyphicon glyphicon-comment"></i>
                         </span>
                     </a></li>

                     <li><a href="#doner" data-toggle="tab" title="logout">
                         <span class="round-tabs five">
                              <i class="glyphicon glyphicon-ok"></i>
                         </span> </a>
                     </li>

                     </ul></div>

                     <div class="tab-content">
                      <div class="tab-pane fade in active" id="home">
                          <h3 class="head text-center">Welcome, <?php echo $this->session->userdata('name'); ?><sup>™</sup> <span style="color:#f48260;">♥</span></h3>
                          <h4 class="narrow text-center">
                            Your Entry on <?php echo $date;?> is at,
                          </h4>
                      <div class="table-responsive">
                          <table class="table text-center table-bordered table-striped table-dark">
                            <tbody>
                              <?php
                              if($status=="ONTIME")
                              {
                              echo'  <tr class="success">
                                  <td><b>Status :</b></td>
                                  <td>'.$status.'</td>
                                </tr>';
                              }
                              else {
                              echo' <tr class="danger">
                                  <td><b>Status :</b></td>
                                  <td>'.$status.'</td>
                                </tr>
                                <tr>';
                              }
                              ?>

                                <td><b>Intime :</b></td>
                                <td><?php echo $in_time ?></td>
                              </tr>
                              <tr>
                                <td><b>Outtime:</b></td>
                                <td><?php echo $out_time ?></td>
                              </tr>
                              <tr>
                                <td><b>Last Login:</b></td>
                                <td><?php echo $this->session->userdata('last_login'); ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                  <p class="text-center">

                    <a  href="#messages" data-toggle="tab" title="Nofifications" class="btn btn-success btn-outline-rounded green"> View History <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                </p>
                      </div>
                      <div class="tab-pane fade" id="profile">
                          <h3 class="head text-center">User<sup>™</sup> Profile</h3>
                          <p class="narrow text-center">

                          <?php echo $this->session->userdata('name');?>

                          <div class="table-responsive table-md">
                              <table class="table text-center table-bordered table-striped">
                                <tbody>
                                  <tr>
                                    <td><strong>Staff ID<strong></td>
                                    <td><?php echo $staff_id ?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Designation:</strong></td>
                                    <td><?php echo $designation?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Phone Number:</strong></td>
                                    <td><?php echo $phone?></td>
                                  </tr>
                                  <tr>
                                    <td><strong>Email ID:</strong></td>
                                    <td><?php echo $email?></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                          </p>

                          <p class="text-center">
                    <!--<a href="#" class="btn btn-success btn-outline-rounded green"> Home <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>-->
                    <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#edit_modal">Edit Your Profile</button>
    <!-- Modal -->
        <div class="modal fade" id="edit_modal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close btn-md" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile</h4>
              </div>
              <div class="modal-body">
                <div class="container board">
                  <form action="<?=base_url()?>user/update_details" method="post">
                    <div class="form-group">
                      <label for="phone">Phone Number:</label>
                      <input type="number" class="form-control" id="phone" value="<?php echo $phone;?>" placeholder="New PhoneNumber" name="phone">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Password:</label>
                      <input type="password" class="form-control" id="pwd" placeholder="New password" name="pwd">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Confirm Password:</label>
                      <input type="password" class="form-control" id="cn_pwd" placeholder="confirm password" name="cn_pwd">
                      <span id='message'></span>

                    </div>
                    <button type="submit" id="submit" class="btn btn-default">Submit</button>
                  </form>
                  <script>
                  $('#pwd, #cn_pwd').on('keyup', function ()
                   {
                    if ($('#pwd').val() == $('#cn_pwd').val())
                     {
                      $('#message').html('Matching').css('color', 'green');
                      //document.getElementById('submit').disabled = false;
                      $('#submit').prop('disabled', false);

                      }
                      else
                      {
                      $('#message').html('Not Matching').css('color', 'red');
                      $('#submit').prop('disabled', true);
                      }
                    });
                  </script>
                </div>
              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

            </p>

                      </div>
                      <div class="tab-pane fade" id="messages">
                          <h3 class="head text-center">view Your History </h3>
                          <br>

                            <form class="form-inline text-center" action="<?=base_url()?>user/select_by_id" target="_blank" method="post">
                              <div class="form-group">
                                  <label for="date">Select Date:&nbsp;</label>
                                  <input type="date" class="form-control" id="date" name="date">
                                </div>
                                  <button type="submit" class="btn btn-primary">select</button>
                                </form><br>
                                <h4 class="narrow text-center">------------------(or)------------------<br>   </h4>
                                <br><p class="narrow text-center"><b>Select by range of dates<br>   </b></p>
                                <form class="form-inline text-center"  target="_blank" method="post" action="<?=base_url()?>user/select_by_range">
                                  <div class="form-group">
                                      <label for="date">From:&nbsp;</label>
                                      <input type="date" class="form-control" id="date1" name="from_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">To:&nbsp;</label>
                                        <input type="date" class="form-control" id="date2" name="to_date">
                                    </div>
                                      <button type="submit" class="btn btn-primary">select</button>
                                    </form>
                          <br><p class="text-center">

                          </p>

                      </div>
                      <div class="tab-pane fade" id="settings">
                          <h3 class="head text-center">Your Activity!</h3>
                          <p class="narrow text-center">
                            <?php
                            //log message
                                $msg= $this->session->flashdata('notify');
                                    if($msg){
                                      ?>
                                      <div class="alert alert-success">
                                        <?php echo $msg; ?>
                                      </div>
                                    <?php
                                  }?>

                          </p>

                          <p class="text-center">
                  <!--  <a href="" class="btn btn-success btn-outline-rounded green"> View History <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>-->
                </p>
                      </div>
                      <div class="tab-pane fade" id="doner">
  <div class="text-center">
    <i class="img-intro icon-checkmark-circle"></i>
</div>
<h3 class="head text-center">Thanks for staying tuned! <span style="color:#f48260;">♥</span>HumanRex</h3>
<p class="narrow text-center">
  <a  href="<?=base_url()?>user/logout"  title="Click to Logout" class="btn btn-danger btn-oHputline-rounded green"> LOGOUT <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
</p>
</div>
<div class="clearfix"></div>
</div>

</div>
</div>
</div>
</section>

<script type="text/javascript">
$(function(){
$('a[title]').tooltip();
});

</script>
</body
