<?php


class IndexController
{
    public function actionIndex()
    {
//        // reading
//        $deck = Deck::findOne(1);
//        var_dump($deck->name);
//
//        // reading multiple
//        $allDecks = Deck::findAll();
//        foreach ($allDecks as $oneDeck) {
//            var_dump($oneDeck->name);
//        }

//        // writing
//        $deck = Deck::findOne(1);
//        $deck->color = 'new color' . mt_rand();
//        $deck->description = 'descr' . mt_rand();
//        $deck->amount = "1"
//        $saved = $deck->save();

        //delete
        $deck = Deck::findOne(1);
        $deck->delete();
//
        // creating
//        $deck = new Deck();
//        $deck->name = 'new deck ' . mt_rand();
//        $deck->availability = 1;
//        $created = $deck->save();


        return __CLASS__ . '/' . __METHOD__;
    }

    public function actionRequisite()
    {
        $requisite = Requisite::findOne(1);
        if ($requisite === null) {
            echo 'Значение не найдено в базе';
            die();
        }

        return $requisite->name;
    }
}
