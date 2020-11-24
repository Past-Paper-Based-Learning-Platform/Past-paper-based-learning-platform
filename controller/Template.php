<?php
include('../../model/UserModel.php');
include_once('../../model/Configuration.php');
class Template
{
   function getInterestList($user)
    {
        $interestList = $this->getInterestListIds($user);
        $userModel = new UserModel();
        $intersetListDesc = $userModel->getInterestListDesc($interestList);
        
        return $intersetListDesc;
    }

    function getInterestListIds($user){
        $userModel = new UserModel();
        $interestList = $userModel->getInterestList($user);
        $listArray = explode(',', $interestList);
        return $listArray;
    }

    function getSubjects($userId){
        $arryList = array();
        $config = new Configuration();  
        $subjects = $config->getSubjects();

        $interstList = $this->getInterestListIds($userId);

        foreach($subjects as $subject){
             
            $found = false;
            foreach($interstList as $interest){
                if($subject['subject_code']==$interest){
                    $found = true;
                }
            }
            if($found == false){
                array_push($arryList, $subject);
            }
        }
        return $arryList;
    }

    function addSubjects($user){
        $config = new Configuration();  

        $interestList = $this->getInterestListIds($user);
        $config->updateSubjects($user, implode(",",$interestList).",".implode(",",$_POST['addSubjcts']));
        
    }

    //get past paper details
    function getPastpapers(){
        $userModel = new UserModel();
        $result_paper = $userModel->get_pastpapers();
        return $result_paper;     
    }

    //get lesson details
    function getLessons(){
        $userModel = new UserModel();
        $result_lesson = $userModel->get_lessons();
        return $result_lesson;
    }
}
?>