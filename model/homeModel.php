<?php
    class homeModel
    {
        // set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
				die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
        }

        //get interest list ids
     /*   public function getInterestListIds($user){
            try
            {
                $this->open_db();
                $subjects = null;
                $selectQuery = 'SELECT * FROM interest_list WHERE user_id = "'.$user.'"';
                $sekectresult = mysqli_query($this->condb,$selectQuery);
                if ($sekectresult->num_rows > 0) {
                    while($row = $sekectresult->fetch_assoc()) {
                        $subjects = $row["subject_code"];               
                    }
                }
                return $subjects;
                $this->close_db();
            }
            catch (Exception $e)
            {
                $this->close_db();
				throw $e;
            }
        }*/

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
        function getPastpapers(){
            try
			{
                $this->open_db();
				$query="SELECT past_paper.paper_id, 
                past_paper.subject_code, 
                past_paper.year, 
                subject.semester, 
                subject.subject_name, 
                past_paper.part 
                FROM past_paper INNER JOIN subject 
                ON past_paper.subject_code=subject.subject_code";
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

        public function insert_tags($discussion_id,$extags,$subject_code){
            try{
                $this->open_db();
                if($subject_code == ''){ //insert tags when subject is not available
                    foreach($extags as $tag){
                        $query = "SELECT * FROM tags WHERE tag='$tag' AND subject_code IS NULL";
                        $result = mysqli_query($this->condb,$query);
                        $row1 = mysqli_fetch_assoc($result);

                        if(empty($row1)){
                            $query1 = "INSERT INTO tags (tag) VALUES ('$tag')";
                            $result1 = mysqli_query($this->condb,$query1);
                        }
                        $query2 = "SELECT tag_id FROM tags WHERE tag='$tag' AND subject_code IS NULL";
                        $result2 = mysqli_query($this->condb,$query2);

                        $row = mysqli_fetch_assoc($result2);
                        $tag_id = $row['tag_id'];
                        $query3 = "INSERT INTO discussion_tags (discussion_id,tag_id) VALUES ($discussion_id, $tag_id)";
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

    
		

    public function user_update($user_id,$first_name,$middle_name, $last_name,$email,$password,$user_update){
        $this->open_db();

        $userData = $this->get_user($user_id);
        $slider = $userData['user_flag'];
        
        if($user_update=='D'){
            $slider='D';
        }

        $sql= "UPDATE registered_user SET email='$email' , first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' ,password='$password' ,user_flag='$slider' WHERE user_id=$user_id";
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
                        $query=$this->condb->prepare("INSERT INTO discussion (user_id, content, subject_code, picture, timestamp) 
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
        //get lecturer details name email id
        public function getlecturerdetails(){
            try{
                $this->open_db();
                $lecturerdetails=[];
                $query = "SELECT registered_user.first_name,registered_user.last_name,registered_user.email,lecturer.user_id FROM registered_user INNER JOIN lecturer ON registered_user.user_id=lecturer.user_id";
                $result=mysqli_query($this->condb,$query);
                while($row=mysqli_fetch_assoc($result)){
                    array_push($lecturerdetails, $row);
                }
                return $lecturerdetails;   
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

        public function availableDays($lecturerid){
            try{
                $this->open_db();

                $available=[];

                $query="SELECT day FROM available_day WHERE user_id=$lecturerid ORDER BY day ASC";
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

        public function requstmeeting($lecturerid, $date, $user_id){
            try{
                $this->open_db();
                $query="INSERT INTO meeting (meeting_date,student_user_id,lecturer_user_id) VALUES ('$date','$user_id','$lecturerid')";
                $result = mysqli_query($this->condb,$query);
                if(empty($result)){
                    echo '<h1>Please god</h1>';
                }
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

                $query="SELECT lecturer.user_id,registered_user.first_name,registered_user.last_name, meeting.meeting_date, meeting.meeting_time,meeting.deny FROM lecturer INNER JOIN meeting ON lecturer.user_id=meeting.lecturer_user_id INNER JOIN registered_user ON lecturer.user_id=registered_user.user_id WHERE meeting.student_user_id='$userId'";
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

        public function getUserImage($userId){
            try{
                $this->open_db();

                $sql="SELECT * FROM registered_user WHERE user_id='$userId' ";
                $result= $this->condb-> query($sql);
                $row= mysqli_fetch_assoc($result);

                if($row['image']){
                    return $row['image'];
                }
                return "uploads/default.png";
                
                $this->close_db();
            }catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
            }
        }
            
        public function updateDiscussion($discussionId,$content){
            $this->open_db();
            $sql="UPDATE discussion SET content='$content' WHERE discussion_id=$discussionId";
            $result= $this->condb-> query($sql);
           
            
            $this->close_db();
        }

        public function deleteDiscussion($discussion_id){
            $this->open_db();
             
                
                $sql1="DELETE FROM discussion Where discussion_id='$discussion_id'";
                $result1= $this->condb-> query($sql1);
                $sql2="DELETE FROM discussion_feedback Where discussion_id='$discussion_id'";
                $result2= $this->condb-> query($sql2);
                $sql3="DELETE FROM answer Where discussion_id='$discussion_id'";
                $result3= $this->condb-> query($sql3);
                $sql4="DELETE FROM answer_feedback Where discussion_id='$discussion_id'";
                $result4= $this->condb-> query($sql4);
                $sql5="DELETE FROM anonymous_names Where discussion_id='$discussion_id'";
                $result5= $this->condb-> query($sql5);
                 $this->close_db();
        }
    }
?>