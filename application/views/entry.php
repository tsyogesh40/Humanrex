<!DOCTYPE html>
<html lang="en">
<head>
  <title>Entry Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Attendence entry</h2>

  <table class="table table-striped">
    <thead class="table-primary">
      <tr>
        <th>Name</th>
        <th>Staff ID</th>
        <th>cadre</th>
        <th>Department</th>
        <th>IN_TIME</th>
        <th>OUT_TIME</th>
        <th>Status</th>
        <th>Date</th>
        <th>Semester</th>
      </tr>
    </thead>

    <tbody>
    <?php
      foreach($this->d->fetch_temp_entry() as $row)
      {
       echo "
       <tr>
         <td>$row->name</td>
         <td>$row->staff_id</td>
         <td>$row->cadre</td>
         <td>$row->dept</td>
         <td>$row->in_time</td>
         <td>$row->out_time</td>
         <td>$row->status</td>
         <td>$row->date</td>
         <td>$row->semester</td>
       </tr>
       ";
      }
       ?>
      </tbody>
  </table>
</div>

</body>
</html>
