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

        public function create_discussion($user_id,$level1,$level2,$level3,$level4,$lesson,$content,$type,$paper){
            
            $this->open_db();

            $lessonQuery="SELECT * FROM lesson WHERE tag='$lesson'";
            $lessonQueryOut=$this->condb-> query($lessonQuery);
            $lessonNum=mysqli_num_rows( $lessonQueryOut);

            $questionSelectQuery="SELECT * FROM question WHERE paper_id='$paper' AND level1='$level1' AND level2='$level2' AND level3='$level3' AND level4='$level4'";
            $questionSelectQueryOut=$this->condb-> query($questionSelectQuery);
           
            if(mysqli_num_rows($questionSelectQueryOut)==1){
            $QuestionRow=$questionSelectQueryOut->fetch_assoc();
            $question_row_id=$QuestionRow['question_id'];
            $questionNum=true;
            }else{
                $questionNum=false;
            }


            $paperQuery="SELECT * FROM past_paper WHERE paper_id='$paper'";
            $paperResult=$this->condb-> query($paperQuery);
            $paperRow=$paperResult->fetch_assoc();
            $subject_code=$paperRow['subject_code'];
            
           
            
            if($questionNum!=true and $lessonNum!=1){
                $lessonInsert="INSERT INTO lesson (tag , subject_code) VALUE ('$lesson','$subject_code')";
                $lessonResult=$this->condb-> query($lessonInsert);

                $questionQuery="INSERT INTO question (paper_id,level1,level2,level3,level4,content)  VALUE ($paper,'$level1','$level2','$level3','$level4','Null')";
                $questionQueryresult= $this->condb->query($questionQuery);
                $question_id= $this->condb->insert_id;
                

                $questionLesson="INSERT INTO question_belongs_to_lesson (tag ,paper_id,question_id) VALUE ('$lesson',$paper,$question_id)";
                $questionLessonresult= $this->condb->query($questionLesson);
            }elseif($questionNum==true and $lessonNum!=1){
                $lessonInsert="INSERT INTO lesson (tag , subject_code) VALUE ('$lesson','$subject_code')";
                $lessonResult=$this->condb-> query($lessonInsert);

                $questionLesson="INSERT INTO question_belongs_to_lesson (tag ,paper_id,question_id) VALUE ('$lesson',$paper,$question_row_id)";
                $questionLessonresult= $this->condb->query($questionLesson);
                $question_id=$question_row_id;
            }elseif($questionNum!=true and $lessonNum==1){
                $questionQuery="INSERT INTO question (paper_id,level1,level2,level3,level4,content)  VALUE ($paper,'$level1','$level2','$level3','$level4','Null')";
                $questionQueryresult= $this->condb->query($questionQuery);
                $question_id= $this->condb->insert_id;
                

                $questionLesson="INSERT INTO question_belongs_to_lesson (tag ,paper_id,question_id) VALUE ('$lesson',$paper,$question_id)";
                $questionLessonresult= $this->condb->query($questionLesson);
            }elseif($questionNum==true and $lessonNum==1){
                $question_id=$question_row_id;
            }

           /* $questionQuery="INSERT INTO question (paper_id,level1,level2,level3,level4,content)  VALUE ('$paper','$level1','$level2','$level3','$level4','Null')";
            $result= $this->condb->query($questionQuery);

            $question_id= $this->condb->insert_id;

*/
            $discussQuery="INSERT INTO discussion (paper_id,question_id)  VALUE ('$paper','$question_id')";
            $result2= $this->condb-> query($discussQuery);

            $discussion_id= $this->condb->insert_id;

            $resourceQuery="INSERT INTO resources (type,content,user_id,discussion_id)  VALUE ('$type','$content','$user_id',$discussion_id)";
            $result3= $this->condb->query($resourceQuery);
            $this->condb->close();

        }

        public function show_data(){
            $this->open_db();
            $discussionArray=array();
            $sql="SELECT resource_id,type,content,discussion_id,parent_resource_id,registred_user.first_name,registred_user.last_name,registred_user.user_id FROM resources JOIN registred_user ON resources.user_id=registred_user.user_id ORDER BY resource_id DESC";
            $result= $this->condb-> query($sql);
                while ($row_ah = mysqli_fetch_assoc($result)) {
                    array_push($discussionArray, $row_ah);
                }
            
            return $discussionArray;
            $this->condb->close();
        }

        public function get_user($user_id){
            $this->open_db();
          
            $sql="SELECT * FROM registred_user WHERE user_id='$user_id' ";
            $result= $this->condb-> query($sql);
            $row= mysqli_fetch_assoc($result);
            
            return $row;
            $this->condb->close();
    }

    public function user_update($user_id,$first_name,$middle_name, $last_name,$email,$password){
        $this->open_db();
        $sql= "UPDATE registred_user SET email='$email' , first_name='$first_name' , middle_name='$middle_name' , last_name='$last_name' ,password='$password' WHERE user_id=$user_id";
        $result= $this->condb-> query($sql);
        return $result;
        }

    public function password_update($user_id,$password){
            $this->open_db();
            $sql= "UPDATE registred_user SET password='$password' WHERE user_id=$user_id";
            $result= $this->condb-> query($sql);
            return $result;
        }

        
    }
?>