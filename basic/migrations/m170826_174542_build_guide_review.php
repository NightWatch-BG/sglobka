<?php

use yii\db\Migration;

class m170826_174542_build_guide_review extends Migration
{
    public function safeUp()
    {
	$connection = Yii::$app->getDb();
	$command = $connection->createCommand("
	    CREATE TABLE IF NOT EXISTS `sglobka`.`guide_review` (
		`guide_review_id` INT NOT NULL AUTO_INCREMENT,
		`user_fk` INT NOT NULL,
		`guide_fk` INT NOT NULL,
		`review` VARCHAR(5000) NULL,
		`rating` INT NOT NULL,
		PRIMARY KEY (`guide_review_id`),
		INDEX `guide_review_user_idx` (`user_fk` ASC),
		INDEX `guide_review_build_idx` (`guide_fk` ASC),
		CONSTRAINT `guide_review_user`
		    FOREIGN KEY (`user_fk`)
		    REFERENCES `sglobka`.`user` (`user_id`)
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		CONSTRAINT `guide_review_build`
		    FOREIGN KEY (`guide_fk`)
		    REFERENCES `sglobka`.`build_guide` (`build_guide_id`)
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
	    ENGINE = InnoDB");

	$result = $command->queryAll();
    }

    public function safeDown()
    {
	$this->dropTable('guide_reviwew');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170826_174542_build_guide_review cannot be reverted.\n";

        return false;
    }
    */
}
