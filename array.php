<?php

  $test = array(
      ['Житомир',  'Киевская 6'  , 1],
      ['Киев',     'Волынская 8' , 2],
      ['Киев',     'Зелёная 15'  , 3],
      ['Житомир',  'Красная 6'   , 4],
      ['Коростень',  'Синяя 6'     , 5],
      ['Житомир',  'Коричневая 6', 6],
  );

  $city = array();
  $address = array();

  for($i=0; $i < count($test); $i++)
  {
      $city[$i] = $test[$i][0];
  }

  $unique = array_unique($city);

    for($i = 0; $i < count($unique); $i++)
    {
        echo '<h3>' . $unique[$i] . '</h3>';
       
        for ($j=0; $j < count($test); $j++) {

            if($test[$j][0] == $unique[$i])
            {
                echo  $test[$j][1] . '<br>';
            }

        }

    }

?>