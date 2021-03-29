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
		
        //create questoin related to past paper
		public function create_discussion($question,$target_file,$extags,$anonymous,$paperID,$subject_code,$user_id){
            date_default_timezone_set("Asia/Colombo");
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

        //insert tags to tags table
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

        //get available days of lecturer
		public function getAvailabledays($userId){
			try{
                $this->open_db();

                $available=[];

                $query="SELECT day FROM available_day WHERE user_id=$userId ORDER BY day ASC";
                $result = mysqli_query($this->condb,$query);
                if(!empty($result)){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($available,$row['day']);
                    }
                }
                return $available;
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
		}

        //set available days
        public function insertAvailableDays($user_id,$available){
            try{
                $this->open_db();
                foreach ($available AS $day){
                $query = "INSERT INTO available_day (user_id, day) VALUES ($user_id,$day);";
                $result = mysqli_query($this->condb,$query);
                }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }

        public function deleteAvailableDays($user_id,$available){
            try{
                $this->open_db();
                foreach ($available AS $day){
                $query = "DELETE FROM available_day WHERE user_id=$user_id AND day=$day";
                $result = mysqli_query($this->condb,$query);
                }
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }

        public function set_image($uploadedPath, $userId){
            $this->open_db();
            
            $sql= "UPDATE registered_user SET image='$uploadedPath' WHERE user_id=$userId";            
            $result= $this->condb-> query($sql);
            return $result;
        }

        public function existing_question($content){
            try{
				$this->open_db();
                $query=$this->condb->prepare("SELECT * FROM discussion WHERE content='$content'");
				$query->execute();                
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return $res;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}	
        }

        public function create_general_question($user_id, $qcontent, $subject_code, $attachment, $timestamp){
            try{
                $success=true;
				$this->open_db();
                if($subject_code==""){
                    if($attachment==""){
                        $query=$this->condb->prepare("INSERT INTO discussion (user_id, content, timestamp) 
                        VALUES ($user_id, '$qcontent', '$timestamp')");
                    }else{
                        $query=$this->condb->prepare("INSERT INTO discussion (user_id, content, picture, timestamp) 
                        VALUES ($user_id, '$qcontent', '$attachment', '$timestamp')");
                    }
                }else{
                    if($attachment==""){
                        $query=$this->condb->prepare("INSERT INTO discussion (user_id, content, subject_code, timestamp) 
                        VALUES ($user_id, '$qcontent', '$subject_code', '$timestamp')");
                    }else{
                        $query=$this->condb->prepare("INSERT INTO discussion (user_id, content, ,subject_code, picture, timestamp) 
                        VALUES ($user_id, '$qcontent', '$subject_code', '$attachment', '$timestamp')");
                    }
                }
				if(!$query->execute()){
                    $success=false;
                }
				$query->close();
				$this->close_db();
				return $success;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}	
        }
        
        public function get_discussion_id($user_id, $timestamp){
            try{
				$this->open_db();
                $query=$this->condb->prepare("SELECT * FROM discussion WHERE user_id=$user_id AND timestamp='$timestamp'");
				$query->execute();                
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return $res;
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function initial_anonymous_name($discussion_id, $user_id){
            try{
                $success=true;
				$this->open_db();
                $query=$this->condb->prepare("INSERT INTO anonymous_names (discussion_id, user_id, anonymous_number) VALUES ($discussion_id, $user_id, 1)");
                if(!$query->execute()){
                    $success=false;
                }
				$query->close();
				$this->close_db();
				return $success;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function last_anonymous_number($discussion_id){
            try{
				$this->open_db();
                $query=$this->condb->prepare("SELECT anonymous_number FROM anonymous_names WHERE discussion_id=$discussion_id ORDER BY anonymous_number DESC LIMIT 1");
				$query->execute();                
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return $res;
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function create_answer($user_id, $content, $url, $attachment, $discussion_id, $timestamp, $priority){
            try{
                $success=true;
				$this->open_db();
                if($attachment==""){
                    if($url==""){
                        $query=$this->condb->prepare("INSERT INTO answer (user_id, content, discussion_id, timestamp, priority_flag) 
                        VALUES ($user_id, '$content', $discussion_id, '$timestamp', $priority)");
                    }else{
                        $query=$this->condb->prepare("INSERT INTO answer (user_id, content, url, discussion_id, timestamp, priority_flag) 
                        VALUES ($user_id, '$content', '$url', $discussion_id, '$timestamp', $priority)");
                    }
                }else{
                    if($url==""){
                        $query=$this->condb->prepare("INSERT INTO answer (user_id, content, picture, discussion_id, timestamp, priority_flag) 
                        VALUES ($user_id, '$content', '$attachment', $discussion_id, '$timestamp', $priority)");
                    }else{
                        $query=$this->condb->prepare("INSERT INTO answer (user_id, content, url, picture, discussion_id, timestamp, priority_flag) 
                        VALUES ($user_id, '$content', '$url', '$attachment', $discussion_id, '$timestamp', $priority)");
                    }
                }
				if(!$query->execute()){
                    $success=false;
                }
				$query->close();
				$this->close_db();
				return $success;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function assign_anonymous_name($discussion_id, $user_id, $anonymous_num){
            try{
                $success=true;
				$this->open_db();
                $query=$this->condb->prepare("INSERT INTO anonymous_names (discussion_id, user_id, anonymous_number) VALUES ($discussion_id, $user_id, $anonymous_num)");
                if(!$query->execute()){
                    $success=false;
                }
				$query->close();
				$this->close_db();
				return $success;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function get_anonymous_number($user_id, $discussion_id){
            try{
				$this->open_db();
                $query=$this->condb->prepare("SELECT * FROM anonymous_names WHERE user_id=$user_id AND discussion_id=$discussion_id");
				$query->execute();                
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return $res;
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        public function create_report($user_id, $discussion_id, $cause, $timestamp){
            try{
                $success=true;
				$this->open_db();
                $query=$this->condb->prepare("INSERT INTO report_discussion (user_id, discussion_id, report_cause, timestamp) 
                    VALUES ($user_id, $discussion_id, $cause, '$timestamp') 
                    ON DUPLICATE KEY UPDATE report_cause=$cause, timestamp='$timestamp'");
                if(!$query->execute()){
                    $success=false;
                }
				$query->close();
				$this->close_db();
				return $success;	
			}
            catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        //get meeting details
		public function getmeetingdetails($userId){
            try{
                $this->open_db();
                $meetings=[];

                date_default_timezone_set("Asia/Colombo");
                $today=date("Y-m-d");

                $query1="DELETE FROM meeting WHERE meeting_date<'$today'";
                $result1 = mysqli_query($this->condb,$query1);

                $query="SELECT meeting.meeting_id,student.user_id,registered_user.first_name,registered_user.last_name, meeting.meeting_date, meeting.meeting_time,meeting.deny FROM student INNER JOIN meeting ON student.user_id=meeting.student_user_id INNER JOIN registered_user ON student.user_id=registered_user.user_id WHERE meeting.lecturer_user_id='$userId'";
                $result = mysqli_query($this->condb,$query);
                if(!empty($result)){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($meetings,$row);
                    }
                }

                return $meetings;

            }
            catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        //confirm meeting
        public function confirmMeeting($meetid,$time){
            try{
                $this->open_db();
                $query = "UPDATE meeting SET meeting_time = '$time' WHERE meeting_id = '$meetid'";
                $result = mysqli_query($this->condb,$query);

                $query1 = "UPDATE meeting SET deny = '0' WHERE meeting_id = '$meetid'";
                $result1 = mysqli_query($this->condb,$query1);
            }
            catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }

        //reject , cancle a meeting
        public function canclemeetingrequest($meetid){
            try{
                $this->open_db();
                $query = "UPDATE meeting SET deny = '1' WHERE meeting_id = '$meetid'";
                $result = mysqli_query($this->condb,$query);
                
            }
            catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}
        }


	}
?>