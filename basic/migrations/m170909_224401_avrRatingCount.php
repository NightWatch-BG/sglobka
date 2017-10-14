<?php

use yii\db\Migration;

class m170909_224401_avrRatingCount extends Migration
{
    public function safeUp()
    {
	$connection = Yii::$app->getDb();
	$command = $connection->createCommand("
	    ALTER TABLE `sglobka`.`build_guide`
	    ADD avr_rating DECIMAL(3,1),
	    ADD ratings_count INT
	    ;");

	$result = $command->queryAll();
    }

    public function safeDown()
    {
	$connection = Yii::$app->getDb();
	$command = $connection->createCommand("
	    ALTER TABLE `sglobka`.`build_guide`
	    DROP COLUMN avr_rating,
	    DROP COLUMN ratings_count
	    ;");

	$result = $command->queryAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170909_224401_avrRatingCount cannot be reverted.\n";

        return false;
    }
    */
}
