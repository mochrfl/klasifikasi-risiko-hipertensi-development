<?php

  $result = ("SELECT * FROM tb_data_training where risiko_hipertensi == 1");
  $num_rows = mysqli_num_rows($result);

  echo "$num_rows Rows\n";

?>
