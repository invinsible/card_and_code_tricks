<?php


class IndexController
{
    public function actionIndex()
    {
        // reading
        $deck = Deck::findOne(1);        
        var_dump($deck->name);

        // reading multiple
        $allDecks = Deck::findAll();
        foreach ($allDecks as $oneDeck) {
            var_dump($oneDeck->name);
        }

//        // writing
//        $deck->description = 'new description';
//        $saved = $deck->save(); // true || false
//        var_dump($saved);
//
//        // creating
//        $deck = new Deck();
//        $deck->name = 'new deck';
//        $deck->availability = 1;
//        $created = $deck->save();
//        var_dump($created);

        return __CLASS__ . '/' . __METHOD__;
    }
}
