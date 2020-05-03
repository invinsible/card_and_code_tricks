<?php


class TricksController{


    public function actionCreate()
    {
       $arr = json_decode(file_get_contents('php://input'), true);     
       
       $trick = new Trick();
       $trick->name = $arr["name"];
       $trick->preparation = (int)$arr["preparation"];
       $created = $trick->save();

       return ["result" => true];
    }

    public function actionGetList()
    {   
        $data = [];       

        $allTricks = Trick::findAll();
        foreach ($allTricks as $oneTrick) {
            $data[] = [
                "id" => $oneTrick->id,
                "name" => $oneTrick->name,
                "preparation" => $oneTrick->preparation
            ];
        }

        return ["data"=>$data];
        
    }

    public function actionGetOne()
    { 
        $id = (int)$_GET["id"];
        $trick = Trick::findOne($id);
        
        if ($trick === null) {
            return [
                "result"=>false,
                "error"=>"No ID in database"
            ];
        }

        $data = [
            "id"=>$trick->id,
            "name"=>$trick->name,
            "preparation"=>$trick->preparation
        ];

        return $data;
        
    }


}
