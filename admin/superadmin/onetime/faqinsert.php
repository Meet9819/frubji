<?php
include "../levelscrud/db.php";
include('faqfunction.php');
if(isset($_POST["operation"]))
{



	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO faq (question,answer) 
			VALUES (:question,:answer)
		");
		$result = $statement->execute(
			array(
				':question'	=>	$_POST["question"],

				':answer'	=>	$_POST["answer"],

			

		
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}







	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE faq 
			SET question = :question , answer =:answer
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':question' =>	$_POST["question"],
				
				':answer' =>	$_POST["answer"],	
				
				':id' =>	$_POST["id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}




	
}

?>