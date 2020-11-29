<?php
	class lecturerModel 
	{
		public function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db; 
		}
		//Connect to database
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
    			die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		//Close connection
		public function close_db()
		{
			$this->condb->close();
		}

		//Select all past papers
		public function get_pastpapers()
		{
			try
			{
				$this->open_db();
				$result_paper=array();
				$query="SELECT past_paper.paper_id,
						 past_paper.subject_code, 
						 past_paper.year, 
						 subject.semester, 
						 subject.subject_name, 
						 past_paper.part 
						 FROM past_paper INNER JOIN subject 
						 ON past_paper.subject_code=subject.subject_code";
				$result = mysqli_query($this->condb,$query);
				while ($row_ah = mysqli_fetch_assoc($result)) {
                    array_push($result_paper, $row_ah);
                }
				return $result_paper;
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
		}
		
		//upload answer scripts
		public function uploadscript($target_file,$paperid)
		{
			try
			{
				$this->open_db();
				$query = "INSERT INTO answer_script (answer_script,paper_id) VALUES ('$target_file', '$paperid')";
				$result = mysqli_query($this->condb,$query);
				return $result;
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
		}

		//get interest list subject names
        function getInterestList($user){
            try
            {
                $this->open_db();
                $subjects = null;
                $selectQuery = 'SELECT * FROM 
                interest_list INNER JOIN subject 
                ON interest_list.subject_code = subject.subject_code 
                WHERE interest_list.user_id = "'.$user.'"';
                $subjects = mysqli_query($this->condb,$selectQuery);
                return $subjects;
                $this->close_db();
            }
            catch (Exception $e)
            {
                $this->close_db();
				throw $e;
            }
        }

        //get subjects that are not present in interest list
        function getSubjects($userId)
        {
            try
            {
                $this->open_db();
                $subjects=array();
                $query = "SELECT * FROM subject WHERE subject_code NOT IN (SELECT subject_code FROM interest_list WHERE user_id = '".$userId."')";
                $results = mysqli_query($this->condb,$query);
                while ($row_ah = mysqli_fetch_assoc($results)) {
                    array_push($subjects, $row_ah);
                }
                return $subjects;
                $tihs->closedb();
            }
            catch (Exception $e)
            {
                $this->close_db();
				throw $e;
            }
        }

        //
		function getLessons(){
            try
			{
                $this->open_db();
				$query="SELECT lesson.tag, subject.subject_code, subject.subject_name FROM lesson INNER JOIN subject ON lesson.subject_code=subject.subject_code";
				$result = mysqli_query($this->condb,$query);
				return $result;
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
        }

        //update interest list
        function updateSubjects($userId,$subjects){
            try
			{
                $this->open_db();
                foreach($subjects as $subject){
                    echo $subject.'\n';
                    $query="INSERT INTO interest_list (user_id,subject_code) VALUES ('".$userId."','".$subject."')";
                    $result = mysqli_query($this->condb,$query);
                }
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
        }

        function get_paperpath($paperid){
            try
            {
                $this->open_db();
                $query="SELECT past_paper FROM past_paper WHERE paper_id = $paperid";
                $result = mysqli_query($this->condb,$query);
                $row = mysqli_fetch_assoc($result);
                return $row['past_paper'];
                $this->close_db();
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }
        
        function get_answerpath($paperid){
        try
        {
            $this->open_db();
            $query="SELECT answer_script FROM answer_script WHERE paper_id = $paperid";
            $result = mysqli_query($this->condb,$query);
            $row = mysqli_fetch_assoc($result);
            return $row['answer_script'];
            $this->close_db();
        }
        catch (Exception $e)
        {
            $this->close_db();
            throw $e;
        }
        }

	}
?>