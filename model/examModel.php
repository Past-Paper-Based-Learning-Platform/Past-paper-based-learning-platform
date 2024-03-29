<?php
	
	class examModel
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
        
        //show available papers in the system
        public function get_papers($year, $semester, $course, $studyyear)
        {
            try
			{
                $this->open_db();
                $query=$this->condb->prepare("SELECT p.subject_code, s.subject_name, p.part, p.past_paper, p.paper_id
                FROM past_paper p, subject s 
                WHERE p.subject_code=s.subject_code 
                AND s.semester='$semester' 
                AND s.year_of_study='$studyyear'
                AND s.course_code='$course'
                AND p.year='$year';");	
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
        }
		public function del_paper($id)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("DELETE FROM past_paper WHERE paper_id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}		
		} 
		public function paper_upload($subject, $year, $part, $paperpath, $uploaddate)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("INSERT INTO past_paper (subject_code, year, part, past_paper, uploaded_date) VALUES ('$subject', '$year', '$part', '$paperpath', '$uploaddate')");
				if(!$query->execute()){
					return false;
				}
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}		
		}
		public function get_paperpath($id){
			try{
				$this->open_db();
				$query=$this->condb->prepare("SELECT past_paper FROM past_paper WHERE paper_id=?");
				$query->bind_param("i",$id);
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
		public function get_subjects($year, $course){
			try{
				$this->open_db();
				$query=$this->condb->prepare("SELECT subject_code, subject_name FROM subject WHERE course_code='$course' AND ((introduced_year<=$year AND removed_year>$year) OR (removed_year=0 AND introduced_year<=$year))");
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
		public function all_subjects(){
			try{
				$this->open_db();
				$query=$this->condb->prepare("SELECT subject_code, subject_name FROM subject");
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
		public function semester_subjects($year, $semester, $course, $studyyear){
			try{
				$this->open_db();
				if($semester=='0'){
					$query=$this->condb->prepare("SELECT subject_code, subject_name, active_flag, removed_year 
					FROM subject 
					WHERE course_code='$course'
					AND semester='1/2'
					AND year_of_study='$studyyear'
					AND introduced_year<=$year AND (removed_year>$year OR removed_year=0)");
				}else{
					$query=$this->condb->prepare("SELECT subject_code, subject_name, active_flag, removed_year 
					FROM subject 
					WHERE course_code='$course'
					AND (semester='$semester' OR semester='1/2')
					AND year_of_study='$studyyear'
					AND introduced_year<=$year AND (removed_year>$year OR removed_year=0)");
				}				
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

		public function inactive_subject($subjectcode){
			try{
				$this->open_db();
				$query=$this->condb->prepare("UPDATE subject SET active_flag=0, removed_year=YEAR(CURDATE()) WHERE subject_code='$subjectcode'");
				$query->execute();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw false;
        	}	
		}

		public function newsubject_details($semester, $course, $studyyear, $subjectcode, $subjectname, $linkedsubject, $addedyear){
			try{
				$this->open_db();
				if($linkedsubject==''){
					if($semester=='0'){
						$query=$this->condb->prepare("INSERT INTO subject(subject_code, subject_name, introduced_year, year_of_study, semester, course_code, linked_subject, active_flag) VALUES ('$subjectcode', '$subjectname', $addedyear, '$studyyear', '1/2', '$course', NULL, 1)");
					}else{
						$query=$this->condb->prepare("INSERT INTO subject(subject_code, subject_name, introduced_year, year_of_study, semester, course_code, linked_subject, active_flag) VALUES ('$subjectcode', '$subjectname', $addedyear, '$studyyear', '$semester', '$course', NULL, 1)");
					}
				}else if($semester=='0'){
					$query=$this->condb->prepare("INSERT INTO subject(subject_code, subject_name, introduced_year, year_of_study, semester, course_code, linked_subject, active_flag) VALUES ('$subjectcode', '$subjectname', $addedyear, '$studyyear', '1/2', '$course', '$linkedsubject', 1)");
				}else{
					$query=$this->condb->prepare("INSERT INTO subject(subject_code, subject_name, introduced_year, year_of_study, semester, course_code, linked_subject, active_flag) VALUES ('$subjectcode', '$subjectname', $addedyear, '$studyyear', '$semester', '$course', '$linkedsubject', 1)");
				}
				
				if(!$query->execute()){
					return false;
				}
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{   
            	$this->close_db();
            	throw $e;
        	}	
		}
    }   
?>