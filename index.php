<?php
require_once "database/database.php";
require_once "api/Category.php";
$url=explode("/",$_SERVER['QUERY_STRING']);
header('Access-Control-Allow-Origin: application/json');
header('Content-Type: application/json');
if($url[1]=='v1'){
    if($url[2]=='category'){
        $category=new Category();
        if($url[3]=='all'){
            $data=$category->all();
            $result=[
                'status'=>200,
                'data'=>$data
            ];
            echo json_encode($result);


        }else if($url[3]=='add'){
            header("Access-Control-Allow-Methods: POST");//to have the method type in the header
            $data=file_get_contents("php://input");
            $data_decoded=json_decode($data,True);
            $added=$category->add($data_decoded);
            if ($added){
                http_response_code(201);
                $result=[
                    'status'=>201,
                    'massage'=>'category created'
                ];
            }else{
                http_response_code(400);
                $result=[
                    'status'=>400,
                    'massage'=>'error'
                ];
            }
            echo json_encode($result);
        }else if($url[3]=='update'){
            header("Access-Control-Allow-Methods: PUT");//to have the method type in the header
            $data=file_get_contents("php://input");
            $data_decoded=json_decode($data,True);
            //var_dump($data_decoded);die;
            $id=['id'=>$data_decoded['id']];
            $data=$data_decoded['category'];
            $added=$category->update($data,$id);
            if ($added){
                http_response_code(201);
                $result=[
                    'status'=>201,
                    'massage'=>'category updated'
                ];
            }else{
                http_response_code(400);
                $result=[
                    'status'=>400,
                    'massage'=>'error'
                ];
            }
            echo json_encode($result);
        }else if($url[3]=='delete'){
            header("Access-Control-Allow-Methods: PUT");//to have the method type in the header
            $data=file_get_contents("php://input");
            $data_decoded=json_decode($data,True);
            //var_dump($data_decoded);die;
            $id=['id'=>$data_decoded['id']];
            $added=$category->delete($id);
            if ($added){
                http_response_code(201);
                $result=[
                    'status'=>201,
                    'massage'=>'category deleted'
                ];
            }else{
                http_response_code(400);
                $result=[
                    'status'=>400,
                    'massage'=>'error'
                ];
            }
            echo json_encode($result);

        }

    }
    if($url[2]=='user'){
        if($url[3]=='all'){

        }else if($url[3]=='add'){

        }else if($url[3]=='update'){

        }else if($url[3]=='delete'){

        }
    }
}