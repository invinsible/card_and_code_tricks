<?php


class TricksController{


    public function actionCreate()
    {
       $arr = json_decode(file_get_contents('php://input'), true);     
       
       $trick = new Trick();
       $trick->name = $arr["name"];
       $trick->preparation = (int)$arr["preparation"];
       $trick->difficult = $arr["difficult"];
       $trick->steps = $arr["steps"];
       $trick->video_link = $arr["video_link"];
       $trick->video_author = $arr["video_author"];
       $trick->views = (int)$arr["views"];
       $trick->comment = $arr["comment"];

       if (!$trick->validate()) {        
        return ["result" => false];
       }

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

    public function actionGetOne()    { 
        
        $trick = $this->find((int)$_GET["id"]);

        if (is_array($trick)) {
            return $trick;
        }

        $data = [
            "id"=>$trick->id,
            "name"=>$trick->name,
            "preparation"=>$trick->preparation
        ];

        return $data;
        
    }

    public function actionDelete()
    {                 
        $trick = $this->find((int)$_GET["id"]);

        if (is_array($trick)) {
            return $trick;
        }

        $trick->delete();
        
        return ["result" => true];
    }


    private function find(int $id)
    {
        $trick = Trick::findOne($id); 
        if ($trick === null) {
            return [
                "result"=>false,
                "error"=>"No ID in database"
            ];
        }

        return $trick;
    }

    


}
