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
		
		public function create_discussion($question,$target_file,$extags,$anonymous,$paperID,$subject_code,$user_id){
            $timestamp = date('Y-m-d H:i:s');

            $error = 0;

            try{
                $this->open_db();
                if($target_file == ''){ //detect alredy asked question when only content is available 
                    $query ="SELECT * FROM discussion WHERE content='$question'";
                    $result = mysqli_query($this->condb,$query);
                    $rowx = mysqli_fetch_assoc($result);
                    if(!empty($rowx)){
                        $error=4; //already asked question
                        return $error;
                    }
                }

            if($error != 4){
                //insert question into discussion table
                if($question != '' && $target_file != ''){
                    $query1 = "INSERT INTO discussion (user_id, paper_id, subject_code, content, picture,timestamp) VALUES($user_id,$paperID ,'$subject_code' ,'$question' ,'$target_file','$timestamp')";
                }
                elseif($question == ''){
                    $query1 = "INSERT INTO discussion (user_id, paper_id, subject_code, picture,timestamp) VALUES($user_id,$paperID ,'$subject_code' ,'$target_file' ,'$timestamp')";
                }
                elseif($target_file == ''){
                    $query1 = "INSERT INTO discussion (user_id, paper_id, subject_code, content,timestamp) VALUES($user_id,$paperID ,'$subject_code' ,'$question' ,'$timestamp')";
                }

                $result1 = mysqli_query($this->condb,$query1);

                //get discussion id of new entry
                $query2 = "SELECT discussion_id FROM discussion WHERE user_id=$user_id AND timestamp='$timestamp'"; 
                $result2 = mysqli_query($this->condb,$query2);
                $row = mysqli_fetch_assoc($result2);

                $discussion_id = $row['discussion_id'];
                
                //anonymous name
                if($anonymous=='on'){
                    $query3 = "INSERT INTO anonymous_names (discussion_id, user_id, anonymous_number) VALUES(".$discussion_id.",".$user_id.",1)";
                    $result3 = mysqli_query($this->condb,$query3);
                }

                //insert tags
                if(!empty($extags)){
                    $this->insert_tags($discussion_id,$extags,$subject_code);
                }

                return $error;
            }else{
                return $error;
            }

            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }

        public function insert_tags($discussion_id,$extags,$subject_code){
            try{
                $this->open_db();
                if($subject_code == ''){ //insert tags when subject is not available
                    foreach($extags as $tag){
                        $query = "SELECT * FROM tags WHERE tag='$tag' AND subject_code IS NULL";
                        $result = mysqli_query($this->condb,$query);
                        $row1 = mysqli_fetch_assoc($result);

                        if(empty($row1)){
                            $query1 = "INSERT INTO tags (tag) VALUES (".$tag.")";
                            $result1 = mysqli_query($this->condb,$query1);
                        }
                        $query2 = "SELECT tag_id FROM tags WHERE tag='$tag' AND subject_code IS NULL";
                        $result2 = mysqli_query($this->condb,$query2);

                        $row = mysqli_fetch_assoc($result2);
                        $tag_id = $row['tag_id'];
                        $query3 = "INSERT INTO discussion_tags (discussion_id,tag_id) VALUES (".$discussion_id.",".$tag_id.")";
                        $result3 = mysqli_query($this->condb,$query3);
                    }
                }else{ //insert tags when subject is available 
                    foreach($extags as $tag){ 

                        $query = "SELECT * FROM tags WHERE tag='$tag' AND subject_code='$subject_code'";
                        $result = mysqli_query($this->condb,$query);
                        $row1 = mysqli_fetch_assoc($result);
                        
                        if(empty($row1)){
                            $query1 = "INSERT INTO tags (tag, subject_code) VALUES ('$tag','$subject_code')";
                            $result1 = mysqli_query($this->condb,$query1);
                        }

                        $query2 = "SELECT tag_id FROM tags WHERE tag='$tag' AND subject_code ='$subject_code'";
                        $result2 = mysqli_query($this->condb,$query2);
                        $row = mysqli_fetch_assoc($result2);

                        $tag_id = $row['tag_id'];
                        $query3 = "INSERT INTO discussion_tags (discussion_id,tag_id) VALUES ($discussion_id,$tag_id)";
                        $result3 = mysqli_query($this->condb,$query3);
                    }
                }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }

        public function show_data($paper_id){
            $this->open_db();
            $discussionArray=array();
            $sql="SELECT * FROM ((discussion INNER JOIN resources ON resources.discussion_id=discussion.discussion_id) INNER JOIN registered_user ON resources.user_id=registered_user.user_id)  WHERE paper_id=$paper_id  ORDER BY resource_id DESC";
            $result= $this->condb-> query($sql);
                while ($row_ah = mysqli_fetch_assoc($result)) {
                    array_push($discussionArray, $row_ah);
                }
            
            return $discussionArray;
            $this->condb->close();
		}
		
		public function getUserDiscussion($userId){
            $this->open_db();
            $discussionUserArray=array();
            $sql="SELECT * FROM resources INNER JOIN registered_user ON registered_user.user_id = resources.user_id WHERE registered_user.user_id=$userId ORDER BY resource_id DESC";
            $result= $this->condb-> query($sql);
                while ($row_discussion = mysqli_fetch_assoc($result)) {
                    array_push($discussionUserArray, $row_discussion);
                }
            
            return $discussionUserArray;
            $this->condb->close();
        }

        public function get_user($user_id){
            $this->open_db();
          
            $sql="SELECT * FROM registered_user WHERE user_id='$user_id' ";
            $result= $this->condb-> query($sql);
            $row= mysqli_fetch_assoc($result);
            
            return $row;
            $this->condb->close();
	}
	
	public function user_update($user_id,$first_name,$middle_name, $last_name,$email,$password){
        $this->open_db();
        $sql= "UPDATE registered_user SET email='$email' , first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' ,password='$password' WHERE user_id=$user_id";
        $result= $this->condb-> query($sql);
        return $result;
        }

        //hash password
		function hashPassword($password){ 
        	$hashedPW = sha1($password); 
			return $hashedPW;
		}
		
		public function password_update($user_id,$password){
            $this->open_db();
            $hashPassword=$this->hashPassword($password);
            $sql= "UPDATE registered_user SET password='$hashPassword' WHERE user_id=$user_id";
            $result= $this->condb-> query($sql);
            return $result;
		}
		
		public function delete_data($resource_id,$discussion_id,$parent_resource_id){
            $this->open_db();
                if($discussion_id!=null and $parent_resource_id==null){
    
                $sql="DELETE FROM resources Where discussion_id='$discussion_id'";
                $result= $this->condb-> query($sql);
                
                $sql2="DELETE FROM discussion Where discussion_id='$discussion_id'";
                $result2= $this->condb-> query($sql2);
            }else{
                $sql="DELETE FROM resources Where resource_id='$resource_id'";
                $result= $this->condb-> query($sql);
            }
            $this->condb->close();
		}
		public function get_question_details($discussion_id){
            $this->open_db();
            $sql="SELECT * FROM discussion INNER JOIN question ON question.question_id=discussion.question_id WHERE discussion_id=$discussion_id ";
            $result= $this->condb-> query($sql);
            $row= mysqli_fetch_assoc($result);
            return $row;
            $this->condb->close();
        }

        public function get_lesson_details($question_id,$paper_id){
            $this->open_db();
            $sql="SELECT * FROM question_belongs_to_lesson WHERE question_id=$question_id and paper_id=$paper_id ";
            $result= $this->condb-> query($sql);
            $row= mysqli_fetch_assoc($result);
            return $row;
            $this->condb->close();
        }

	}
?>