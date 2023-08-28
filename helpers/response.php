<?php

function setStatusCode($statusCode)
{
  return http_response_code($statusCode ?? 200);
}


function response(
  $status,
  $result
) {
  if ($status == 'success') {
    $statusCode = 200;
    setStatusCode($statusCode);
    $response      = [
      'status_code' => $statusCode,
      'status'      => $status,
      'timestamp'   => date("Y-m-d H:i:s"),
      'result'      => $result
    ];
    return json_encode($response);
  }

  $statusCode = 400;
  setStatusCode($statusCode);

  $response      = [
    'status_code'   => $statusCode,
    'status'        => 'error',
    'timestamp'     => date("Y-m-d H:i:s"),
    'error_message' => $result
  ];
  return json_encode($response);
}
