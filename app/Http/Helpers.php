<?php
    if(!function_exists('success'))
    {
        function result($status = null , $message = null , $data = null)
        {
                if($status == 200){
                    $message = "success request";
                }
                else{
                    if(empty($message)){
                        $message = "Failed request";
                    }
                    else{
                        $message = $message;
                    }

                }
                $resJson = array(
                    'status' => $status,
                    'message' => $message
                );

                if($data== null){
                    print_r(json_encode($resJson));
                }
                else{
                    $resJson['data']=$data;
                    print_r(json_encode($resJson));
                }



        }

        function trueresult($status = null ,$message = null, $data = null)
        {

                $result = array(
                    'status' => $status,
                    'message' => $message,
                    'data' =>$data
                );

                print_r(json_encode($result));

        }
        function falseResult($status = null , $message = null){

            $result = array(
                'status' => $status,
                'message' => $message
            );
            print_r(json_encode($result));
        }
    }
