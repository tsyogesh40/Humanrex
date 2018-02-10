<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <div class="container">
        <h1>New User Registration</h1>
  <p>Please Fillout this form to Enroll!</p>

    </div>
</div>

<div class="container">
    <form action="<?=base_url()?>user/register" method="POST">
        <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" placeholder="Enter Your name" name="name">
        </div>

      <div class="form-group">
            <label for="usrid">Staff ID:</label>
            <input type="text" class="form-control" id="usrid" placeholder="Enter Staff ID" name="staff_id">
        </div>

        <div class="form-group">
              <label for="usrid">Store ID:</label>
              <input type="text" class="form-control" id="store_id" placeholder="Enter Sensor Store ID" name="store_id">
          </div>
          <div class="form-group">
              <label for="finger">Finger Preference :</label>
                    <select class="form-control" name="finger_pref">
                          <option value="LI">LEFT_INDEX</option>
                          <option value="RI">RIGHT_INDEX</option>
                          <option value="LT">LEFT_THUMB</option>
                          <option value="RT">RIGHT_THUMB</option>
                          <option value="LM">LEFT_MID</option>
                          <option value="RM">RIGHT_MID</option>
                    </select>
          </div>

        <div class="form-group">
            <label for="dept">Select Department :</label>
                  <select class="form-control" name="dept">
                        <option value="IT">IT</option>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                        <option value="MECH">MECH</option>
                        <option value="CIVIL">CIVIL</option>
                  </select>
        </div>

          <div class="form-group">
            <label for="desg">Designation:</label>
            <input type="text" class="form-control" id="desg" placeholder="Enter Staff Designation" name="designation">
            </div>

        <div class="form-group">
            <label for="dept">Select Cadre :</label>
                  <select class="form-control" name="cadre">
                        <option value="T">Teaching</option>
                        <option value="NT">Non-Teaching</option>
                  </select>
        </div>

        <div class="form-group">
            <label for="gender">Select Gender :</label>
                  <select class="form-control" name="gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                  </select>
        </div>

          <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="number" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
            </div>

            <div class="form-group">
                  <label for="phone">Email ID:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email ID" name="email">
              </div>

              <div class="form-group">
                    <label for="doj">Date Of Joining:</label>
                    <input type="date" class="form-control" placeholder="DOJ" id="doj" name="doj">
                </div>

    <!--    <label for="finger">Select Finger :</label>
        <div class="row">
            <div class="col-lg-3">
                 <div class="form-group">

                                  <select class="form-control" id="finger">
                                        <option value="rightthumb">Right Thumb</option>
                                        <option value="leftthumb">Left Thumb</option>
                                        <option value="leftmidfinger">Left MidFinger</option>
                                        <option value="rightmidfinger">Right MidFinger</option>
                                        <option value="leftindexfinger">Left IndexFinger </option>
                                        <option value="rightindexfinger">Right IndexFinger</option>
                                  </select>
                 </div>
            </div>
                <div class="col-lg-2">
                  <div class="form-group">
                       <button type="button" class="btn btn-primary">Fetch FingerPrint</button>
                  </div>
                </div>
                  <div class="col-lg-2">
                        <div class="form-group">
                        <button type="button" class="btn btn-warning">Save FingerPrint</button>
                  </div>
                  </div>

        </div>  -->

        <br><br>
        <div class="form-group">
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>


    </form>
</div>
</body>
</html>
