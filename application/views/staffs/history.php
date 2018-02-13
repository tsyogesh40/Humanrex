<html>
<head>
      <meta charset="utf-8">
      <title>Staff's Panel | HumanRex</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="<?=base_url()?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>assets/staffs/staffs.css" rel="stylesheet">
      <script src="<?=base_url()?>assets/jquery-1.11.1.min.js"></script>
      <script src="<?=base_url()?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>

  </head>
<body>
  <?php

  echo'
  <div class="container">
      <table class="table table-striped table-responsive">
          <thead>
            <tr>
              <th>DATE</th>
              <th>IN_TIME</th>
              <th>OUT_TIME</th>
              <th>STATUS</th>
              <th>ATTENDENCE</th>
            </tr>
          </thead>
          <tbody>';
          foreach($history as $value)
          {
            $val=$value->p_value;
            if($val==1)
              $str="Half day present";
            else if($val==2)
              $str="Full day present";
            echo'      <tr>
              <td>'.$value->date.'</td>
              <td>'.$value->in_time.'</td>
              <td>'.$value->out_time.'</td>
              <td>'.$value->status.'</td>
              <td>'.$str.'</td>
              </tr>';
            }
            echo'        </tbody>
            </table>
            </div>';


  ?>

</body>

</html>
