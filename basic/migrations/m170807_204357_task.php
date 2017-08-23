<?php

use yii\db\Migration;

class m170807_204357_task extends Migration
{
    public function up()
    {
	$connection = Yii::$app->getDb();
	$command = $connection->createCommand("
	    CREATE TABLE IF NOT EXISTS `sglobka`.`task` (
	      `task_id` INT NOT NULL AUTO_INCREMENT,
	      `title` VARCHAR(45) NOT NULL,
	      `description` VARCHAR(5000) NULL,
	      `status_fk` INT NOT NULL,
	      `due_date` DATE NULL,
	      `assigned_from` INT NULL,
	      `assigned_to` INT NULL,
	      `last_update` TIMESTAMP NOT NULL,
	      PRIMARY KEY (`task_id`),
	      INDEX `user_assignet_from_idx` (`assigned_from` ASC),
	      INDEX `user_assigned_to_idx` (`assigned_to` ASC),
	      INDEX `task_status_idx` (`status_fk` ASC),
	      CONSTRAINT `user_assignet_from`
		FOREIGN KEY (`assigned_from`)
		REFERENCES `sglobka`.`user` (`user_id`)
		ON DELETE SET NULL
		ON UPDATE NO ACTION,
	      CONSTRAINT `user_assigned_to`
		FOREIGN KEY (`assigned_to`)
		REFERENCES `sglobka`.`user` (`user_id`)
		ON DELETE SET NULL
		ON UPDATE NO ACTION,
	      CONSTRAINT `task_status`
		FOREIGN KEY (`status_fk`)
		REFERENCES `sglobka`.`status` (`status_id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION)
	    ENGINE = InnoDB");

	$result = $command->queryAll();
    }

    public function down()
    {
        echo "m170807_204357_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
