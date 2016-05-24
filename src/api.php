<?php
   $_POST = json_decode(file_get_contents('php://input'), true);

   function post($url, $data)
   {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         // 4262469664 带描述
         // 4262469668 没有描述，有中文类别
         'tunnel-command: 4262469668',
         'Referer: ' . $url,
      ));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($ch);
      curl_close($ch);

      return $data;
   }

   $json = array(
        'dcType'   => 0,
        'keyword'  => $_POST['keyword'],
        'clFlag'   => 1,
        'perCount' => 15,
        'page'     => $_POST['page']
   );
   $data = post('http://jsondata.25pp.com/index.html?tunnel-command=4262469668', json_encode ($json));
   echo $data;
?>
